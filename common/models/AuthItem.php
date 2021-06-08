<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;


/**
* @property  string  $name name      
* @property  integer  $type type      
* @property  text  $description description      
* @property  string  $rule_name rule_name      
* @property  blob  $data data      
* @property  integer  $created_at created_at      
* @property  integer  $updated_at updated_at      
*/
class AuthItem  extends \yii\db\ActiveRecord {



    public function behaviors()
    {
        $ary = parent::behaviors();
        $ary[] = [
            'class' => TimestampBehavior::className(),
            'attributes' => [
            ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
            ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
            ],
            // if you're using datetime instead of UNIX timestamp:
            // 'value' => new Expression('NOW()'),
        ];

    
        return $ary;
    }



    public static function tableName(){
        return 'auth_item';
    }


    public function setAttributes($values, $safeOnly = false)
    {
        parent::setAttributes($values, false);
    }



}