<?php
namespace ant\widgets;

use yii\helpers\Url;
use yii\helpers\Html;

class InfoBoxRow extends \yii\base\Widget {
	public $items = [];
	public $containerOptions = ['class' => 'col-md-3 col-sm-6 col-xs-6 col-12'];
	
	public function run() {
		$html = '';
		$html .= '<div class="row">';
		foreach ($this->items as $box) {
			$html .= Html::tag('div', '
					<div class="info-box">
						<span class="info-box-icon bg-'.$box['color'].'">
							<i class="fa fa-'.$box['icon'].'"></i>
						</span>
						<div class="info-box-content">
							<span class="info-box-text">'.$box['label'].'</span>
							<span class="info-box-number">'.$box['value'].'<small></small></span>
							'.(isset($box['url']) ? '<a href="'.Url::to($box['url']).'" class="btn btn-xs btn-default">More Info</a>' : '').'
						</div>
					</div>
			', $this->containerOptions);
		}
		$html .= '</div>';
		return $html;
	}
}