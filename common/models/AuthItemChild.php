<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;


/**
* @property  string  $parent parent      
* @property  string  $child child      
*/
class AuthItemChild  extends \yii\db\ActiveRecord {



    public function behaviors()
    {
        $ary = parent::behaviors();

        return $ary;
    }



    public static function tableName(){
        return 'auth_item_child';
    }


    public function setAttributes($values, $safeOnly = false)
    {
        parent::setAttributes($values, false);
    }



}