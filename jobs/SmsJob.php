<?php

namespace jobs;


use Yii;
use yii\base\BaseObject;


class SmsJob extends BaseObject implements \yii\queue\JobInterface
{
    /**
     * @var
     */
    public $mobile;

    /**
     * @var
     */
    public $code;

    /**
     * @var
     */
    public $usage;

    /**
     * @var
     */
    public $member_id;

    /**
     * @var
     */
    public $ip;

    /**
     * @param \yii\queue\Queue $queue
     * @return mixed|void
     * @throws \yii\web\UnprocessableEntityHttpException
     */
    public function execute($queue)
    {
        Yii::$app->services->sms->realSend($this->mobile, $this->code, $this->usage, $this->member_id, $this->ip);
    }
}