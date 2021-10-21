<?php
namespace services;

use common\models\Simpleconfig;

/**
 *
 * @package app\services
 */
class SimpleConfigGetService
{
    private static function getValue($key){
        $config = Simpleconfig::findOne([
            'name' => $key
        ]);
        return $config ? $config->value : '';
    }

    /**
     * 官方客服微信
     * @return string
     */
    public static function getWx(){
        return self::getValue('kefuwx');
    }

    /**
     * 安卓下载地址
     * 后台可设置
     * @return string
     */
    public static function getApk(){
        return self::getValue('apk');
    }

    /**
     * IOS下载地址
     * 后台可设置
     * @return string
     */
    public static function getIos(){
        return self::getValue('ios');
    }

    /**
     * ios审核版本
     * 多个版本号以英文,隔开
     * @return string
     */
    public static function getIOSCheckingVersion(){
        return self::getValue('ios_checking_version');
    }

    /**
     * 邀请好友背景图
     * @return string
     */
    public static function getInviteBgImg(){
        return self::getValue('invitebgimg');
    }

    /**
     * 邀请好友app代码参数设置需要一个前景图，业务上没用，代码实现上需要
     * @return string
     */
    public static function getInvitePlaceHolderForFrontImg(){
        return self::getValue('inviteplaceholderforfrontimg');
    }

}