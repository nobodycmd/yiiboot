<?php
namespace modules\wechat;

class ModuleInfo extends \modules\ModuleInfo
{
    public $name = '微信';

    public function install()
    {
        $migrate = new Migrate();
        $migrate->safeUp();
        return true;
    }

    public function uninstall()
    {
        $migrate = new Migrate();
        $migrate->safeDown();
        return true;
    }
}