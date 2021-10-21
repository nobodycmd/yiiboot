<?php
namespace services;

//支付宝API列表
//https://docs.open.alipay.com/api_1/alipay.trade.page.pay

require_once \Yii::getAlias('@common/../thirdlib/') . 'alipaysdk/aop/AopCertClient.php';
require_once \Yii::getAlias('@common/../thirdlib/') . 'alipaysdk/aop/AopCertification.php';
require_once \Yii::getAlias('@common/../thirdlib/') . 'alipaysdk/aop/request/AlipayTradeQueryRequest.php';//交易查询
require_once \Yii::getAlias('@common/../thirdlib/') . 'alipaysdk/aop/request/AlipayTradeWapPayRequest.php';//手机网站支付
require_once \Yii::getAlias('@common/../thirdlib/') . 'alipaysdk/aop/request/AlipayTradePagePayRequest.php';//pc网站支付
require_once \Yii::getAlias('@common/../thirdlib/') . 'alipaysdk/aop/request/AlipayTradeAppPayRequest.php';//app支付
require_once \Yii::getAlias('@common/../thirdlib/') . 'alipaysdk/aop/request/AlipayOpenOperationOpenbizmockBizQueryRequest.php';

/**
 * 支付宝官方接口支付
 * @package app\service
 */
class AlipayService
{

    public $huabeifenqi = true;

    public $appid, $appCertPath, $alipayCertPath, $rootCertPath, $siyaoCertPath;

    public function __construct($_support_huabei = true)
    {
        $config = \Yii::$app->params['alipay'];

        $this->appid = $config['appid'];

        $this->rootCertPath = $config['rootCertPath'];
        $this->alipayCertPath = $config['alipayCertPath'];

        $this->appCertPath = $config['appCertPath'];
        $this->siyaoCertPath = $config['siyaoCertPath'];

        $this->huabeifenqi = $_support_huabei;
    }


    /**
     *
     * @param $order_sn
     * @param $money
     * @param $notify_url
     * @return string
     */
    public function wapPay($order_sn,$money,$notify_url)
    {
        $aop = new \AopCertClient();

        $aop->gatewayUrl = 'https://openapi.alipay.com/gateway.do';
        $aop->appId = $this->appid;
        $aop->rsaPrivateKey = file_get_contents($this->siyaoCertPath);
        $aop->alipayrsaPublicKey = $aop->getPublicKey($this->alipayCertPath);
        $aop->apiVersion = '1.0';
        $aop->signType = 'RSA2';
        $aop->postCharset = 'utf-8';
        $aop->format = 'json';
        $aop->isCheckAlipayPublicCert = true;//是否校验自动下载的支付宝公钥证书，如果开启校验要保证支付宝根证书在有效期内
        $aop->appCertSN = $aop->getCertSN($this->appCertPath);//调用getCertSN获取证书序列号
        $aop->alipayRootCertSN = $aop->getRootCertSN($this->rootCertPath);//调用getRootCertSN获取支付宝根证书序列号

        $request = new \AlipayTradeWapPayRequest();
        $request->setNotifyUrl($notify_url);

        $bizString = "{" .
            //"    \"body\":\"" . $this->product_info['body'] . "\"," .
            "    \"goods_type\":\"1\"," . //商品主类型：0—虚拟类商品，1—实物类商品注：虚拟类商品不支持使用花呗渠道
            "    \"subject\":\"" . '返购汇APP' . "\"," .
            "    \"out_trade_no\":\"" . $order_sn . "\"," .
            //"    \"timeout_express\":\"300m\"," .
            "    \"total_amount\":" . $money . ",";

        $bizString .= "    \"product_code\":\"QUICK_MSECURITY_PAY\"";  //."," .

        //花呗分期
        if ($this->huabeifenqi) {
            $bizString .= ',' .
                "    \"extend_params\":{" .
                "       \"hb_fq_num\":\"12\"," .
                "      \"hb_fq_seller_percent\":\"100\"" .
                "    }";
        }

        $bizString .= "  }";


        $request->setBizContent($bizString);
        $result = $aop->pageExecute ($request);
        echo $result;
        exit;
    }


