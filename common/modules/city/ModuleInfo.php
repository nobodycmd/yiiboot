<?php
/**
 * Created by PhpStorm.
 * Author: ljt
 * DateTime: 2017/2/17 12:04
 * Description:
 */

namespace common\modules\city;

class ModuleInfo extends \common\modules\ModuleInfo
{
    public $isCore = 0;

    public $info = [
        'author' => 'rongfang',
        'version' => 'v1.0',
        'id' => 'city',
        'name' => '城市',
        'description' => '城市'
    ];


    public function install()
    {
        $migrate = new Migrate();
        $migrate->up();
        return true;
    }

    public function uninstall()
    {
        $migrate = new Migrate();
        $migrate->down();
        return true;
    }
}