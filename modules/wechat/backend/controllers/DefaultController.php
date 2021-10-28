<?php

namespace modules\wechat\backend\controllers;

use common\helpers\Url;
use modules\wechat\components\AdminController;

class DefaultController extends AdminController
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionU(){
        echo  Url::to(['fans/index']);
        echo PHP_EOL;
        echo  Url::to('fans/index');
    }
}
