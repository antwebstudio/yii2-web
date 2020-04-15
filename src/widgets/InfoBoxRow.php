<?php
namespace ant\widgets;

use yii\helpers\Url;

class InfoBoxRow extends \yii\base\Widget {
	public $items = [];
	
	public function run() {
		$html = '';
		foreach ($this->items as $box) {
			$html .= '<div class="row">
				<div class="col-md-3 col-sm-6 col-xs-12">
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
				</div>
			</div>';
		}
		return $html;
	}
}