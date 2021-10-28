<?php
namespace modules\wechat\api\controllers;


class SiteController extends \common\controllers\ApiController
{

    public function actionIndex()
    {
        return __CLASS__;
    }


    public function authOptional()
    {
        return ['*'];
    }

}
