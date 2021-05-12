<?php
namespace console\controllers;

use app\service\QueueInstanceService;

class QueueConfigController extends \yii\console\Controller
{

    public function actionIndex(){
        QueueInstanceService::generateSupervisorConfig();
    }

}
