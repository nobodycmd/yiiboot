<?php

namespace common\helpers;

use Yii;
use yii\helpers\BaseUrl;
use common\enums\AppEnum;

/**
 * Class Url
 * @package common\helpers

 */
class Url extends BaseUrl
{
    /**
     *  生成Url，好的习惯应该是 不以 / 打头用相对路径
     *  以 / 打头，需要指定 $moduleNameAsPrefix  或者 url 里面携带了 模块名称作为前缀路径
     * @param array $url
     * @param bool $scheme
     * @param string $moduleNameAsPrefix
     * @return bool| string
     */
    public static function to($url = '', $moduleNameAsPrefix = '', $scheme = false)
    {
        // 模块默认加上
        if (is_string($url) && substr($url, 0, 1) == '/') {
            $name = '/' . $moduleNameAsPrefix;
            //如果 url 里面不是以 $name 开始的
            if (substr($url, 0, strlen($name)) != $name) {
                $url = $name . $url;
            }
        } elseif (is_array($url) && substr($url[0], 0, 1) == '/') {
            $name = '/' . $moduleNameAsPrefix;
            //如果 url 里面不是以 $name 开始的
            if (substr($url[0], 0, strlen($name)) != $name) {
                $url[0] = $name . $url[0];
            }
        }

        return parent::to($url, $scheme);
    }

    /**
     * 生成前台链接
     *
     * @param array $url
     * @param bool $scheme
     * @return string
     * @throws \yii\base\InvalidConfigException
     */
    public static function toFront(array $url, $absolute = false, $scheme = false)
    {
        $domainName = Yii::getAlias('@frontendUrl');

        return static::create($url, $absolute, $scheme, $domainName, '', 'urlManagerFront');
    }

    /**
     * 生成微信链接
     *
     * @param array $url
     * @param bool $scheme
     * @return string
     * @throws \yii\base\InvalidConfigException
     */
    public static function toHtml5(array $url, $absolute = false, $scheme = false)
    {
        $domainName = Yii::getAlias('@html5Url');

        return static::create($url, $absolute, $scheme, $domainName, '/html5', 'urlManagerHtml5');
    }

    /**
     * 生成oauth2链接
     *
     * @param array $url
     * @param bool $scheme
     * @return string
     * @throws \yii\base\InvalidConfigException
     */
    public static function toOAuth2(array $url, $absolute = false, $scheme = false)
    {
        $domainName = Yii::getAlias('@oauth2Url');

        return static::create($url, $absolute, $scheme, $domainName, '/oauth2', 'urlManagerOAuth2');
    }

    /**
     * 生成oauth2链接
     *
     * @param array $url
     * @param bool $scheme
     * @return string
     * @throws \yii\base\InvalidConfigException
     */
    public static function toStorage(array $url, $absolute = false, $scheme = false)
    {
        $domainName = Yii::getAlias('@storageUrl');

        return static::create($url, $absolute, $scheme, $domainName, '/storage', 'urlManagerStorage');
    }

    /**
     * 生成Api链接
     *
     * @param array $url
     * @param bool $scheme
     * @return string
     * @throws \yii\base\InvalidConfigException
     */
    public static function toApi(array $url, $absolute = false, $scheme = false)
    {
        $domainName = Yii::getAlias('@apiUrl');

        return static::create($url, $absolute, $scheme, $domainName, '/api', 'urlManagerApi');
    }

    /**
     * 获取权限所需的url
     *
     * @param $url
     * @return string
     */
    public static function getAuthUrl($url)
    {
        return static::normalizeRoute($url);
    }

    /**
     * 创建支付回调专门Url
     *
     * @param string $action
     * @param array $url
     * @param bool $scheme
     * @return array
     */
    public static function removeMerchantIdUrl(string $action, array $url, $scheme = false)
    {
        $realAppId = Yii::$app->params['realAppId'];
        Yii::$app->params['realAppId'] = AppEnum::BACKEND;
        $url = self::$action($url, $scheme);
        Yii::$app->params['realAppId'] = $realAppId;

        return $url;
    }

    /**
     * @param $url
     * @param $scheme
     * @param $domainName
     * @param $appId
     * @param $key
     * @return string
     * @throws \yii\base\InvalidConfigException
     */
    protected static function create($url, $absolute, $scheme, $domainName, $appId, $key)
    {
        $url = static::isMerchant($url);
        Yii::$app->params['inAddon'] && $url = self::regroupUrl($url);

        if (!Yii::$app->has($key)) {
            Yii::$app->set($key, [
                'class' => 'yii\web\urlManager',
                'hostInfo' => !empty($domainName) ? $domainName : Yii::$app->request->hostInfo . $appId,
                'scriptUrl' => '', // 代替'baseUrl'
                'enablePrettyUrl' => true,
                'showScriptName' => true,
                'suffix' => '',// 静态
            ]);

            unset($domainName);
        }

        return urldecode(Yii::$app->$key->createAbsoluteUrl($url, $scheme));
    }

    /**
     * 重组url
     *
     * @param array $url 重组地址
     * @param array $addonsUrl 路由地址
     * @return array
     */
    protected static function regroupUrl($url)
    {
        if (!is_array($url)) {
            return $url;
        }

        $url[0] = Yii::$app->params['addonName'] . '/' . $url[0];

        return $url;
    }

    /**
     * @param array $url
     * @return array
     */
    protected static function isMerchant(array $url)
    {
        $merchant_id = Yii::$app->services->merchant->getId();
        if (Yii::$app->params['realAppId'] != AppEnum::BACKEND && !empty($merchant_id)) {
            $url = ArrayHelper::merge([
                'merchant_id' => $merchant_id,
            ], $url);
        }

        return $url;
    }
}