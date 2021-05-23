<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace console\controllers;

use common\models\AdminUser;
use yii\console\Controller;
use yii\helpers\FileHelper;

/**
 * This command echoes the first argument that you have entered.
 *
 * This command is provided as an example for you to learn how to create console commands.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class InitadminaccountController extends Controller
{
    /**
     * This command echoes what you have entered as the message.
     * @param string $message the message to be echoed.
     */
    public function actionIndex($message = 'hello world')
    {
        $m = new AdminUser();
        $m->username = 'admin';
        $m->password_hash = \Yii::$app->getSecurity()->generatePasswordHash('123456');
        $m->auth_key = \Yii::$app->getSecurity()->generateRandomString();
        $m->password_reset_token = \Yii::$app->getSecurity()->generateRandomString();
        $m->email = 'superboss01@163.com';
        $m->save();
        echo '用户名 admin  密码 123456' . PHP_EOL;
    }
}
