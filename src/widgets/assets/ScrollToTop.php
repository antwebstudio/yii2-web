<?php
namespace ant\widgets\assets;

class ScrollToTop extends \yii\web\AssetBundle {
	public $sourcePath = __DIR__ .'/scroll-to-top';
	
	public $css = [
		'scss/style.scss',
	];
	
	public $js = [
		'js/script.js',
	];
}