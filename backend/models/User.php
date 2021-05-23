<?php

namespace backend\models;

use Yii;



/**
* @PROPERTY_END
* @property  int  id  
* @property  varchar  username  
* @property  varchar  auth_key  
* @property  varchar  password_hash  
* @property  varchar  password_reset_token  
* @property  varchar  email  
* @property  smallint  status  
* @property  int  created_at  
* @property  int  updated_at  
* @property  char  access-token  

auto replace propery at 2021-05-23 00:57:52
*/
class User  extends \common\models\User{



    public function attributeLabels(){
        return [
        
            'id' => '',

            
            'username' => '',

            
            'auth_key' => '',

            
            'password_hash' => '',

            
            'password_reset_token' => '',

            
            'email' => '',

            
            'status' => '',

            
            'created_at' => '',

            
            'updated_at' => '',

            
            'access-token' => '',

                    ];
    }



    public function rules(){
        return [
            

                                    [ ['id'] , 'required' ],
                    

                                    [ ['id'] , 'integer' ],
                    


                


                

                                    [ ['username'] , 'required' ],
                    

                


                                    [ ['username'] , 'string', 'min'=>0,'max'=> 255],
                    


                

                                    [ ['auth_key'] , 'required' ],
                    

                


                                    [ ['auth_key'] , 'string', 'min'=>0,'max'=> 32],
                    


                

                                    [ ['password_hash'] , 'required' ],
                    

                


                                    [ ['password_hash'] , 'string', 'min'=>0,'max'=> 255],
                    


                

                

                                    [ ['email'] , 'required' ],
                    

                


                                    [ ['email'] , 'string', 'min'=>0,'max'=> 255],
                    


                

                                    [ ['status'] , 'required' ],
                    

                                    [ ['status'] , 'integer' ],
                    


                


                

                                    [ ['created_at'] , 'required' ],
                    

                                    [ ['created_at'] , 'integer' ],
                    


                


                

                                    [ ['updated_at'] , 'required' ],
                    

                                    [ ['updated_at'] , 'integer' ],
                    


                


                

                                    [ ['access-token'] , 'required' ],
                    

                


                                    [ ['access-token'] , 'string', 'min'=>0,'max'=> 50],
                    


                        ];
    }


}