<?php
/**
 * Created by PhpStorm.
 * User: yidashi
 * Date: 2017/4/14
 * Time: 下午10:49
 */

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
        return 'hi';
    }

    public function actionIndex2()
    {
        return $this->returnTipMsg('hi three');
    }
}