<?php
namespace modules\city\controllers;

use modules\city\models\City;
use yii\web\Controller;

class DefaultController extends Controller
{
    public function actionIndex(){
        return '你好，访问到了 city(module) 模块的 default(controller) 下 index(action)';
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