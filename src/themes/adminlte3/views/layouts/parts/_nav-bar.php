<?php 
use yii\helpers\Url;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;

$items = isset(\Yii::$app->menu) ? \Yii::$app->menu->getMenu('shortcut') : [];
array_unshift($items, [
	'encode' => false,
	'url' => '#',
	'label' => '<i class="fas fa-bars"></i>',
	'options' => ['data-widget' => 'pushmenu', 'class' => 'd-block'],
]);
?>
<style>
.navbar-nav>.user-menu>.nav-link:after { content: ""; }
</style>
<!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
	<?= \yii\widgets\Menu::widget([
		'options' => ['class' => 'navbar-nav'],
		'linkTemplate' => '<a class="nav-link" href="{url}">{label}</a>',
		//'submenuTemplate' => "\n<ul class=\"treeview-menu\">\n{items}\n</ul>\n",
		'activateParents' => true,
		'itemOptions' => ['class' => 'nav-item d-none d-sm-inline-block'],
		'items' => $items,
	]) ?>
	
	<?php /*
    <ul class="navbar-nav">
      <li class="nav-item" data-widget="pushmenu" >
        <a class="nav-link" href="#"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="index3.html" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contact</a>
      </li>
    </ul>
	*/ ?>

    <!-- SEARCH FORM -->
	<?php /*
    <form class="form-inline ml-3">
      <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-navbar" type="submit">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div>
    </form>
	*/?>

    <!-- Right navbar links -->
	
	<div class="navbar-nav ml-auto">
		<!-- User Account: style can be found in dropdown.less -->

		<div class="dropdown user user-menu nav-item">
			<a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
				<img src="<?= Yii::$app->user->identity->getAvatar($themeBaseURL . '/images/boy.png') ?>" class="user-image" alt="User Image"/>
				<span class="hidden-xs"><?= Yii::$app->user->identity->username ?></span>
			</a>
			<ul class="dropdown-menu dropdown-menu-right">
				<!-- User image -->
				<li class="user-header">
					<img src="<?= Yii::$app->user->identity->getAvatar($themeBaseURL . '/images/boy.png') ?>" class="img-circle" alt="User Image"/>
					<p>
						<?= Yii::$app->user->identity->username ?> - <?= implode(', ', ArrayHelper::map(Yii::$app->user->identity->roles, 'name', 'name')) ?>
						<?php /*
						<small>Member since Nov. 2012</small>
						*/?>
					</p>
				</li>
				<!-- Menu Footer-->
				<li class="user-footer">
					<div class="float-left">
						<a href= <?= Url::to(['/user/backend/setting/password'])  ?> class="btn btn-default btn-flat">Change Password</a>
					</div>
					<div class="float-right">
						<?= Html::a('Sign out', ['/site/logout'], ['data-method' => 'post', 'class' => 'btn btn-default btn-flat']) ?>
					</div>
				</li>
			</ul>
		</div>
	</div>
		
	<?php /*
    <ul class="navbar-nav ml-auto">
      <!-- Messages Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-comments"></i>
          <span class="badge badge-danger navbar-badge">3</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="dist/img/user1-128x128.jpg" alt="User Avatar" class="img-size-50 mr-3 img-circle">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  Brad Diesel
                  <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">Call me whenever you can...</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="dist/img/user8-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  John Pierce
                  <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">I got your message bro</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="dist/img/user3-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  Nora Silvester
                  <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">The subject goes here</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
        </div>
      </li>
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge">15</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header">15 Notifications</span>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-envelope mr-2"></i> 4 new messages
            <span class="float-right text-muted text-sm">3 mins</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-users mr-2"></i> 8 friend requests
            <span class="float-right text-muted text-sm">12 hours</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-file mr-2"></i> 3 new reports
            <span class="float-right text-muted text-sm">2 days</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#">
          <i class="fas fa-th-large"></i>
        </a>
      </li>
    </ul>
	*/ ?>
  </nav>
  <!-- /.navbar -->