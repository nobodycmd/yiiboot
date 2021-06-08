<?php
namespace service;


class RedisService
{
    /**
     * @return \yii\redis\Connection
     */
    public static function getInstance(){
        return \Yii::$app->redis;
    }


}