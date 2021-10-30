<?php
use yii\helpers\Html;

/* @var $this \yii\web\View */
/* @var $content string */

backend\assets\AppAsset::register($this);

if (Yii::$app->controller->action->id === 'login') { 
/**
 * Do not use this code in your template. Remove it. 
 * Instead, use the code  $this->layout = '//main-login'; in your controller.
 */
    echo $this->render(
        'main-login',
        ['content' => $content]
    );

} else {
    ?>
    <?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>

    <body class="skin-blue fixed sidebar-mini" style="height: auto; min-height: 100%;">
    <?php $this->beginBody() ?>
    <div class="wrapper" style="height: auto; min-height: 100%;">

        <?= $this->render('header.php') ?>

        <?= $this->render('left.php') ?>

        <!--右侧内容 开始-->
        <div id="admin_right" class="content-wrapper" style="padding-left: 10px;padding-right:10px;">
            <?= \dmstr\widgets\Alert::widget() ?>
            <?= $content ?>
        </div>
        <!--右侧内容 结束-->

        <!--顶部弹出菜单 开始-->
        <aside class="control-sidebar control-sidebar-dark">
            <ul class="control-sidebar-menu">
                <li><a href="/site/logout"><i class="fa fa-circle-o text-red"></i> 退出管理</a></li>
            </ul>
        </aside>
        <!--顶部弹出菜单 结束-->
    </div>
    <script>
        // 配置
        let config = {
            tag: "<?= Yii::$app->debris->backendConfig('sys_tags') ?? false; ?>",
            isMobile: "<?= Yii::$app->params['isMobile'] ?? false; ?>",
        };
    </script>
    <?= $this->render('footer') ?>
    <?php $this->endBody() ?>
    </body>
    </html>
    <?php $this->endPage() ?>
<?php } ?>
