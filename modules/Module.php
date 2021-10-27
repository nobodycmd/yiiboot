<?php
namespace modules;

use common\helpers\ArrayHelper;

class Module extends \yii\base\Module
{
    public function init($autoMapControllerNamespaceAccordToAppId = true)
    {
        $class = get_class($this);

        $aryNames = explode('\\',$class);
        array_pop($aryNames);
        $moduleName = array_pop($aryNames);

        //指定控制器命名空间
        parent::init();

        //指定模块的配置文件
        if($autoMapControllerNamespaceAccordToAppId) {
            $pos = strrpos($class, '\\');
            $this->controllerNamespace = substr($class, 0, $pos) . '\\' . strtolower(\Yii::$app->id) . '\\controllers';
        }


        $c1 = $c2 = [];
        $moduleCommonConfigFile = \Yii::getAlias('@modules/'.$moduleName.'/config/common.php');
        $moduleSpecialConfigFile = \Yii::getAlias('@modules/'.$moduleName.'/config/'.\Yii::$app->id.'.php');
        if(file_exists($moduleCommonConfigFile)){
            $c1 = include $moduleCommonConfigFile;
        }
        if(file_exists($moduleSpecialConfigFile)){
            $c2 = include $moduleSpecialConfigFile;
        }
        //https://www.yiiframework.com/doc/guide/2.0/zh-cn/structure-modules
        // 从config.php 加载配置来初始化模块
        //config.php 配置文件 类似 应用主体配置。
        \Yii::configure($this, ArrayHelper::merge($c1,$c2));
    }

}