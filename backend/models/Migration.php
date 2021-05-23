<?php

namespace backend\models;

use Yii;



/**
* @PROPERTY_END
* @property  varchar  version  
* @property  int  apply_time  

auto replace propery at 2021-05-23 00:57:52
*/
class Migration  extends \common\models\Migration{



    public function attributeLabels(){
        return [
        
            'version' => '',

            
            'apply_time' => '',

                    ];
    }



    public function rules(){
        return [
            

                                    [ ['version'] , 'required' ],
                    

                


                                    [ ['version'] , 'string', 'min'=>0,'max'=> 180],
                    


                

                        ];
    }


}