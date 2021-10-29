<?php
namespace modules;

use common\helpers\ArrayHelper;

abstract class Module extends \yii\base\Module
{
    //是否自动结合主体应用的app id进行空间赋值
    public $autoMapControllerNamespaceAccordToAppId = true;

    public function init()
    {
        $class = get_class($this);

        $aryNames = explode('\\',$class);
        array_pop($aryNames);
        $moduleName = array_pop($aryNames);

        //默认的controllers命名空间
        parent::init();

        //找到了对应的目录
        //即有和模块对应的controllers命名空间
        if(
            is_dir(\Yii::getAlias('@modules/'.$moduleName . '/' .strtolower(\Yii::$app->id).'/controllers'))
            && $this->autoMapControllerNamespaceAccordToAppId
        ) {
            $pos = strrpos($class, '\\');
            $this->controllerNamespace = substr($class, 0, $pos) . '\\' . strtolower(\Yii::$app->id) . '\\controllers';
        }

        $c1 = $c2 = [];
        $moduleCommonConfigFile = \Yii::getAlias('@modules/'.$moduleName.'/common/config/main.php');
        $moduleSpecialConfigFile = \Yii::getAlias('@modules/'.$moduleName.'/common/config/'.\Yii::$app->id.'.php');
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