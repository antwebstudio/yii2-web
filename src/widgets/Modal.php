<?php
namespace ant\widgets;

use Yii;
use yii\helpers\Url;

class Modal extends \yii\base\Widget {
	
	public static function begin($config = [])
	{
		if (isset(Yii::$app->params['bsVersion']) && Yii::$app->params['bsVersion'] >= 4) {
			return \ant\widgets\ModalBootstrap4::begin($config);
		} else {
			return \ant\widgets\ModalBootstrap3::begin($config);
		}
	}
	
	public static function end()
	{
		if (isset(Yii::$app->params['bsVersion']) && Yii::$app->params['bsVersion'] >= 4) {
			return \ant\widgets\ModalBootstrap4::end();
		} else {
			return \ant\widgets\ModalBootstrap3::end();
		}
	}
	
	public static function widget($config = []) {
		
		if (isset(Yii::$app->params['bsVersion']) && Yii::$app->params['bsVersion'] >= 4) {
			return \ant\widgets\ModalBootstrap4::widget($config);
		} else {
			return \ant\widgets\ModalBootstrap3::widget($config);
		}
	}
}