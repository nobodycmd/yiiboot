<?php

namespace modules\merchants\backend\controllers;

use Yii;
use common\controllers\AddonsController;

/**
 * 默认控制器
 *
 * Class DefaultController
 * @package modules\merchants\backend\controllers
 */
class DefaultController extends BaseController
{
    /**
    * 首页
    *
    * @return string
    */
    public function actionIndex()
    {
        return $this->render('index',[

        ]);
    }
}