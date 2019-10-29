<?php  
use yii\bootstrap\ActiveForm;
use yii\web\View;
use yii\helpers\Html;
use inspirenmy\config\Configurator;
$this->title = 'Setting';
?>
<div clas='table-responsive'>
	<div class="panel panel-default">
		<div class="panel-body">    

		<?php $form = ActiveForm::begin(['action' => ['setting/index'], 'id' => 'contact-form' ] ); ?>

			<?php foreach ($model->attributes as $attribute => $value): ?>
			 
			<?php if ($model->getAttributeModel($attribute)->type == Configurator::TYPE_BOOLEAN) { ?>

			<?= $form->field($model, $attribute)->widget('kartik\switchinput\SwitchInput',[
			'pluginOptions' => [
			    'defaultvalue' => 'off',
			    'animate' => false,
				] 
				])->label($model->getAttributeModel($attribute)->label == null ? 'Empty' : $model->getAttributeModel($attribute)->label); } ?>
			<?php endforeach ?>

		<?= Html::submitButton('Save',['class' =>'btn btn-primary']); ?>

		<?php ActiveForm::end(); ?>
		</div>
	</div>
</div>