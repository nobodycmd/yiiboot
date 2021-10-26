<?php

namespace modules\wechat\controllers;

use modules\wechat\components\AdminController;

class DefaultController extends AdminController
{
    public function actionIndex()
    {
        return $this->render('index');
    }
}
