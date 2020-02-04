<?php
namespace ant\widgets;

use Yii;
use yii\helpers\Html;

class DateRangePicker extends \kartik\daterange\DateRangePicker {
	const RANGE_BY_MONTH = 'byMonth';
	
	public $presetDropdown = false;
	public $hideInput = true;
	public $autoUpdateOnInit = false;
	public $convertFormat = true;
	public $rangePreset;
	public $validDate;
	
	public $clearButton = true;
	
	public function run() {
        $this->initSettings();
		if ($this->clearButton) {
			return Html::tag('div', $this->renderInput().$this->renderClearButton(), ['class' => 'input-group']);
		} else {
			return $this->renderInput();
		}
	}
	
	public function init() {
		$this->autoUpdateOnInit = true;
		$this->pluginOptions = [
			'isInvalidDate' => new \yii\web\JsExpression("function(date) {
				var valid = ".json_encode($this->normalizeValidDate($this->validDate)).";
				if (valid === null) return false;
				
				function inRange(date, range) {
					var start = range[0] !== null ? new Date(range[0] + ' GMT' + date.format('Z')) : range[0];
					var end = range[1] !== null ? new Date(range[1] + ' GMT' + date.format('Z')) : range[1];
					if (start !== null && end !== null) {
						return date >= start && date <= end;
					} else if (start !== null) {
						return date >= start;
					} else if (end !== null) {
						return date <= end;
					}
					return false;
				}
				
				for(var i = 0; i < valid.length; i++){
					if (Array.isArray(valid[i])) {
						if (inRange(date, valid[i])) {
							return false;
						}
					} else if (date.format('YYYY-MM-DD') == valid[i]) {
						return false;
					}
				}
				return true;
			}"),
			'timePicker' => false,
			//'timePickerIncrement' => 30,
			'locale' => [
				'format' => 'Y-m-d',
			],
			'ranges' => $this->getDateTimeRangePreset($this->rangePreset),
			'allowClear' => true,
		];
		parent::init();
	}
	
	protected function renderClearButton() {
		if ($this->clearButton) {
			$id = $this->containerOptions['id'];
			$buttonId = $id.'_clear';
			$this->view->registerJs('
				document.querySelector("#'.$buttonId.'").addEventListener("click", function() {
					var inputs = document.querySelector("#'.$id.'").querySelectorAll("input");
					for (i = 0; i < inputs.length; ++i) {
						inputs[i].value = "";
						//inputs[i].dispatchEvent(new Event("change"));
						//inputs[i].change();
						jQuery(inputs[i]).trigger("change");
					}
				});
			');
			
			return Html::tag('div', Html::button('<i class="fa fa-times"></i>', ['id' => $buttonId, 'class' => 'btn btn-default']), ['class' => 'input-group-btn']);
		}
	}
	
	protected function normalizeValidDate() {
		if (!isset($this->validDate)) return null;
		
		$normalized = [];
		foreach ((array) $this->validDate as $key => $value) {
			if (is_int($key)) {
				$normalized[] = $value;
			} else {
				$normalized[] = [$key, $value];
			}
		}
		return $normalized;
	}
	
	protected function getDateTimeRangePreset($preset = null) {
		if ($preset == self::RANGE_BY_MONTH) {
			return [
				Yii::t('kvdrp', "This Month") => ["moment().startOf('month')", "moment().endOf('month')"],
				Yii::t('kvdrp', "Last Month") => ["moment().subtract(1, 'month').startOf('month')", "moment().subtract(1, 'month').endOf('month')"],
				Yii::t('kvdrp', "2 Month Ago") => ["moment().subtract(2, 'month').startOf('month')", "moment().subtract(2, 'month').endOf('month')"],
				Yii::t('kvdrp', "3 Month Ago") => ["moment().subtract(3, 'month').startOf('month')", "moment().subtract(3, 'month').endOf('month')"],
				Yii::t('kvdrp', "4 Month Ago") => ["moment().subtract(4, 'month').startOf('month')", "moment().subtract(4, 'month').endOf('month')"],
				Yii::t('kvdrp', "5 Month Ago") => ["moment().subtract(5, 'month').startOf('month')", "moment().subtract(5, 'month').endOf('month')"],
				Yii::t('kvdrp', "6 Month Ago") => ["moment().subtract(6, 'month').startOf('month')", "moment().subtract(6, 'month').endOf('month')"],
				Yii::t('kvdrp', "7 Month Ago") => ["moment().subtract(7, 'month').startOf('month')", "moment().subtract(7, 'month').endOf('month')"],
				Yii::t('kvdrp', "8 Month Ago") => ["moment().subtract(8, 'month').startOf('month')", "moment().subtract(8, 'month').endOf('month')"],
				Yii::t('kvdrp', "9 Month Ago") => ["moment().subtract(9, 'month').startOf('month')", "moment().subtract(9, 'month').endOf('month')"],
				Yii::t('kvdrp', "10 Month Ago") => ["moment().subtract(10, 'month').startOf('month')", "moment().subtract(10, 'month').endOf('month')"],
			];
		}
		
        return [
            Yii::t('kvdrp', "Today") => ["moment().startOf('day')", "moment()"],
            Yii::t('kvdrp', "Yesterday") => ["moment().startOf('day').subtract(1,'days')", "moment().endOf('day').subtract(1,'days')"],
            Yii::t('kvdrp', "Last {n} Days", ['n' => 7]) => ["moment().startOf('day').subtract(6, 'days')", "moment()"],
            Yii::t('kvdrp', "Last {n} Days", ['n' => 30]) => ["moment().startOf('day').subtract(29, 'days')", "moment()"],
            Yii::t('kvdrp', "This Month") => ["moment().startOf('month')", "moment().endOf('month')"],
            Yii::t('kvdrp', "Last Month") => ["moment().subtract(1, 'month').startOf('month')", "moment().subtract(1, 'month').endOf('month')"],
            Yii::t('kvdrp', "This Year") => ["moment().startOf('year')", "moment().endOf('year')"],
            Yii::t('kvdrp', "Last Year") => ["moment().subtract(1, 'year').startOf('year')", "moment().subtract(1, 'year').endOf('year')"],
        ]; 
	}
}