<?php

namespace app\assets;

use yii\web\AssetBundle;

/**
 * @author Alexander Kononenko <contact@hauntd.me>
 * @package app\assets
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';

    public $baseUrl = '@web';

    public $css = [
        'css/everest-ui.css',
        'css/magnific-popup.css',
        'css/imagesearch.css',
    ];

    public $js = [
        'js/jquery.magnific-popup.min.js',
        'js/imagesearch.js',
    ];

    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        'yii\bootstrap\BootstrapPluginAsset',
    ];
}
