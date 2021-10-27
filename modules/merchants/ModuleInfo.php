<?php
namespace modules\merchants;

use common\helpers\MigrateHelper;

class ModuleInfo extends \modules\ModuleInfo
{
    public $name = '商户';

    public function install()
    {
        MigrateHelper::upByPath([
            '@modules/merchants/console/migrations'
        ]);
        return true;
    }

    public function uninstall()
    {
        MigrateHelper::downByPath([
            '@modules/merchants/console/migrations'
        ]);
        return true;
    }
}