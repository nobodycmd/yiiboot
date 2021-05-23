<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;


/**
* @property  varchar  name      
* @property  smallint  type      
* @property  text  description      
* @property  varchar  rule_name      
* @property  blob  data      
* @property  int  created_at      
* @property  int  updated_at      
*/
class AuthItem  extends \yii\db\ActiveRecord {



    public function behaviors()
    {
        $ary = parent::behaviors();
        $ary[] = [
        [
            'class' => TimestampBehavior::className(),
            'attributes' => [
            ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
            ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
            ],
            // if you're using datetime instead of UNIX timestamp:
            // 'value' => new Expression('NOW()'),
            ],
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