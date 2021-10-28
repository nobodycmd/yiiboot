<?php

namespace api\common\components;

use api\models\BaseUser;
use app\service\RedisService;
use yii\filters\auth\HttpHeaderAuth;
use yii\filters\Cors;
use yii\helpers\StringHelper;

class Auth extends HttpHeaderAuth{

    /**
     * @var string the HTTP header name
     */
    public $header = 'X-Access-Token';
    /**
     * @var string a pattern to use to extract the HTTP authentication value
     */
    public $pattern;

    /**
     * {@inheritdoc}
     */
    public function authenticate($user, $request, $response)
    {
        return parent::authenticate($user, $request, $response);
    }
}