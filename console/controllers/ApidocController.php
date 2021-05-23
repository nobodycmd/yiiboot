<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace console\controllers;

use common\models\Zb_new_user_head_decoration;
use yii\console\Controller;
use yii\helpers\ArrayHelper;

/**
 * 生成api文档指南
 * @since 2.0
 */
class ApidocController extends Controller
{

    public function actionIndex()
    {

        $path =
            \Yii::getAlias("@vendor/bin/apidoc  guide   ")
            .\Yii::getAlias("@frontend/web/apimd ")
            .\Yii::getAlias("@frontend/web/apiguide/  --interactive=0")
        ;
        exec($path);
    }
}
