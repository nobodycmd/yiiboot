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
        return __CLASS__;
    }


}
