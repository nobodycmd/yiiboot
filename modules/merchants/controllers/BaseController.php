<?php

namespace modules\merchants\controllers;

use Yii;
use yii\web\Controller;

/**
 * 默认控制器
 *
 * Class DefaultController
 * @package modules\merchants\controllers
 */
class BaseController extends Controller
{
    /**
     * @var string
     */
    public $layout = "@backend/views/layouts/main";

    /**
     * 视图文件前缀
     *
     * @var string
     */
    protected $viewPrefix = '@backend/modules/common/views/';
}