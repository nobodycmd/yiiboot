<?php
/**
 * Created by PhpStorm.
 * Author: yidashi
 * DateTime: 2017/3/8 10:09
 * Description:
 */

namespace api\modules\v2\controllers;

use api\common\components\Controller;

class UserController extends Controller
{
    public function actionInfo()
    {
        $user = \Yii::$app->user->identity;
        return $user;
    }
}