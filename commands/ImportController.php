<?php

namespace app\commands;

use Yii;
use yii\console\Controller;
use Symfony\Component\Finder\Finder;
use app\components\ImageManager;
use app\models\Image;

/**
 * @author Alexander Kononenko <contact@hauntd.me>
 * @package app\commands
 */
class ImportController extends Controller
{
    /** @var string */
    public $directory;

    /**
     * @param string $actionID
     * @return array
     */
    public function options($actionID)
    {
        return array_merge(parent::options($actionID), [
            'directory',
        ]);
    }

    /**
     * Import files from directory
     * @throws \yii\base\Exception
     */
    public function actionIndex()
    {
        $finder = new Finder();

        $iterator = $finder
            ->files()
            ->name('*.jpg')
            ->name('*.jpeg')
            ->name('*.png')
            ->size('>= 10K')
            ->size('<= 1M')
            ->in(realpath($this->directory));

        $i = 1;
        foreach ($iterator as $file) {
            /** @var Image $image */
            $image = ImageManager::importImage($file->getRealpath());
            if ($image) {
                printf("[%d/%d] %s %s\n", $i, $iterator->count(), $file->getRealpath(), $image->phash);
            } else {
                printf("[%d/%d] Skipped\n", $i, $iterator->count());
            }
            $i++;
        }
    }
}
