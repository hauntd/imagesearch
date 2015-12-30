<?php

namespace app\models;

use Yii;
use yii\helpers\Url;

/**
 * This is the model class for table "image".
 *
 * @property integer $id
 * @property string $md5
 * @property string $phash
 * @property string $path
 * @property string $previewPath
 */
class Image extends \yii\db\ActiveRecord
{
    /** @var integer */
    public $hammingDistance;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'image';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['md5'], 'unique'],
            [['md5'], 'string', 'max' => 32],
            [['phash'], 'string', 'max' => 16],
            [['path', 'previewPath'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'md5' => 'MD5',
            'phash' => 'P-Hash',
            'path' => 'Path',
            'previewPath' => 'Preview',
        ];
    }

    /**
     * @return array|\yii\db\ActiveRecord[]
     */
    public function getSimilar()
    {
        return self::findSimilar($this->phash, 20)->all();
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return Url::to(['/uploads/' . $this->path]);
    }

    /**
     * @return string
     */
    public function getPreviewUrl()
    {
        return Url::to(['/uploads/' . $this->previewPath]);
    }

    /**
     * @return float
     */
    public function getScore()
    {
        return floor(100 * (1 - $this->hammingDistance / 64));
    }

    /**
     * Find similar images
     * @param $hash
     * @param $distance int
     * @return \yii\db\ActiveQuery
     */
    public static function findSimilar($hash, $distance)
    {
        $query = self::find();
        $query->select(['*', sprintf('BIT_COUNT(CONV(phash, 16, 10) ^ CONV("%s", 16, 10)) as hammingDistance', $hash)]);
        $query->having('hammingDistance > 0 and hammingDistance <= :distance', [':distance' => $distance]);
        $query->where('phash <> :hash', [':hash' => $hash]);
        $query->orderBy('hammingDistance asc');

        return $query;
    }
}
