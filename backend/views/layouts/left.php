
<?php
use yii\helpers\Html;

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

$items = \mdm\admin\components\MenuHelper::getAssignedMenu(Yii::$app->user->id,$theCorrectTopMenu ? $theCorrectTopMenu->id : null);

?>


<!--左侧菜单 开始-->
<aside id="admin_left" class="main-sidebar">
    <section class="sidebar" style="height: auto;">
        <div class="user-panel">
            <div class="pull-left image">
                <i class="fa fa-user"></i>
            </div>
            <div class="pull-left info">
                <p><?= Yii::$app->getUser()->getIdentity()?Yii::$app->getUser()->getIdentity()->username:'游客' ?></p>
            </div>
        </div>

        <?php
        echo dmstr\widgets\Menu::widget([
                'options' => [
                    'class' => 'sidebar-menu tree',
                    'data-widget' => 'tree',
                    'id' => 'leftNavSpace',
                ],
                'items' => $items,
        ])
        ?>


        <ul class="sidebar-menu tree" data-widget="tree">
            <li class="header">快速导航</li>
            <li><a href=""><i class="fa fa-star-o"></i> <span>{$item['naviga_name']}</span></a></li>
        </ul>

    </section>
</aside>
<!--左侧菜单 结束-->


<script type="text/javascript">
    $(function () {
        var params = window.location.pathname;
        params = params.toLowerCase();

        if (params != "/") {
            $("#leftNavSpace li a").each(function (i) {
                var obj = this;
                var url = $(this).attr("href");
                if (url == "" || url == "#") {
                    return true;
                }
                url = url.toLowerCase();
                if (url.indexOf(params) > -1) {
                    $(this).parent().addClass("active open menu-open");
                    $(this).parent().parent().addClass("active open menu-open");
                    $(this).parent().parent().parent().addClass("active open menu-open");
                    $(this).parent().parent().parent().parent().addClass("active open menu-open");
                    $(this).parent().parent().parent().parent().parent().addClass("active open menu-open");
                    return false;
                }
            });
        }
    });
</script>