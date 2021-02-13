<?php
/* @var $this \yii\web\View */
/* @var $content string */
use yii\helpers\ArrayHelper;
use yii\widgets\Breadcrumbs;
use ant\widgets\Tabs;
?>
<?php $this->beginContent('@app/views/layouts/base.php') ?>
	<?php if (isset($this->blocks['content-header-buttons'])): ?>
		<?= $this->blocks['content-header-buttons'] ?>
	<?php elseif (isset($this->params['content-header-buttons'])): ?>
		<div class="content-header-buttons mb-4">
			<?php foreach ($this->params['content-header-buttons'] as $element): ?>
				<?= $element ?>
			<?php endforeach ?>
		</div>
	<?php endif ?>

	<div class="row">
		<div class="col-12">
			<?= $this->blocks['actions'] ?? '' ?>
		</div>
	</div>
	
	<?= \ant\themes\adminlte3\widgets\Alert::widget() ?>

	<?= $this->blocks['header'] ?? '' ?>

	<?= Tabs::widget([
		'items' => Yii::$app->menu->getMenu(Yii::$app->request->get('tab')),
	]) ?>
	
	<?= $content ?>
<?php $this->endContent() ?>
