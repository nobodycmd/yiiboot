<?php

namespace services\backend;

use common\components\Service;
use common\enums\SubscriptionAlertTypeEnum;
use common\helpers\ArrayHelper;
use common\models\NotifySubscriptionConfig;

/**
 * Class NotifySubscriptionConfigService
 * @package services\backend

 */
class NotifySubscriptionConfigService extends Service
{
    /**
     * @param $newData
     */
    public function getData($newData)
    {
        $data = SubscriptionAlertTypeEnum::default();

        foreach ($newData as $key => $datum) {
            !empty($datum) && $data[$key] = ArrayHelper::merge($data[$key], $datum);
        }

        return $data;
    }

    /**
     * @param $member_id
     * @return NotifySubscriptionConfig|null
     */
    public function findByMemberId($member_id)
    {
        return null;
        return NotifySubscriptionConfig::findOne(['member_id' => $member_id]);
    }

    /**
     * @return array|\yii\db\ActiveRecord[]
     */
    public function findAllWithMember()
    {
        return [];
        return NotifySubscriptionConfig::find()->with('member')->all();
    }
}