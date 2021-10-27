<?php

namespace modules\merchants\merchant\controllers;

use Yii;
use common\controllers\AddonsController;

/**
 * 默认控制器
 *
 * Class DefaultController
 * @package modules\merchants\merchant\controllers
 */
class BaseController extends AddonsController
{
    /**
     * @var string
     */
    public $layout = "@backend/views/layouts/main";
}