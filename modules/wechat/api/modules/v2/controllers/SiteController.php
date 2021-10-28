<?php
namespace modules\wechat\api\modules\v2\controllers;


class SiteController extends \common\controllers\ApiController
{
    protected function authOptional()
    {
        return ['*'];
    }

    public function actionIndex()
    {
        return __CLASS__;
    }
}