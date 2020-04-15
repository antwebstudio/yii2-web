<?php
namespace ant\themes\adminlte3\assets;

use yii\web\AssetBundle;

class ThemeAsset extends AssetBundle
{
    public $sourcePath = '@vendor/antweb/yii2-web/src/themes/adminlte3/public';

    //public $basePath = '@webroot/themes/event/public';
    //public $baseUrl = '@web/themes/event/public';

    public $css = [
        'css/style.css',
		'https://cdnjs.cloudflare.com/ajax/libs/awesome-bootstrap-checkbox/1.0.2/awesome-bootstrap-checkbox.min.css',
    ];
    
    public $js = [
    ];

    public $depends = [
        'yii\web\YiiAsset',
		'ant\bootstrap4Extended\SassAsset',
		'ant\themes\adminlte3\assets\AdminLteAsset',
    ];
}
