<?php

namespace common\traits;

use Yii;
use yii\base\Model;

/**
 * trait BaseAction
 * @package common\traits
 */
trait BaseAction
{
    protected $merchant_id = 0;

    /**
     * 商户id
     *
     * @return int
     */
    public function getMerchantId()
    {
        return $this->merchant_id;
    }

    /**
     * @param Model $model
     * @return string
     */
    public function getError(Model $model)
    {
        return $this->analyErr($model->getFirstErrors());
    }

    /**
     * 重载配置
     *
     * @param $merchant_id
     * @throws \yii\base\InvalidConfigException
     * @throws \yii\web\UnauthorizedHttpException
     */
    public function afreshLoad($merchant_id)
    {
        // 微信配置 具体可参考EasyWechat
        Yii::$app->params['wechatConfig'] = [];
        // 微信支付配置 具体可参考EasyWechat
        Yii::$app->params['wechatPaymentConfig'] = [];
        // 微信小程序配置 具体可参考EasyWechat
        Yii::$app->params['wechatMiniProgramConfig'] = [];
        // 微信开放平台第三方平台配置 具体可参考EasyWechat
        Yii::$app->params['wechatOpenPlatformConfig'] = [];
        // 微信企业微信配置 具体可参考EasyWechat
        Yii::$app->params['wechatWorkConfig'] = [];
        // 微信企业微信开放平台 具体可参考EasyWechat
        Yii::$app->params['wechatOpenWorkConfig'] = [];
    }

    /**
     * 解析错误
     *
     * @param $fistErrors
     * @return string
     */
    protected function analyErr($firstErrors)
    {
        return Yii::$app->debris->analyErr($firstErrors);
    }

    /**
     * @param $model \yii\db\ActiveRecord|Model
     * @throws \yii\base\ExitException
     */
    protected function activeFormValidate($model)
    {
        if (Yii::$app->request->isAjax && !Yii::$app->request->isPjax) {
            if ($model->load(Yii::$app->request->post())) {
                Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
                Yii::$app->response->data = \yii\widgets\ActiveForm::validate($model);
                Yii::$app->end();
            }
        }
    }

    /**
     * 错误提示信息
     *
     * @param string $msgText 错误内容
     * @param string $skipUrl 跳转链接
     * @param string $msgType 提示类型 [success/error/info/warning]
     * @return mixed
     */
    protected function message($msgText, $skipUrl, $msgType = null)
    {
        if (!$msgType || !in_array($msgType, ['success', 'error', 'info', 'warning'])) {
            $msgType = 'success';
        }

        Yii::$app->getSession()->setFlash($msgType, $msgText);
        return $skipUrl;
    }

    /**
     * 记录上一页地址
     *
     * @param $actionId
     */
    protected function setReferrer($actionId)
    {
        if (in_array($actionId, ['edit', 'delete', 'destroy'])) {
            $route = Yii::$app->controller->route;

            if (!Yii::$app->session->get($route)) {
                Yii::$app->session->set($route, Yii::$app->request->referrer);
            }
        }
    }

    /**
     * 跳转到之前的页面
     *
     * @return mixed
     */
    protected function referrer()
    {
        $key = Yii::$app->controller->route;
        $url = Yii::$app->session->get($key);
        Yii::$app->session->remove($key);
        if ($url) {
            return $this->redirect($url);
        }

        return $this->redirect(['index']);
    }
}