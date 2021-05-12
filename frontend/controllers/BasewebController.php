<?php
namespace frontend\controllers;

use app\service\MsgcodeService;
use app\service\PageService;
use app\service\SimpleConfigGetService;
use app\service\UserBizService;
use common\models\User;
use yii\data\Pagination;
use yii\db\ActiveQuery;
use yii\web\Controller;


class BasewebController extends Controller
{
    public $layout = false;

    protected $param;
    /**
     * 请求网页的第几页
     * @var integer
     */
    public $page;

    /**
     * @var \Yii::$app->request
     */
    protected $request;

    /**
     * @var \Yii::$app->response
     */
    protected $response;

    /**
     * @var Pagination
     */
    public $pagination;

    /**
     * @var $needtologin bool 需要登录，默认不需要登录
     */
    public $needtologin = false;

    /**
     * 当前登录的用户
     * @var \common\models\User
     */
    public $user = null;


    public function beforeAction($action)
    {
        $this->enableCsrfValidation = false;
        // ...set `$this->enableCsrfValidation` here based on some conditions...
        // call parent method that will check CSRF if such property is `true`.
        return parent::beforeAction($action);
    }

    public function getHostInfo()
    {
        return $this->request->hostInfo;
    }

    /**
     * 返回ar[]数组和分页对象
     * @param ActiveQuery $query
     * @param number $page
     * @param number $pageSize
     * @param string $asArray
     * @return \yii\data\Pagination[]|array[]|\yii\db\ActiveRecord[][]
     */
    public function getPageData(ActiveQuery $query, $page = 1, $pageSize = 20, $asArray = false)
    {
        $ary = PageService::getPageData($query, $page, $pageSize, $asArray);
        $this->pagination = $ary['pages'];
        return $ary;
    }

    /**
     * @param string $id the ID of this controller.
     * @param string $module the module that this controller belongs to.
     * @param array $config name-value pairs that will be used to initialize the object properties.
     */
    public function __construct($id, $module, $config = [])
    {

        if (\Yii::$app->getRequest()->getMethod() === 'OPTIONS') {
            header('Access-Control-Allow-Origin: *');
            exit;
        }

        \Yii::$app->getSession()->destroy();
        parent::__construct($id, $module, $config);

        $this->request = \Yii::$app->request;
        $this->response = \Yii::$app->response;


        if($this->request->isOptions){
            echo json_encode( $this->jsonSuccess() );exit(0);
        }


        //all param name is lower
        $this->param = array_merge($this->request->get(), $this->request->post());

        //小写给来一份
        foreach ($this->param as $k => $v) {
            $lower_key = strtolower($k);
            //if ($k != $lower_key) {
                //unset($this->param[$k]);
                $this->param[$lower_key] = $v;
            //}
        }

        $this->page = $this->getParam('page') ? intval($this->getParam('page')) : 1;

        if ($usertoken = $this->getParam('token')) {
            $this->user = User::findOne([
                'auth_key' => $usertoken
            ]);
            if($this->user){
                UserBizService::setOrGetAppLoginUser($this->user);
            }
        }

        if ($this->needtologin && !$this->user) {
            echo json_encode($this->jsonFail(MsgcodeService::NEED_LOGIN));
            exit();
        }
    }

    /**
     * get request param value
     * @param string $name
     * @return boolean
     */
    public function getParam($name)
    {
        $name = strtolower($name);
        if (!isset($this->param[$name])) {
            return false;
        }
        return $this->param[$name];
    }

    public function jsonSuccess($data = [])
    {
        header('Access-Control-Allow-Origin: *');
        $this->response->format = \yii\web\response::FORMAT_JSON;
        return [
            'code' => 0,
            'msg' => '',
            'data' => $data
        ];
    }

    public function jsonTip($msg='tip'){
        header('Access-Control-Allow-Origin: *');
        $this->response->format = \yii\web\response::FORMAT_JSON;
        echo \json_encode([
            'code' => 200,
            'msg' => $msg,
            'data' => []
        ]);
        exit;
    }


    public function jsonpSuccess($data = [])
    {
        $this->response->format = \yii\web\response::FORMAT_JSONP;
        $callback = $this->getParam('callback');
        if (!$callback) {
            $callback = 'callback';
        }
        exit($callback . '(' . json_encode([
                'code' => 0,
                'msg' => '',
                'data' => $data
            ]) . ')');
    }

    public function jsonpFail($msg='fail')
    {
        $this->response->format = \yii\web\response::FORMAT_JSONP;
        $callback = $this->getParam('callback');
        if (!$callback) {
            $callback = 'callback';
        }
        exit($callback . '(' . json_encode([
                'code' => 200,
                'msg' => $msg,
            ]) . ')');
    }

    public function jsonPure(&$data)
    {
        $this->response->format = \yii\web\response::FORMAT_JSON;
        return $data;
    }

    function convertUrlQuery($query)
    {
        $queryParts = explode('&', $query);
        $params = array();
        foreach ($queryParts as $param) {
            $item = explode('=', $param);
            $params[$item[0]] = $item[1];
        }
        return $params;
    }

    function getUrlQuery($array_query)
    {
        $tmp = array();
        foreach($array_query as $k=>$param)
        {
            $tmp[] = $k.'='.$param;
        }
        $params = implode('&',$tmp);
        return $params;
    }

    public function isWeChatBrowser()
    {
        if(isset($_SERVER['HTTP_USER_AGENT'])) {
            $user_agent = $_SERVER['HTTP_USER_AGENT'];
            return strpos($user_agent, 'MicroMessenger') !== false;
        }
        return false;
    }

    public function isIOSChecking()
    {

        $isChecking = false;

        if ($this->getParam('systemType') == 'ios') {
            $strVersion = SimpleConfigGetService::getIOSCheckingVersion();
            if ($strVersion) {
                $isChecking = in_array($this->getParam('version'), explode(',', $strVersion));
            }
        }
        return $isChecking;
    }

}