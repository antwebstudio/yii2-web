<?php
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
?>
<div class="page-header">
	<div class="pull-left">
		<h1 class="heading heading-primary margin-bottom-md"><?= Html::encode($this->title) ?></h1>
	</div>

	<div class="pull-right">
	<?php if (isset($this->params['headerRightPanel'])): ?>
	<?php foreach ($this->params['headerRightPanel'] as $element): ?>
	<?=$element?>
	<?php endforeach ?>
	<?php endif ?>
	</div>

	<div class="clearfix"></div>

	<?= Breadcrumbs::widget([
		'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
	]) ?> 
</div>