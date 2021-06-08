<?php

namespace api\models;

use Yii;



/**
* @PROPERTY_BEGIN 千万千万不要删除这行
属性占位符
* @PROPERTY_END 千万千万不要删除这行
*/
class City  extends \common\models\City  {


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