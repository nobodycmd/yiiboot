<?php

namespace modules\merchants\backend\assets;

use yii\web\AssetBundle;

/**
 * 静态资源管理
 *
 * Class AppAsset
 * @package modules\merchants\backend\assets
 */
class AppAsset extends AssetBundle
{
    /**
     * @var string
     */
    public $sourcePath = '@addons/Merchants/backend/resources/';

    public $css = [
    ];

    public $js = [
    ];

    public $depends = [
    ];
}