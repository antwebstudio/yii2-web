<?php
namespace ant\widgets;

use Yii;

class Tabs extends \yii\base\Widget
{
	public $options = [];
	
	public $items = [];
	
	public static function widget($config = []) {
		if (isset(Yii::$app->params['bsVersion']) && Yii::$app->params['bsVersion'] >= 4) {
			return \yii\bootstrap4\Tabs::widget($config);
		} else {
			return \yii\bootstrap\Tabs::widget($config);
		}
	}
	
	public static function begin($config = [])
	{
		if (isset(Yii::$app->params['bsVersion']) && Yii::$app->params['bsVersion'] >= 4) {
			return \yii\bootstrap4\Tabs::begin($config);
		} else {
			return \yii\bootstrap\Tabs::begin($config);
		}
	}
	
	public static function end()
	{
		if (isset(Yii::$app->params['bsVersion']) && Yii::$app->params['bsVersion'] >= 4) {
			return \yii\bootstrap4\Nav::end();
		} else {
			return \yii\bootstrap\Nav::end();
		}
	}
}