<?php
namespace ant\widgets;

use Yii;
use yii\helpers\Url;

class Modal extends \yii\base\Widget {
    public $url;
	
	public static function begin($config = [])
	{
		if (isset(Yii::$app->params['bsVersion']) && Yii::$app->params['bsVersion'] >= 4) {
			return \ant\widgets\ModalBootstrap4::begin();
		} else {
			return \ant\widgets\ModalBootstrap3::begin();
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
}