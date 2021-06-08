<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;


/**
* @property  integer  $id id      
* @property  string  $name name  名称    
* @property  string  $label label  显示名称    
* @property  text  $value value  值    
* @property  integer  $created_at created_at      
* @property  integer  $updated_at updated_at      
*/
class Simpleconfig  extends \yii\db\ActiveRecord {



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
        return 'simpleconfig';
    }


    public function setAttributes($values, $safeOnly = false)
    {
        parent::setAttributes($values, false);
    }



}