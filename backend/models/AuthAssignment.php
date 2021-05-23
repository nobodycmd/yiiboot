<?php

namespace backend\models;

use Yii;



/**
* @PROPERTY_END
* @property  varchar  item_name  
* @property  varchar  user_id  
* @property  int  created_at  

auto replace propery at 2021-05-23 00:57:52
*/
class AuthAssignment  extends \common\models\AuthAssignment{



    public function attributeLabels(){
        return [
        
            'item_name' => '',

            
            'user_id' => '',

            
            'created_at' => '',

                    ];
    }



    public function rules(){
        return [
            

                                    [ ['item_name'] , 'required' ],
                    

                


                                    [ ['item_name'] , 'string', 'min'=>0,'max'=> 64],
                    


                

                                    [ ['user_id'] , 'required' ],
                    

                


                                    [ ['user_id'] , 'string', 'min'=>0,'max'=> 64],
                    


                

                        ];
    }


}