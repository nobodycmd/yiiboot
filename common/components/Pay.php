<?php

namespace common\components;

use Yii;
use yii\base\Component;
use common\components\payment\AliPay;
use common\components\payment\UnionPay;
use common\components\payment\WechatPay;
use common\components\payment\Stripe;
use common\helpers\ArrayHelper;

/**
 * 支付组件
 *
 * Class Pay
 * @package common\components
 * @property \common\components\payment\WechatPay $wechat
 * @property \common\components\payment\AliPay $alipay
 * @property \common\components\payment\UnionPay $union
 * @property \common\components\payment\Stripe $stripe

 */
class Pay extends Component
{
    /**
     * 公用配置
     *
     * @var
     */
    protected $rfConfig;

    public function init()
    {
        // 默认读后台配置可切换为根据商户来获取配置
        $this->rfConfig = Yii::$app->debris->backendConfigAll();
        // $this->rfConfig = Yii::$app->debris->merchantConfigAll();

        parent::init();
    }

    /**
     * 支付宝支付
     *
     * @param array $config
     * @return AliPay
     * @throws \yii\base\InvalidConfigException
     */
    public function alipay(array $config = [])
    {
        return new AliPay(ArrayHelper::merge([
            'app_id' => $this->rfConfig['alipay_appid'],
            'notify_url' => '',
            'return_url' => '',
            'ali_public_key' => $this->rfConfig['alipay_cert_path'],
            // 加密方式： ** RSA2 **
            'private_key' => $this->rfConfig['alipay_key_path'],
            'sandbox' => false
        ], $config));
    }

    /**
     * 微信支付
     *
     * @param array $config
     * @return WechatPay
     */
    public function wechat(array $config = [])
    {
        return new WechatPay(ArrayHelper::merge([
            'app_id' => $this->rfConfig['wechat_appid'], // 公众号 APPID
            'open_app_id' => $this->rfConfig['wechat_open_appid'], // 微信开放平台 APPID
            'mini_program_app_id' => $this->rfConfig['miniprogram_appid'], // 微信小程序 APPID
            'mch_id' => $this->rfConfig['wechat_mchid'],
            'api_key' => $this->rfConfig['wechat_api_key'],
            'cert_client' => $this->rfConfig['wechat_cert_path'], // optional，退款等情况时用到
            'cert_key' => $this->rfConfig['wechat_key_path'],// optional，退款等情况时用到
        ], $config));
    }

    /**
     * 银联支付
     *
     * @param array $config
     * @return UnionPay
     * @throws \yii\base\InvalidConfigException
     */
    public function union(array $config = [])
    {
        return new UnionPay(ArrayHelper::merge([
            'mch_id' => $this->rfConfig['union_mchid'],
            'notify_url' => '',
            'return_url' => '',
            'cert_id' => $this->rfConfig['union_cert_id'],
            'private_key' => $this->rfConfig['union_private_key'],
        ], $config));
    }

    /**
     * Stripe
     *
     * 测试的接口，在key 结尾加 _test 字符串.
     * Test card: 4000001240000000
     * @param array $config
     * @return Stripe
     * @throws \yii\base\InvalidConfigException
     */
    public function stripe(array $config = [])
    {
        return new Stripe(ArrayHelper::merge([
            'publishable_key' => $this->rfConfig['stripe_publishable_key'],
            'secret_key' => $this->rfConfig['stripe_secret_key'],
        ], $config));
    }

    /**
     * @param $name
     * @return mixed
     * @throws \Exception
     */
    public function __get($name)
    {
        try {
            return parent::__get($name);
        } catch (\Exception $e) {
            if ($this->$name()) {
                return $this->$name([]);
            } else {
                throw $e->getPrevious();
            }
        }
    }
}