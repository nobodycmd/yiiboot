<?php
namespace common\controllers;


/**
 * 提供数据批量以目录作为单位向前迁移
 * Class MigrateController
 * @package common\controllers
 */
class MigrateController extends \yii\console\controllers\MigrateController{

    public function stdout($string){}

    public function confirm($message, $default = false)
    {
        return true;
    }

}