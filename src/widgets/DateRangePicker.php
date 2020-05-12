<?php
namespace ant\widgets;

use Yii;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use kartik\daterange\MomentAsset;
use ant\widgets\assets\DateRangePickerAsset;

class DateRangePicker extends \kartik\daterange\DateRangePicker {
	const RANGE_BY_MONTH = 'byMonth';
	const RANGE_FUTURE = 'future';
	
	public $presetDropdown = true;
	public $hideInput = true;
	public $autoUpdateOnInit = false;
	public $convertFormat = true;
	public $rangePreset;
	public $validDate;
	
	public $clearButton = true;
	
	/*public function run() {
        $this->initSettings();
		//$this->view->registerCss('.kv-drp-dropdown .kv-clear { display:none; }');
		
		if ($this->clearButton) {
			return Html::tag('div', $this->renderInput().$this->renderClearButton(), ['class' => 'input-group active-readonly']);
		} else {
			return $this->renderInput();
		}
	}*/
	
	public function init() {
		parent::init();
        $css = $this->useWithAddon && !$this->presetDropdown && !$this->hideInput ? ' input-group' : '';
		Html::addCssClass($this->containerOptions, 'kv-drp-container active-readonly' . $css);
		$this->initPluginOptions();
	}
	
	protected function initPluginOptions() {
		if (!isset($this->pluginOptions['locale']['format'])) {
			$this->pluginOptions['locale']['format'] = 'Y-m-d';
		}
		
		if (isset($this->validDate) && !isset($this->pluginOptions['isInvalidDate'])) {
			$this->pluginOptions['isInvalidDate'] = new \yii\web\JsExpression("function(date) {
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
			}");
		}
		
		if (isset($this->rangePreset) && !isset($this->pluginOptions['ranges'])) {
			$this->pluginOptions['ranges'] = $this->getDateTimeRangePreset($this->rangePreset);
		}
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
			
			return Html::tag('div', Html::button('<i class="fa fa-times"></i>', ['id' => $buttonId, 'class' => 'btn btn-default']), ['class' => 'input-group-btn input-group-append']);
		}
	}
	
	public function registerAssets()
    {
        $view = $this->getView();
        MomentAsset::register($view);
        $input = 'jQuery("#' . $this->options['id'] . '")';
        $id = $input;
        if ($this->hideInput) {
            $id = 'jQuery("#' . $this->containerOptions['id'] . '")';
        }
        if (!empty($this->_langFile)) {
            LanguageAsset::register($view)->js[] = $this->_langFile;
        }
        DateRangePickerAsset::register($view);
        $rangeJs = '';
        if (empty($this->callback)) {
            $val = "start.format('{$this->_format}') + '{$this->_separator}' + end.format('{$this->_format}')";
            if (ArrayHelper::getValue($this->pluginOptions, 'singleDatePicker', false)) {
                $val = "start.format('{$this->_format}')";
            }
            $rangeJs = $this->getRangeJs('start') . $this->getRangeJs('end');
            $change = "{$input}.val(val).trigger('change');{$rangeJs}";
            if ($this->presetDropdown) {
                $id = "{$id}.find('.kv-drp-dropdown')";
            }
            if ($this->hideInput) {
                $script = "var val={$val};{$id}.find('.range-value').val(val);{$change}";
            } elseif ($this->useWithAddon) {
                $id = "{$input}.closest('.input-group')";
                $script = "var val={$val};{$change}";
            } elseif (!$this->autoUpdateOnInit) {
                $script = "var val={$val};{$change}";
            } else {
                $this->registerPlugin($this->pluginName, $id);
                return;
            }
            $this->callback = "function(start,end,label){{$script}}";
        }
        $nowFrom = "moment().startOf('day').format('{$this->_format}')";
        $nowTo = "moment().format('{$this->_format}')";
        // parse input change correctly when range input value is cleared
        $js = <<< JS
{$input}.off('change.kvdrp').on('change.kvdrp', function(e) {
    var drp = {$id}.data('{$this->pluginName}'), fm, to;
    if ($(this).val() || !drp) {
        return;
    }
    fm = {$nowFrom} || '';
    to = {$nowTo} || '';
    drp.setStartDate(fm);
    drp.setEndDate(to);
    {$rangeJs}
});
JS;
        if ($this->presetDropdown) {
            $js .= <<< JS
    {$id}.on('apply.daterangepicker', function() {
        var drp = {$id}.data('{$this->pluginName}'), newValue = drp.startDate.format(drp.locale.format);
        if (!drp.singleDatePicker) {
            newValue += drp.locale.separator + drp.endDate.format(drp.locale.format);
        }
        if (newValue !== {$input}.val()) {
            {$input}.val(newValue).trigger('change');
        }
    });            
    {$id}.find('.range-value').attr('placeholder', {$input}.attr('placeholder'));
    {$id}.find('.kv-clear').on('click', function(e) {
        e.stopPropagation();
        {$id}.find('.range-value').val('');
        {$input}.val('').trigger('change').trigger('cancel.daterangepicker');
    });
JS;
        }
        $view->registerJs($js);
        $this->registerPlugin($this->pluginName, $id, null, $this->callback);
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
		} else if ($preset == self::RANGE_FUTURE) {
			return [
				Yii::t('kvdrp', "Today") => ["moment().startOf('day')", "moment()"],
				Yii::t('kvdrp', "Tomorrow") => ["moment().startOf('day').add(1,'days')", "moment().endOf('day').add(1,'days')"],
				Yii::t('kvdrp', "Next {n} Days", ['n' => 7]) => ["moment()", "moment().startOf('day').add(6, 'days')"],
				Yii::t('kvdrp', "Next {n} Days", ['n' => 30]) => ["moment()", "moment().startOf('day').add(29, 'days')"],
				Yii::t('kvdrp', "This Month") => ["moment().startOf('month')", "moment().endOf('month')"],
				Yii::t('kvdrp', "Next Month") => ["moment().add(1, 'month').startOf('month')", "moment().add(1, 'month').endOf('month')"],
				Yii::t('kvdrp', "This Year") => ["moment().startOf('year')", "moment().endOf('year')"],
				Yii::t('kvdrp', "Next Year") => ["moment().add(1, 'year').startOf('year')", "moment().add(1, 'year').endOf('year')"],
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