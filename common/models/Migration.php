<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;


/**
* @property  varchar  version      
* @property  int  apply_time      
*/
class Migration  extends \yii\db\ActiveRecord {



    public function behaviors()
    {
        $ary = parent::behaviors();

        return $ary;
    }



    public static function tableName(){
        return 'migration';
    }


    public function setAttributes($values, $safeOnly = false)
    {
        parent::setAttributes($values, false);
    }



}