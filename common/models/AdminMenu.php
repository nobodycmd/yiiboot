<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;


/**
* @property  integer  $id id      
* @property  string  $name name      
* @property  integer  $parent parent      
* @property  string  $route route      
* @property  integer  $order order      
* @property  blob  $data data      
*/
class AdminMenu  extends \yii\db\ActiveRecord {



    public function behaviors()
    {
        $ary = parent::behaviors();

        return $ary;
    }



    public static function tableName(){
        return 'admin_menu';
    }


    public function setAttributes($values, $safeOnly = false)
    {
        parent::setAttributes($values, false);
    }



}