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
 * 在入库前给主键一个雪花ID
 *
 * @package common\behaviors
 */
class SnowFlakeIDBehavior extends Behavior
{

    public function events()
    {
        return [
            Application::EVENT_BEFORE_REQUEST => 'bindEvent',
        ];
    }

    public function bindEvent($event)
    {
        Event::on(ActiveRecord::className(), 'beforeInsert', [$this, 'beforeInsert']);
    }

    public function beforeInsert($event)
    {
        $primaryKey = $event->sender->primaryKey();
        $event->sender->$primaryKey = (new \services\common\SnowFlakeIDService())->nextId();
    }

}