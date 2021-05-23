<?php

namespace api\models;

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
class AuthItem  extends \common\models\AuthItem  {


        // 过滤掉一些字段，特别用于
        // 你想继承父类实现并不想用一些敏感字段
        public function fields(){
            $fields = parent::fields();

            /*
            接口不反返回id字段
            unset($fields['id']);
            */

            /*
            $fields['customize_filed'] = function($model){
                return 'id is ' . $model->id;
            }
            */
            return $fields;
        }




        public function extraFields()
        {
            return [
                    'profile',
                    'friend' => function ($model) {
                        return [
                            'follow_num' => 1,
                        ];
                    }
            ];
        }









}