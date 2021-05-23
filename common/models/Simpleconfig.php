<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;


/**
* @property  int  id      
* @property  char  name  名称    
* @property  char  label  显示名称    
* @property  text  value  值    
*/
class Simpleconfig  extends \yii\db\ActiveRecord {



    public function behaviors()
    {
        $ary = parent::behaviors();

        return $ary;
    }



    public static function tableName(){
        return 'simpleconfig';
    }


    public function setAttributes($values, $safeOnly = false)
    {
        parent::setAttributes($values, false);
    }



}