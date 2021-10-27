<?php

namespace backend\assets;

class BootstrapAsset extends \yii\bootstrap\BootstrapAsset{
    public $js = [
        'js/bootstrap.js',
    ];

    public $jsOptions = [
        'position' => \yii\web\View::POS_HEAD
    ];
}