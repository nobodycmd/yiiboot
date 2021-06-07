<?php
namespace app\job;

use app\service\QueueInstanceService;
use yii\base\BaseObject;
use yii\queue\JobInterface;
use yii\queue\Queue;


class TestJob  extends BaseObject implements JobInterface{
    public $msg;

    /**
     * QueueInstanceService::getQueue()->push(new TestJob([
        'msg' => 'hi there '. date('Y-m-d H:i:s'),
        ]));
     * @inheritDoc
     */
    public function execute($queue)
    {
        echo $this->msg;
    }
}