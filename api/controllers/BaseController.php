<?php
namespace api\controllers;

use app\service\SimpleConfigGetService;
use yii\filters\auth\HttpHeaderAuth;
use yii\filters\Cors;
use yii\rest\Controller;


class BaseController extends Controller
{

    public function behaviors()
    {
        $behaviors = [];
        $behaviors['cors'] = [
            'class' => Cors::className(),

            'cors' => [
                // restrict access to
                'Origin' => ['*'],
                // Allow only POST and PUT methods
                //'Access-Control-Request-Method' => ['POST', 'PUT'],
                'Access-Control-Request-Method' => ['GET','POST', 'PUT'],
                // Allow only headers 'X-Wsse'
                //'Access-Control-Request-Headers' => ['X-Wsse'],
                // Allow credentials (cookies, authorization headers, etc.) to be exposed to the browser
                'Access-Control-Allow-Credentials' => true,
                // Allow OPTIONS caching
                'Access-Control-Max-Age' => 3600,
                // Allow the X-Pagination-Current-Page header to be exposed to the browser.
                'Access-Control-Expose-Headers' => ['X-Pagination-Current-Page'],
            ],
        ];
        //$behaviors['validate'] = ValidateBehavior::className();
        $behaviors = array_merge($behaviors, parent::behaviors());
        unset($behaviors['contentNegotiator']);
        $behaviors['authenticator']['authMethods'] = [
            [
                'class' => HttpHeaderAuth::className(),
                'header' => 'access-token',
            ]
        ];
        $behaviors['authenticator']['optional'] = $this->authOptional();

        return $behaviors;
    }

    protected function authOptional()
    {
        return [];
    }



    public function returnNeedLogin(){
        $this->response->setStatusCode(401);
        return 'need to login';
    }



    public function returnTipMsg($msg=''){
        //随便一个code，不等于401就行
        $this->response->setStatusCode(500);
        return $msg;
    }



    public function isWeChatBrowser()
    {
        if(isset($_SERVER['HTTP_USER_AGENT'])) {
            $user_agent = $_SERVER['HTTP_USER_AGENT'];
            return strpos($user_agent, 'MicroMessenger') !== false;
        }
        return false;
    }


}