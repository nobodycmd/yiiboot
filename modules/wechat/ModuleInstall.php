<?php
namespace modules\wechat;

class ModuleInstall extends \modules\ModuleInstall
{
    public function install()
    {
        $migrate = new Migration();
        if(method_exists($migrate,'up')){
            $migrate->up();
        }
        if(method_exists($migrate,'safeUp')){
            $migrate->safeUp();
        }
        return true;
    }

    public function uninstall()
    {
        $migrate = new Migration();
        if(method_exists($migrate,'down')){
            $migrate->down();
        }
        if(method_exists($migrate,'safeDown')){
            $migrate->safeDown();
        }
        return true;
    }
}