<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                 <img src="<?=Yii::$app->user->identity->getAvatar($themeBaseURL . '/images/boy.png');?>" class="img-circle" alt="User Image"/> 
            </div>
            <div class="pull-left info">
                <p><?=Yii::$app->user->identity->username;?></p>

                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search..."/>
              <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form>
        <!-- /.search form -->

        <?= dmstr\widgets\Menu::widget([
			'options' => ['class' => 'sidebar-menu', 'data-widget' => 'tree'],
			/*'linkTemplate' => '<a href="{url}">{icon}<span>{label}</span>{right-icon}{badge}</a>',
			'submenuTemplate' => "\n<ul class=\"treeview-menu\">\n{items}\n</ul>\n",
			'activateParents' => true,*/
			'items' => isset(\Yii::$app->menu) ? \Yii::$app->menu->getMainMenu() : [],
		]) ?>

    </section>

</aside>
