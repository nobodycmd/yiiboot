<?php
namespace plugins\donation;


use plugin\donation\controllers\AdminController;
use plugin\donation\controllers\DefaultController;
use yii\web\View;
use plugin\donation\migrations\Migrate;

class Plugin extends \plugins\Plugin
{
    public $info = [
        'author' => 'rongfang',
        'version' => 'v1.0',
        'id' => 'donation',
        'name' => '捐赠',
        'description' => '捐赠插件'
    ];

    public function frontend($app)
    {
        $app->controllerMap['donation'] = [
            'class' => DefaultController::className(),
            'viewPath' => '@plugin/donation/views/default'
        ];
    }

    public function backend($app)
    {
        $app->controllerMap['donation'] = [
            'class' => AdminController::className(),
            'viewPath' => '@plugin/donation/views/admin'
        ];
    }

    public function install()
    {
        if (parent::install()) {
            $class = new Migrate();
            $class->up();
            $this->addMenu('捐赠', '/donation/index');
            return true;
        }
        return false;
    }

    public function uninstall()
    {
        if (parent::uninstall()) {
            $class = new Migrate();
            $class->down();
            $this->deleteMenu('捐赠');
            return true;
        }
        return false;
    }
}