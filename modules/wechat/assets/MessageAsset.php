<?php

namespace modules\wechat\assets;

use yii\web\AssetBundle;

/**
 * 微信消息发送交互处理
 * @package modules\wechat\assets
 */
class MessageAsset extends AssetBundle
{
    public $sourcePath = '@modules/wechat/web';
    public $css = [
        'css/wechat.css'
    ];
    public $js = [
        'js/message.js'
    ];
    public $depends = [
        'modules\wechat\assets\WechatAsset',
    ];
}