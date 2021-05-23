<?php
namespace api\controllers;



class SiteController extends BaseController
{


    public function actionIndex(){
        return \time();
    }


}
