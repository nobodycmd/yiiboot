<?php
namespace common\components;

use common\models\Package;
use Yii;
use yii\base\BootstrapInterface;
use yii\base\Component;

class LoadPlugin extends Component implements BootstrapInterface
{
    public function bootstrap($app)
    {
        $all = Package::findAll([
            'type' => 2,
            'is_install' => 1,
            'is_open' => 1,
        ]);
        foreach ($all as $model) {
            $plugin = Yii::createObject([
                'class' => $model->class,
            ]);
            if (method_exists($plugin, 'bootstrap') || $plugin instanceof BootstrapInterface) {
                $plugin->bootstrap($app);
            }
        }

    }
}