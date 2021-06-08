<?php

namespace plugin\statistics;


use yii\web\View;
use yii\base\Event;

class Plugin extends \plugin\Plugin
{

    public function bootstrap($app)
    {
        Event::on(View::className(), 'endBody', [$this, 'run']);
    }

    public function run()
    {
        echo '<!-- from statistic plugin -->';
    }
}