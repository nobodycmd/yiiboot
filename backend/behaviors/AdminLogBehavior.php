<?php
namespace backend\behaviors;

use Yii;
use yii\base\Application;
use yii\base\Behavior;
use yii\base\Event;
use yii\db\ActiveRecord;
use yii\helpers\Url;

/**
 * 在后台的main.conf里面配置了该行为给
 * application 应用程序对象了
 *
 *在应用程序触发  EVENT_BEFORE_REQUEST 后，注册  ActiveRecord 的时间
 * 当ActiveRecord触发注册事件后进行log
 * @package backend\behaviors
 */
class AdminLogBehavior extends Behavior
{
    public function events()
    {
        return [
            Application::EVENT_BEFORE_REQUEST => 'handle'
        ];
    }

    public function handle()
    {
        Event::on(ActiveRecord::className(), ActiveRecord::EVENT_AFTER_UPDATE, [$this, 'log']);
        Event::on(ActiveRecord::className(), ActiveRecord::EVENT_AFTER_INSERT, [$this, 'log']);
        Event::on(ActiveRecord::className(), ActiveRecord::EVENT_AFTER_DELETE, [$this, 'log']);

        register_shutdown_function(function (){
            if(isset(Yii::$app->params['DbChangeLog']) == false){
                return;
            }
            Yii::warning(Url::to() . ':' . implode(Yii::$app->params['DbChangeLog']),'dbadminlog');
        });
    }

    public function log($event)
    {
        //遇到日志表或者无主键的直接返回
        if($event->sender->tableSchema->name == 'log' || !$event->sender->primaryKey()) {
            return;
        }

        if ($event->name == ActiveRecord::EVENT_AFTER_INSERT) {
            $description = "%s新增了表%s %s:%s行的%s";
        } elseif($event->name == ActiveRecord::EVENT_AFTER_UPDATE) {
            $description = "%s修改了表%s %s:%s行的%s";
        } else {
            $description = "%s删除了表%s %s:%s%s";
        }
        //表变更的数据
        if (!empty($event->changedAttributes)) {
            $desc = '';
            foreach($event->changedAttributes as $name => $value) {
                $desc .= '[字段' . $name . ' 从 ' . $value . ' 变为了 ' . $event->sender->getAttribute($name) . ']   ';
            }
        } else {
            $desc = '';
        }

        $userName = Yii::$app->user->identity?Yii::$app->user->identity->username:'未登录用户';
        $tableName = $event->sender->tableSchema->name;
        $description = sprintf($description,
            $userName,
            $tableName,
            $event->sender->primaryKey()[0],
            is_array($event->sender->getPrimaryKey()) ? current($event->sender->getPrimaryKey()) : $event->sender->getPrimaryKey(),
            $desc
        );

        if(isset(Yii::$app->params['DbChangeLog']) == false){
            Yii::$app->params['DbChangeLog'] = [];
        }
        Yii::$app->params['DbChangeLog'][] = $description;
    }
}