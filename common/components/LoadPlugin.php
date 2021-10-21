<?php
namespace common\components;

use common\models\Package;
use Yii;
use yii\base\BootstrapInterface;
use yii\base\Component;

class LoadPlugin extends Component implements BootstrapInterface
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
            'type' => 2,
            'is_install' => 1,
            'is_open' => 1,
        ]);
        foreach ($all as $model) {
            $plugin = Yii::createObject([
                'class' => $model->class,
            ]);
            if (method_exists($plugin, 'bootstrap') || $plugin instanceof BootstrapInterface) {
                $plugin->bootstrap($app);
            }
        }

    }
}