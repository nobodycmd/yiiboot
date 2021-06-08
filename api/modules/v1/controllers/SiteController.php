<?php
namespace api\modules\v1\controllers;


use api\controllers\BaseController;
use api\modules\v1\models\Document;
use yii\data\ActiveDataProvider;

class SiteController extends BaseController
{
    protected function authOptional()
    {
        return ['*'];
    }

    public function actionIndex()
    {
        return __CLASS__;
    }
}