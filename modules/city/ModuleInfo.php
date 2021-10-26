<?php
namespace modules\city;

class ModuleInfo extends \modules\ModuleInfo
{
    public $name = '城市';

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