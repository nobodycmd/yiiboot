<?php

namespace modules\merchants\merchant\assets;

use yii\web\AssetBundle;

/**
 * 静态资源管理
 *
 * Class AppAsset
 * @package modules\merchants\merchant\assets
 */
class AppAsset extends AssetBundle
{
    /**
     * @var string
     */
    public $sourcePath = '@addons/Merchants/merchant/resources/';

    public $css = [
    ];

    public $js = [
    ];

    public $depends = [
    ];
}