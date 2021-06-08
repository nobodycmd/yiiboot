<?php

namespace backend\models;

use Yii;



/**
* @PROPERTY_BEGIN 千万千万不要删除这行
属性占位符
* @PROPERTY_END  千万千万不要删除这行
*/
class Package  extends \common\models\Package{



    public function attributeLabels(){


        return parent::attributeLabels() + [
        
            'id' => '',

            
            'class' => '标示',

            
            'type' => '1:module 2:plugin',

            
            'bootstrap' => '模块初始化应用ID',

            
            'is_install' => '1:已安装 0：未安装',

            
            'is_open' => '1:开 0：关',

            
            'config' => '配置',

            
            'created_at' => '',

            
            'updated_at' => '',

                    ];
    }



    public function rules(){
        return [
            

                

                                    [ ['type'] , 'required' ],
                    

                                    [ ['type'] , 'integer' ],
                    


                


                

                

                                    [ ['is_install'] , 'required' ],
                    

                                    [ ['is_install'] , 'integer' ],
                    


                


                

                                    [ ['is_open'] , 'required' ],
                    

                                    [ ['is_open'] , 'integer' ],
                    


                


                

                

                                    [ ['created_at'] , 'required' ],
                    

                                    [ ['created_at'] , 'integer' ],
                    


                


                

                                    [ ['updated_at'] , 'required' ],
                    

                                    [ ['updated_at'] , 'integer' ],
                    


                


                        ];
    }


}