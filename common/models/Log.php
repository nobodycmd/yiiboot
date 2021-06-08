<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;


/**
* @property  integer  $id id      
* @property  integer  $level level      
* @property  string  $category category      
* @property  double  $log_time log_time      
* @property  text  $prefix prefix      
* @property  text  $message message      
*/
class Log  extends \yii\db\ActiveRecord {



    public function behaviors()
    {
        $ary = parent::behaviors();

        return $ary;
    }



    public static function tableName(){
        return 'log';
    }


    public function setAttributes($values, $safeOnly = false)
    {
        parent::setAttributes($values, false);
    }



}