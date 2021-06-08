<?php
namespace common\modules\city;

class ModuleInfo extends \common\modules\ModuleInfo
{
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