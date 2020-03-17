<?php
namespace ant\widgets;

use yii\helpers\Html;

class Slider extends \evgeniyrru\yii2slick\Slick {
	public static function toItems($filePaths) {
		$filePaths = (array) $filePaths;
		
		$items = [];
		foreach ($filePaths as $file) {
			$items[] = Html::img($file, ['class' => 'img-fluid']); 
		}
		
		return $items;
	}
}