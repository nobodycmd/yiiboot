<?php

namespace backend\models;

use Yii;



/**
* @PROPERTY_END
* @property  int  id  
* @property  char  name  名称
* @property  char  label  显示名称
* @property  text  value  值

auto replace propery at 2021-05-23 00:57:52
*/
class Simpleconfig  extends \common\models\Simpleconfig{



    public function attributeLabels(){
        return [
        
            'id' => '',

            
            'name' => '名称',

            
            'label' => '显示名称',

            
            'value' => '值',

                    ];
    }



    public function rules(){
        return [
            

                                    [ ['id'] , 'required' ],
                    

                                    [ ['id'] , 'integer' ],
                    


                


                

                                    [ ['name'] , 'required' ],
                    

                


                                    [ ['name'] , 'string', 'min'=>0,'max'=> 200],
                    


                

                

                        ];
    }


}