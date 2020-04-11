<?php
namespace ant\themes\adminlte3\assets;

use yii\web\AssetBundle;

class AdminLtePluginAsset extends AssetBundle
{
    public $sourcePath = '@vendor/almasaeed2010/adminlte/plugins';

    public $js = [
		'chart.js/Chart.min.js',
		'sparklines/sparkline.js',
		'jqvmap/jquery.vmap.min.js',
		'jqvmap/maps/jquery.vmap.usa.js',
		'jquery-knob/jquery.knob.min.js',
		//'moment/moment.min.js',
		//'daterangepicker/daterangepicker.js',
		'tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js',
		'summernote/summernote-bs4.min.js',
		'overlayScrollbars/js/jquery.overlayScrollbars.min.js',
    ];


    public $css = [
		'fontawesome-free/css/all.min.css',
		'https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css',
		'tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css',
		'icheck-bootstrap/icheck-bootstrap.min.css',
		'jqvmap/jqvmap.min.css',
		'overlayScrollbars/css/OverlayScrollbars.min.css',
		//'daterangepicker/daterangepicker.css',
		'summernote/summernote-bs4.css',
    ];

    public $depends = [
    ];
}