<?php
namespace ant\widgets\assets;

use yii\web\AssetBundle;

class LightGalleryAsset extends AssetBundle
{
    public $sourcePath = '@bower/lightgallery';
    public $css = [
        'dist/css/lg-transitions.min.css',
        'dist/css/lightgallery.min.css'
    ];
    public $js = [
        'dist/js/lightgallery.min.js',
        'modules/lg-autoplay.min.js',
        'modules/lg-fullscreen.min.js',
        'modules/lg-share.min.js',
        'modules/lg-thumbnail.min.js',
        'modules/lg-video.min.js',
        'modules/lg-zoom.min.js'
    ];
    public $depends = [
        'yii\web\JqueryAsset',
    ];
}