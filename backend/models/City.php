<?php

namespace backend\models;

use Yii;



/**
* @PROPERTY_BEGIN 千万千万不要删除这行
属性占位符
* @PROPERTY_END  千万千万不要删除这行
*/
class City  extends \common\models\City{



    public function attributeLabels(){


        return parent::attributeLabels() + [
        
            'id' => '',

            
            'name' => '',

            
            'parent_id' => '',

            
            'sort' => '',

            
            'deep' => '',

                    ];
    }



    public function rules(){
        return [
            

                

                

                

                        ];
    }


}