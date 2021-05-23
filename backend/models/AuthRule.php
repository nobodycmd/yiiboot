<?php

namespace backend\models;

use Yii;



/**
* @PROPERTY_END
* @property  varchar  name  
* @property  blob  data  
* @property  int  created_at  
* @property  int  updated_at  

auto replace propery at 2021-05-23 00:57:52
*/
class AuthRule  extends \common\models\AuthRule{



    public function attributeLabels(){
        return [
        
            'name' => '',

            
            'data' => '',

            
            'created_at' => '',

            
            'updated_at' => '',

                    ];
    }



    public function rules(){
        return [
            

                                    [ ['name'] , 'required' ],
                    

                


                                    [ ['name'] , 'string', 'min'=>0,'max'=> 64],
                    


                

                

                

                        ];
    }


}