<?php
namespace api\controllers;



use Symfony\Component\HttpFoundation\Response;

class SiteController extends BaseController
{

    public function authOptional()
    {
     return ['*'];
    }

    public function actionIndex(){
        return [1,2];
        //return new Response();
        return \Yii::$app->wechat->authorizeRequired()->send();
        return \time();
    }


}
