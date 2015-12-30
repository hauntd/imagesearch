<?php

namespace app\models;

use yii\base\Model;
use yii\web\UploadedFile;
use app\components\ImageManager;

/**
 * @author Alexander Kononenko <contact@hauntd.me>
 * @package app\models
 */
class ImageForm extends Model
{
    /** @var UploadedFile */
    public $imageFile;

    /**
     * @return array
     */
    public function rules()
    {
        return [
            ['imageFile', 'required'],
            ['imageFile', 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg, jpeg', 'maxSize' => 1*1024*1024],
        ];
    }

    /**
     * @return array
     */
    public function attributeLabels()
    {
        return [
            'imageFile' => 'Image',
        ];
    }

    /**
     * Get PHash
     */
    public function getPHash()
    {
        return ImageManager::getPHash($this->imageFile->tempName);
    }
}
