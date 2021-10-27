<?php

namespace modules\merchants\controllers;

use Yii;

/**
 * Class StatController
 * @package modules\merchants\controllers
 * @author jianyan74 <751393839@qq.com>
 */
class StatController extends BaseController
{
    /**
     * @return string
     */
    public function actionIndex()
    {
        return $this->render($this->action->id, [
            'merchantCount' => Yii::$app->services->merchant->getCount(),
            'merchantAccount' => Yii::$app->services->merchantAccount->getSum(),
        ]);
    }
}