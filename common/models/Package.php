<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;


/**
* @property  integer  $id id      
* @property  string  $name name  name    
* @property  string  $class class  标示    
* @property  integer  $type type  1:module 2:plugin    
* @property  string  $bootstrap bootstrap  模块初始化应用ID    
* @property  integer  $is_install is_install  1:已安装 0：未安装    
* @property  integer  $is_open is_open  1:开 0：关    
* @property  text  $config config  配置    
* @property  integer  $created_at created_at      
* @property  integer  $updated_at updated_at      
*/
class Package  extends \yii\db\ActiveRecord {



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
        return 'package';
    }


    public function setAttributes($values, $safeOnly = false)
    {
        parent::setAttributes($values, false);
    }



}