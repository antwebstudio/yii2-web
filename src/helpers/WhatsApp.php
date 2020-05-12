<?php
namespace ant\helpers;

use yii\helpers\Html;

class WhatsApp {
	// @param urlType: api / web
	public static function apiUrl($number, $message = null, $urlType = 'api') {
		$number = str_replace([' ', '(', ')', '-', '+'], '', $number);
		return 'https://'.$urlType.'.whatsapp.com/send?phone='.$number.'&text='.urlencode($message);
	}
	
	public static function addCountryPrefix($number, $countryIso = 'my') {
		if (substr($number, 0, 1) != '6' && substr($number, 0, 1) != '+') {
			$number = '+6' . $number;
		}
		return $number;
	}
	
	public static function button($number, $message = null, $label = 'WhatsApp', $options = [], $compatible = true) {
		$html = '';
		if (!isset($options['class'])) $options['class'] = 'btn btn-secondary';
		if (!isset($options['target'])) $options['target'] = '_blank';
		
		$laptopVerOptions = $mobileVerOptions = $options;
		
		Html::addCssClass($mobileVerOptions, 'd-md-none');
		Html::addCssClass($laptopVerOptions, 'd-none d-md-inline-block');
		
		$html .= Html::a($label, self::apiUrl($number, $message), $mobileVerOptions);
		$html .= Html::a($label, self::apiUrl($number, $message, 'web'), $laptopVerOptions);
		
		//$html .= '<a href="'.self::apiUrl($number, $message).'" class="d-md-none '.$options['class'].'">'.$label.'</a>';
		//$html .= '<a href="'.self::apiUrl($number, $message, 'web').'" class="d-none d-md-inline-block '.$options['class'].'">'.$label.'</a>';
		return $html;
	}
}