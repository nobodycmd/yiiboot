<?php

namespace backend\models;

use Yii;



/**
* @PROPERTY_END
* @property  varchar  parent  
* @property  varchar  child  

auto replace propery at 2021-05-23 00:57:52
*/
class AuthItemChild  extends \common\models\AuthItemChild{



    public function attributeLabels(){
        return [
        
            'parent' => '',

            
            'child' => '',

                    ];
    }



    public function rules(){
        return [
            

                                    [ ['parent'] , 'required' ],
                    

                


                                    [ ['parent'] , 'string', 'min'=>0,'max'=> 64],
                    


                

                                    [ ['child'] , 'required' ],
                    

                


                                    [ ['child'] , 'string', 'min'=>0,'max'=> 64],
                    


                        ];
    }


}