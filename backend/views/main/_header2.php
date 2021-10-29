<?php
use yii\helpers\Html;
use \mdm\admin\components\MenuHelper;

/* @var $this \yii\web\View */
/* @var $content string */


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

$items = MenuHelper::getAssignedMenu(Yii::$app->user->id,null, function($menu){
    return $menu;
});
?>


<script>
    function loadLeftMenu(that,id){
        $.ajax({
            url:'/site/left-menu?id='+id,
            success:function (html) {
                document.getElementById('admin_left').outerHTML = html;
            }
        })
        $(that).parent().find('li').removeClass('active');
        $(that).addClass('active');
    }
</script>


<header class="main-header">
    <div class="logo">
        <span class="logo-mini"><b>power</b></span>
        <span class="logo-lg"><b>power</b>后台管理</span>
    </div>
    <nav class="navbar navbar-static-top">
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only"></span>
        </a>


        <div id="menu" class="navbar-custom-menu">

            <ul class="nav navbar-nav" name="topMenu">

                <?php foreach ($items as $one): ?>
                    <li class="<?= $theCorrectTopMenu && $one['id'] == $theCorrectTopMenu->id ? 'active':'' ?>"><a hidefocus="true" onclick="loadLeftMenu(this,<?= $one['id'] ?>)"><?= $one['name'] ?></a></li>
                <?php
                endforeach;
                ?>

                <li><a href="/admin/route">路由</a></li>
                <li><a href="/admin/permission"><i class="fa fa-circle-o"></i> 权限</a></li>
                <li><a href="/admin/role"><i class="fa fa-circle-o"></i> 角色</a></li>
                <li><a href="/admin/assignment"><i class="fa fa-circle-o"></i> 分配</a></li>
                <li><a href="/admin/menu"><i class="fa fa-circle-o"></i> 菜单</a></li>

                <li><a hidefocus="true" href="<?= \common\helpers\Url::to('/package/index','') ?>">扩展管理</a></li>
                <li><a hidefocus="true" href="<?= \common\helpers\Url::to('/common/config','') ?>">配置管理</a></li>

                <li>
                    <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                </li>
            </ul>

        </div>

    </nav>
</header>
