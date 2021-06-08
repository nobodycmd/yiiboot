<?php

namespace backend\models;

use Yii;



/**
* @PROPERTY_BEGIN 千万千万不要删除这行
属性占位符
* @PROPERTY_END  千万千万不要删除这行
*/
class AdminMenu  extends \common\models\AdminMenu{



    public function attributeLabels(){
        return [
        
            'id' => '',

            
            'name' => '',

            
            'parent' => '',

            
            'route' => '',

            
            'order' => '',

            
            'data' => '',

                    ];
    }



    public function rules(){
        return [
            

                                    [ ['name'] , 'required' ],
                    

                


                                    [ ['name'] , 'string', 'min'=>0,'max'=> 128],
                    


                

                

                

                

                        ];
    }


}