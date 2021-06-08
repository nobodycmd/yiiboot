<?php
namespace common\behaviors;

use Yii;
use yii\base\Behavior;
use yii\base\Event;
use yii\db\ActiveRecord;
use yii\helpers\Markdown;
use yii\helpers\StringHelper;
use yii\web\Application;

/**
 * 公共行为
 * 给了应用进行订单状态变更后进行用户通知
 *
 * @package common\behaviors
 */
class OrderStatusNotifyBehavior extends Behavior
{
    private $_statusName = 'status';

    public function events()
    {
        return [
            Application::EVENT_BEFORE_REQUEST => 'bindEvent',
        ];
    }

    public function bindEvent($event)
    {
        Event::on(ActiveRecord::className(), 'afterUpdate', [$this, 'afterUpdate']);
    }

    public function afterUpdate($event)
    {
        $entity = get_class($event->sender);
        switch ($entity) {
            case 'common\models\Order':
                $changedAttributes = $event->sender->changedAttributes;
                if($changedAttributes && isset($changedAttributes[$this->_statusName])){
                    $status = $event->sender->getAttribute($this->_statusName);
                    switch ($status){
                        default:
                            //echo '订单状态变为了' . $status; 通知用户
                    }
                }
                break;
        }

    }
    private function generateMsgContent($content)
    {
        return StringHelper::truncate(preg_replace('/\s+/', ' ', strip_tags(Markdown::process($content))), 50);
    }
}