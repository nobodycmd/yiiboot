<?php
namespace api\controllers;


class SiteController extends \common\controllers\ApiController
{

    public function authOptional()
    {
        return ['*'];
    }

    public function actionIndex(){
        echo '<center><h1>到modules里面的多版本里面去写吧</h1></center>';
    }


}
