<?php


namespace api\modules\v2\controllers;

use api\common\components\Controller;
use api\modules\v2\models\Notify;

class NotifyController extends Controller
{
    public function actionIndex()
    {
        return Notify::find()->where('1=1')->all();
    }
}