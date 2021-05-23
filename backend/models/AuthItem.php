<?php

namespace backend\models;

use Yii;



/**
* @PROPERTY_END
* @property  varchar  name  
* @property  smallint  type  
* @property  text  description  
* @property  varchar  rule_name  
* @property  blob  data  
* @property  int  created_at  
* @property  int  updated_at  

auto replace propery at 2021-05-23 00:57:52
*/
class AuthItem  extends \common\models\AuthItem{



    public function attributeLabels(){
        return [
        
            'name' => '',

            
            'type' => '',

            
            'description' => '',

            
            'rule_name' => '',

            
            'data' => '',

            
            'created_at' => '',

            
            'updated_at' => '',

                    ];
    }



    public function rules(){
        return [
            

                                    [ ['name'] , 'required' ],
                    

                


                                    [ ['name'] , 'string', 'min'=>0,'max'=> 64],
                    


                

                                    [ ['type'] , 'required' ],
                    

                                    [ ['type'] , 'integer' ],
                    


                


                

                

                

                

                

                        ];
    }


}