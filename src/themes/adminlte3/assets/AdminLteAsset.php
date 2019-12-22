<?php
namespace ant\themes\adminlte3\assets;

use yii\web\AssetBundle;

class AdminLteAsset extends AssetBundle
{
    public $sourcePath = '@vendor/almasaeed2010/adminlte/dist';

    public $js = [
		'js/adminlte.js',
    ];

    public $css = [
        'css/adminlte.min.css',
    ];

    public $depends = [
		'ant\themes\adminlte3\assets\AdminLtePluginAsset',
        'rmrevin\yii\fontawesome\AssetBundle',
        'yii\web\YiiAsset',
        'yii\bootstrap4\BootstrapAsset',
        'yii\bootstrap4\BootstrapPluginAsset',
    ];
}