    /**
     * 生成用于调用收银台SDK的字符串
     * @param $order_sn
     * @param $money
     * @param $notify_url
     * @return string
     */
    public function getAppSDKPayString($order_sn,$money,$notify_url)
    {
        $aop = new \AopCertClient();

        $aop->gatewayUrl = 'https://openapi.alipay.com/gateway.do';
        $aop->appId = $this->appid;
        $aop->rsaPrivateKey = file_get_contents($this->siyaoCertPath);
        $aop->alipayrsaPublicKey = $aop->getPublicKey($this->alipayCertPath);
        $aop->apiVersion = '1.0';
        $aop->signType = 'RSA2';
        $aop->postCharset = 'utf-8';
        $aop->format = 'json';
        $aop->isCheckAlipayPublicCert = true;//是否校验自动下载的支付宝公钥证书，如果开启校验要保证支付宝根证书在有效期内
        $aop->appCertSN = $aop->getCertSN($this->appCertPath);//调用getCertSN获取证书序列号
        $aop->alipayRootCertSN = $aop->getRootCertSN($this->rootCertPath);//调用getRootCertSN获取支付宝根证书序列号

        $request = new \AlipayTradeAppPayRequest();
        $request->setNotifyUrl($notify_url);

        $bizString = "{" .
            //"    \"body\":\"" . $this->product_info['body'] . "\"," .
            "    \"goods_type\":\"1\"," . //商品主类型：0—虚拟类商品，1—实物类商品注：虚拟类商品不支持使用花呗渠道
            "    \"subject\":\"" . '美淘APP' . "\"," .
            "    \"out_trade_no\":\"" . $order_sn . "\"," .
            "    \"timeout_express\":\"30m\"," .
            "    \"total_amount\":" . $money . ",";

        $bizString .= "    \"product_code\":\"QUICK_MSECURITY_PAY\"";  //."," .

        //花呗分期
        if ($this->huabeifenqi) {
            $bizString .= ',' .
                "    \"extend_params\":{" .
                "       \"hb_fq_num\":\"12\"," .
                "      \"hb_fq_seller_percent\":\"100\"" .
                "    }";
        }

        $bizString .= "  }";

        $request->setBizContent($bizString);
        return $aop->sdkExecute($request);
    }



    /*
     * 根据我方订单号查询支付情况
     */
    public function query($out_trade_no){

        //主动去查询支付结果
        $aop = new \AopCertClient ();

        $aop->gatewayUrl = 'https://openapi.alipay.com/gateway.do';
        $aop->appId = $this->appid;
        $aop->rsaPrivateKey = file_get_contents($this->siyaoCertPath);;
        $aop->alipayrsaPublicKey = $aop->getPublicKey($this->alipayCertPath);
        $aop->apiVersion = '1.0';
        $aop->signType = 'RSA2';
        $aop->postCharset = 'utf-8';
        $aop->format = 'json';
        $aop->isCheckAlipayPublicCert = true;//是否校验自动下载的支付宝公钥证书，如果开启校验要保证支付宝根证书在有效期内
        $aop->appCertSN = $aop->getCertSN($this->appCertPath);//调用getCertSN获取证书序列号
        $aop->alipayRootCertSN = $aop->getRootCertSN($this->rootCertPath);//调用getRootCertSN获取支付宝根证书序列号

        //https://docs.open.alipay.com/api_1/alipay.trade.query/
        $request = new \AlipayTradeQueryRequest ();
        $request->setBizContent("{" .
            "\"out_trade_no\":\"" . $out_trade_no . "\"," .
            //"\"org_pid\":\"2088101117952222\"," .
            "      \"query_options\":[" .
            "        \"TRADE_SETTE_INFO\"" .
            "      ]" .
            "  }");
        $result = $aop->execute($request);

        $responseNode = str_replace(".", "_", $request->getApiMethodName()) . "_response";
        $query_receive_data = $result->$responseNode;//查询结果
        $resultCode = $result->$responseNode->code;
        if (!empty($resultCode) && $resultCode == 10000) {//查询成功
            return $query_receive_data;
        }
        return [];
    }




    /**
     * POST接收数据
     * 状态码说明  （0 交易完成 1 交易失败 2 交易超时 3 交易处理中 4 交易未支付 5交易取消6交易发生错误）
     *
     */
    public function notify()
    {
        $aop = new \AopCertClient();
        $aop->alipayrsaPublicKey = $aop->getPublicKey($this->alipayCertPath);
        $flag = $aop->rsaCheckV1($_POST, null, 'RSA2');


        if (!$flag) {
            \Yii::error('支付宝POST通知签名验证失败');
            return false;
        }

        $return_data['trade_no'] = $_POST['trade_no'];//与几个订单表字段一致
        $return_data['order_sn'] = $_POST['out_trade_no'];//与几个订单表字段一致
        $return_data['money'] = $_POST['total_amount'];
        switch ($_POST['trade_status']) {
            case 'WAIT_BUYER_PAY':
                $return_data['order_status'] = 3;
                break;
            case 'WAIT_SELLER_SEND_GOODS':
                $return_data['order_status'] = 3;
                break;
            case 'WAIT_BUYER_CONFIRM_GOODS':
                $return_data['order_status'] = 3;
                break;
            case 'TRADE_CLOSED':
                $return_data['order_status'] = 5;
                break;
            case 'TRADE_FINISHED':
                $return_data['order_status'] = 0;
                break;
            case 'TRADE_SUCCESS':
                $return_data['order_status'] = 0;
                break;
            default:
                $return_data['order_status'] = 5;
        }
        return $return_data;
    }

}