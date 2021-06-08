<?php

namespace backend\models;

use Yii;



/**
* @PROPERTY_BEGIN 千万千万不要删除这行
属性占位符
* @PROPERTY_END  千万千万不要删除这行
*/
class Module  extends \common\models\Module{



    public function attributeLabels(){

        return parent::attributeLabels() + [
        
            'id' => '',

            
            'name' => '名称',

            
            'bootstrap' => '显示名称',

            
            'status' => '是否启用 1:启用 0：不启用',

            
            'config' => '配置',

            
            'created_at' => '',

            
            'updated_at' => '',

                    ];
    }



    public function rules(){
        return [
            

                                    [ ['name'] , 'required' ],
                    

                


                                    [ ['name'] , 'string', 'min'=>0,'max'=> 200],
                    


                

                

                

                

                                    [ ['created_at'] , 'required' ],
                    

                                    [ ['created_at'] , 'integer' ],
                    


                


                

                                    [ ['updated_at'] , 'required' ],
                    

                                    [ ['updated_at'] , 'integer' ],
                    


                


                        ];
    }


}