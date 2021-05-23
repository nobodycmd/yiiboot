<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;


/**
* @property  varchar  item_name      
* @property  varchar  user_id      
* @property  int  created_at      
*/
class AuthAssignment  extends \yii\db\ActiveRecord {



    public function behaviors()
    {
        $ary = parent::behaviors();

        return $ary;
    }



    public static function tableName(){
        return 'auth_assignment';
    }


    public function setAttributes($values, $safeOnly = false)
    {
        parent::setAttributes($values, false);
    }



}