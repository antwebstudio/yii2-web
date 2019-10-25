<?php
namespace backend\themes\adminlte\assets;

use yii\web\AssetBundle;

class ThemeAsset extends AssetBundle
{
    public $sourcePath = '@backend/themes/adminlte/public';

    //public $basePath = '@webroot/themes/event/public';
    //public $baseUrl = '@web/themes/event/public';

    public $css = [
        'css/site.css',
    ];
    
    public $js = [
    ];

    public $depends = [
        'yii\web\YiiAsset',
        //'yii\bootstrap\BootstrapAsset',
        '\rmrevin\yii\fontawesome\AssetBundle',
		//'\backend\assets\AppAsset',
		'\backend\themes\adminlte\assets\AdminLtePluginAsset',
		//'\common\assets\StyleAsset\Asset',
    ];
}
