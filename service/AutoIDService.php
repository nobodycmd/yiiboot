<?php
namespace app\service;

use common\models\Autoid;

/**
 *
 * @package app\services
 */
class AutoIDService
{
    /**
     * 获得一个自增数字
     * @return int
     */
    public static function getID(){
        $autoID = new Autoid();
        if($autoID->insert(false)){
            return $autoID->id;
        }
        return 0;
    }

}