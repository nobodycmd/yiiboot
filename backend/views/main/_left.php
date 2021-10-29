<?php
use common\helpers\ImageHelper;
use common\widgets\menu\MenuLeftWidget;


if(isset($theCorrectTopMenu) == false){
    $path = Yii::$app->request->getPathInfo();
    if ($path) {
        $theCorrectTopMenu = \backend\models\AdminMenu::findOne([
            'route' => '/' . $path,
        ]);
    } else {
        $theCorrectTopMenu = \backend\models\AdminMenu::find()->where([])->one();
    }
    while ($theCorrectTopMenu && $theCorrectTopMenu->parent){
        $theCorrectTopMenu = \backend\models\AdminMenu::findOne($theCorrectTopMenu->parent);
    }
}

$items = \mdm\admin\components\MenuHelper::getAssignedMenu(Yii::$app->user->id,$theCorrectTopMenu ? $theCorrectTopMenu->id : null);

?>

<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img class="img-circle head_portrait" src="<?= ImageHelper::defaultHeaderPortrait(''); ?>"/>
            </div>
            <div class="pull-left info">
                <p><?= $manager->username; ?></p>
                <a href="#">
                    <i class="fa fa-circle text-success"></i>
                    ip:<?= Yii::$app->request->getUserIP() ?>
                </a>
            </div>
        </div>
        <!-- 侧边菜单 -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header" data-rel="external">系统菜单</li>
            <?php
            //echo MenuLeftWidget::widget();
            ?>


            <?php
            echo \dmstr\widgets\Menu::widget([
                'options' => [
                    'class' => 'sidebar-menu tree',
                    'data-widget' => 'tree',
                    'id' => 'leftNavSpace',
                ],
                'items' => $items,
            ])
            ?>


            <?php if (Yii::$app->debris->backendConfig('sys_related_links') == true){ ?>
                <li class="header" data-rel="external">快捷访问</li>
                <li><a href="http://www.baidu.com" target="_blank"><i class="fa fa-bookmark text-red"></i> <span>百度</span></a></li>
            <?php } ?>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>