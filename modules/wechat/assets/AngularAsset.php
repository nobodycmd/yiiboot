<?php

namespace modules\wechat\assets;

use yii\web\AssetBundle;
use yii\web\View;

class AngularAsset extends AssetBundle
{
    public $sourcePath = '@modules/wechat/bower/angular';
    public $js = [
        'angular.js',
    ];
    public $jsOptions = [
        'position' => View::POS_HEAD
    ];
    public $depends = [
        'yii\web\JqueryAsset',
    ];
}