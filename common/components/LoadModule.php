<?php
namespace common\components;

use common\models\Package;
use Yii;
use yii\base\BootstrapInterface;
use yii\base\Component;
use yii\helpers\ArrayHelper;

class LoadModule extends Component implements BootstrapInterface
{
    public function bootstrap($app)
    {
        $appId = $app->id;

        //因为console需要进行表迁移
        //系统初始化前，package表都不存在
        if($appId == 'console'){
            $aryTableName = [];
            $aryTables = $app->getDb()->createCommand('show tables')->queryAll();
            foreach ($aryTables as $kvDbAndTableName){
                foreach ($kvDbAndTableName as $tableName){
                    $aryTableName[] = $tableName;
                }
            }
            if(in_array(Package::tableName(),$aryTableName) == false)
                return;
        }

        $all = Package::findAll([
            'type' => 1,
            'is_install' => 1,
            'is_open' => 1,
        ]);
        foreach ($all as $model) {
            $aryName = explode('\\', $model->class);
            $id = $aryName[count($aryName) - 2];
            $this->setModule($id, [
                'class' => $model->class,
            ]);


            if ($model->bootstrap == '*') {
                $bootstraps = ['frontend', 'backend', 'api', 'console'];
            } else {
                $bootstraps = explode("|", $model->bootstrap);
            }

            $isInIt = in_array($appId, $bootstraps);

            if ($isInIt) {
                $module = \Yii::$app->getModule($model->id);
                if ($module instanceof BootstrapInterface) {
                    $module->bootstrap($app);
                }
            }
        }
    }

    //设置模块，同时避免破坏已同名的模版配置
    public function setModule($id, $config)
    {
        $definitions = \Yii::$app->getModules();
        Yii::$app->setModule($id,
            ArrayHelper::merge($config, array_key_exists($id, $definitions) ? $definitions[$id] : [])
        );
    }

}