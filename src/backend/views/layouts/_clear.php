<?php
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
/* @var $this \yii\web\View */
/* @var $content string */

//\backend\assets\AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?php echo Yii::$app->language ?>">
<head>
    <meta charset="<?php echo Yii::$app->charset ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <?php echo Html::csrfMetaTags() ?>
</head>
<?= Html::beginTag('body', ArrayHelper::merge(['class' => isset($this->theme->skin) ? $this->theme->skin : ''], isset($body) ? $body : [])); ?>
<?php $this->beginBody() ?>
    <?php echo $content ?>
<?php $this->endBody() ?>
<?= Html::endTag('body'); ?>
</html>
<?php $this->endPage() ?>
