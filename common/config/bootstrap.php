<?php
Yii::setAlias('common', dirname(__DIR__));
Yii::setAlias('frontend', dirname(dirname(__DIR__)) . '/frontend');
Yii::setAlias('backend', dirname(dirname(__DIR__)) . '/backend');
Yii::setAlias('console', dirname(dirname(__DIR__)) . '/console');
Yii::setAlias('api', dirname(dirname(__DIR__)) . '/api');


Yii::setAlias('modules', dirname(dirname(__DIR__)) . '/modules');
Yii::setAlias('plugins', dirname(dirname(__DIR__)) . '/plugins');
Yii::setAlias('jobs', dirname(dirname(__DIR__)) . '/jobs');
Yii::setAlias('services', dirname(dirname(__DIR__)) . '/services');


Yii::setAlias('@attachment', dirname(dirname(__DIR__)) . '/localstorage'); // 本地资源目录绝对路
Yii::setAlias('@attachurl', '/localstorage'); // 资源目前相对路径，可以带独立域名，例如 https://attachment.baidu.com