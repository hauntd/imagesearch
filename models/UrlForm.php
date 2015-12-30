<?php

namespace app\models;

use Yii;
use yii\base\Model;
use app\components\ImageManager;

/**
 * @author Alexander Kononenko <contact@hauntd.me>
 * @package app\models
 */
class UrlForm extends Model
{
    /** @var string */
    public $url;

    /**
     * @return array
     */
    public function rules()
    {
        return [
            ['url', 'required'],
            ['url', 'url'],
            ['url', 'checkUrl'],
        ];
    }

    /**
     * @return array
     */
    public function attributeLabels()
    {
        return [
            'url' => 'URL',
        ];
    }

    /**
     * @return bool
     */
    public function checkUrl()
    {
        $info = pathinfo($this->url);
        if (!in_array(strtolower($info['extension']), ['jpg', 'jpeg', 'png'])) {
            $this->addError('url', 'Wrong file format');
            return false;
        }

        return true;
    }

    /**
     * Get PHash
     */
    public function getPHash()
    {
        $content = file_get_contents($this->url);
        $tempFile = Yii::getAlias('@app/runtime/' . time() . mt_rand(0, 1000));
        file_put_contents($tempFile, $content);
        $hash = ImageManager::getPHash($tempFile);
        unlink($tempFile);

        return $hash;
    }
}
