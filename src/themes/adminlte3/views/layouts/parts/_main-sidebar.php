<?php
$bundle = \ant\themes\adminlte3\assets\AdminLteAsset::register($this);
?>
<!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?= Yii::$app->request->baseUrl ?>" class="brand-link">
      <img src="<?= $bundle->baseUrl.'/img/AdminLTELogo.png' ?>" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light"><?= Yii::$app->name ?></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
		<?php /*
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="<?= $bundle->baseUrl.'/img/user2-160x160.jpg' ?>" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Alexander Pierce</a>
        </div>
      </div>
		*/?>
	  
      <nav class="mt-2">
		<?= \ant\themes\adminlte3\widgets\Menu::widget([
			'items' => isset(\Yii::$app->menu) ? \Yii::$app->menu->getMainMenu() : [],
		]) ?>
      </nav>
	  
	  <?php /*
	  <?= $this->render('_example-main-sidebar') ?>
	  */ ?>
	  
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>