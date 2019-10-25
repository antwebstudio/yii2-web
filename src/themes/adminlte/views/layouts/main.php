<?php
use yii\helpers\Html;
use yii\helpers\ArrayHelper;

//$appBundle = \backend\assets\AppAsset::register($this);
//$adminLtePluginBundle = \backend\themes\adminlte\assets\AdminLtePluginAsset::register($this);
//$themeBundle = \backend\themes\adminlte\assets\ThemeAsset::register($this);

//$this->theme->setBaseUrl($themeBundle->baseUrl);
//$this->theme->setBasePath($themeBundle->basePath);

$renderParams =
[
    'themeBaseURL' => $this->theme->baseUrl,
    'adminlteBaseUrl' => Yii::$app->assetManager->getPublishedUrl('@vendor/almasaeed2010/adminlte/dist'),
];
?>

<?php $this->beginContent('@app/views/layouts/base.php', ['body' => ['class' => ['hold-transition',  'skin-black-light', 'sidebar-mini']]]) ?>

<div class="wrapper">

<?= $this->render('_header.php', $renderParams); ?>

<?= $this->render('_left.php', $renderParams); ?>

<?= $this->render('_content.php', ArrayHelper::merge(['content' => $content], $renderParams)); ?>

</div>

<?php $this->endContent();
