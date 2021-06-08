<?php
namespace common\modules\city\controllers;

use common\modules\city\models\City;
use yii\web\Controller;

class DefaultController extends Controller
{
    public function actionIndex(){
        return 'module city';
    }

    public function actionChildren($id)
    {
        \Yii::$app->response->format = 'json';
        if (!is_numeric($id)) {
            $id = null;
        }
        return City::getChildren($id);
    }
}