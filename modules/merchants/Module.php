<?php
namespace modules\merchants;

use Yii;
use yii\base\Application;
use yii\base\BootstrapInterface;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\caching\TagDependency;
use modules\wechat\models\Wechat;
use modules\wechat\helpers\ModuleHelper;
use modules\wechat\components\BaseModule;
use modules\wechat\models\Module as ModuleModel;


class Module extends \modules\Module implements BootstrapInterface
{

    public function bootstrap($app)
    {
        $config = [];
        if(file_exists('config.php')){
            $config = include 'config.php';
        }
        $this->modules = isset($config['modules']) ? $config['modules'] : [];
    }
}
