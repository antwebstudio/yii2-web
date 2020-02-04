<?php
namespace ant\themes\adminlte3\assets;

use yii\web\AssetBundle;

class ThemeAsset extends AssetBundle
{
    public $sourcePath = '@vendor/antweb/yii2-web/src/themes/adminlte3/public';

    //public $basePath = '@webroot/themes/event/public';
    //public $baseUrl = '@web/themes/event/public';

    public $css = [
        //'css/site.css',
    ];
    
    public $js = [
    ];

    public $depends = [
        'yii\web\YiiAsset',
		'ant\bootstrap4Extended\SassAsset',
		'ant\themes\adminlte3\assets\AdminLteAsset',
    ];
}
