<?php

namespace services;

use common\components\Service;

/**
 * Class Application
 *
 * @package services
 * @property \services\common\MenuService $menu 菜单
 * @property \services\common\MenuCateService $menuCate 菜单分类
 * @property \services\common\LogService $log 公用日志
 * @property \services\common\ReportLogService $reportLog 风控日志
 * @property \services\common\BankNumberService $bankNumber 提现银行卡
 * @property \services\common\PayService $pay 公用支付
 * @property \services\common\CommissionWithdrawService $commissionWithdraw 公用提现
 * @property \services\common\MailerService $mailer 公用邮件
 * @property \services\common\SmsService $sms 公用短信
 * @property \services\common\OpenPlatformService $openPlatform 开放平台
 * @property \services\common\ConfigService $config 基础配置
 * @property \services\common\ConfigCateService $configCate 基础配置分类
 * @property \services\common\ProvincesService $provinces ip黑名单
 * @property \services\common\IpBlacklistService $ipBlacklist 省市区
 * @property \services\common\JPushService $jPush 极光推送
 * @property \services\common\MapService $map 地图
 * @property \services\common\MiniProgramLiveService $miniProgramLive 小程序直播
 * @property \services\common\PrinterYiLianYunService $printerYiLianYun 易联云小票打印
 * @property \services\common\PrinterFeiEYunService $printerFeiEYunService 飞鹅云小票打印机
 *

 */
class Application extends Service
{
    /**
     * @var array
     */
    public $childService = [

        /** ------ 公用部分 ------ **/
        'menu' => 'services\common\MenuService',
        'menuCate' => 'services\common\MenuCateService',
        'config' => 'services\common\ConfigService',
        'configCate' => 'services\common\ConfigCateService',
        'actionBehavior' => 'services\common\ActionBehaviorService',
        'ipBlacklist' => 'services\common\IpBlacklistService',
        'provinces' => 'services\common\ProvincesService',
        'attachment' => 'services\common\AttachmentService',
        'reportLog' => 'services\common\ReportLogService',
        'bankNumber' => 'services\common\BankNumberService',
        'pay' => 'services\common\PayService',
        'commissionWithdraw' => 'services\common\CommissionWithdrawService',
        'jPush' => 'services\common\JPushService',
        'map' => 'services\common\MapService',
        'miniProgramLive' => 'services\common\MiniProgramLiveService',
        'openPlatform' => 'services\common\OpenPlatformService',
        'sms' => [
            'class' => 'services\common\SmsService',
            'queueSwitch' => false, // 是否丢进队列
        ],
        'mailer' => [
            'class' => 'services\common\MailerService',
            'queueSwitch' => false, // 是否丢进队列
        ],
        'printerYiLianYun' => 'services\common\PrinterYiLianYunService',
        'printerFeiEYunService' => 'services\common\PrinterFeiEYunService',

    ];
}