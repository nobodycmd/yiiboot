<?php

namespace common\behaviors;

use yii\base\Behavior;
use yii\web\Controller;
use yii\web\TooManyRequestsHttpException;
use common\components\TrafficShaper;

/**
 * 令牌桶 - 限流行为
 *
 * Class TrafficShaperBehavior
 * @package common\behaviors

 */
class TrafficShaperBehavior extends Behavior
{
    /**
     * @return array
     */
    public function events()
    {
        return [Controller::EVENT_BEFORE_ACTION => 'beforeAction'];
    }

    /**
     * @param $event
     * @throws TooManyRequestsHttpException
     */
    public function beforeAction($event)
    {
        $trafficShaper = new TrafficShaper();
        if (!$trafficShaper->get()) {
            throw new TooManyRequestsHttpException('请求过快');
        }
    }
}