<?php
use yii\helpers\Url;
use yii\helpers\Html;
$theme = $this->theme;
?>
<?php $this->beginContent('@app/views/layouts/main.php');?>

<?php if (isset($this->params['content-info-box'])): ?>
	<div class="row">
		<?php foreach ($this->params['content-info-box'] as $box): ?>
			<div class="col-md-3 col-sm-6 col-xs-12">
				<div class="info-box">
					<span class="info-box-icon bg-<?= $box['color'] ?>">
						<i class="fa fa-<?= $box['icon'] ?>"></i>
					</span>
					<div class="info-box-content">
						<span class="info-box-text"><?= $box['label'] ?></span>
						<span class="info-box-number"><?= $box['value'] ?><small></small></span>
						<?php if (isset($box['url'])): ?>
							<a href="<?= Url::to($box['url']) ?>" class="btn btn-xs btn-default">More Info</a>
						<?php endif ?>
					</div>
				</div>
			</div>
		<?php endforeach; ?>
	</div>
<?php endif; ?>

<div class="row">
<div class="col-xs-12">
	<div class="box">
		<?php if (isset($this->params['boxTitle'])): ?>
			<div class="box-header">
				<h3 class="box-title"><?= $this->params['boxTitle'] ?></h3>
			</div>
		<?php endif; ?>
		<div class="box-body">
			<div class="dt-bootstrap">
				<div class="row">
					<div class="col-sm-12"><?=$content;?></div>
				</div>
			</div>
		</div>
	</div>
</div>
</div>
<?php $this->endContent(); ?>
