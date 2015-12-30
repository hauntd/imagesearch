<?php

namespace app\components;

use Yii;
use yii\base\Exception;
use yii\base\Object;
use yii\imagine\Image as Imagine;
use app\models\Image;
use Jenssegers\ImageHash\ImageHash;
use Jenssegers\ImageHash\Implementations\AverageHash;
use Jenssegers\ImageHash\Implementations\DifferenceHash;
use Jenssegers\ImageHash\Implementations\PerceptualHash;

/**
 * @author Alexander Kononenko <contact@hauntd.me>
 * @package app\components
 */
class ImageManager extends Object
{
    /**
     * Calculate p-hash and save image
     * @param string $file
     * @throws Exception
     * @return Image
     */
    public static function importImage($file)
    {
        try {
            $fileInfo = pathinfo($file);
            $model = new Image();
            $model->md5 = md5_file($file);
            $model->phash = self::getPHash($file);
            $model->path = sprintf('%s/%s.%s', substr($model->md5, 0, 2), $model->md5, $fileInfo['extension']);
            $model->previewPath = sprintf('%s/%s_preview.%s', substr($model->md5, 0, 2), $model->md5, $fileInfo['extension']);
            if ($model->save()) {
                $dstImage =  Yii::getAlias('@app/web/uploads') . '/' . $model->path;
                $dstPath = dirname($dstImage);
                if (!is_dir($dstPath)) {
                    mkdir($dstPath, 0777, true);
                }
                if (!file_exists($dstImage)) {
                    copy($file, $dstImage);
                    Imagine::thumbnail($file, 300, 300)
                        ->save(Yii::getAlias('@app/web/uploads') . '/' . $model->previewPath, [
                            'format' => 'jpg',
                            'quality' => 90
                        ]);
                }
                return $model;
            } else {
                return null;
            }
        } catch (\Exception $e) {
        }

        return null;
    }

    /**
     * @param $file
     * @return int
     */
    public static function getPHash($file)
    {
        return (new ImageHash())->hash($file);
    }
}
