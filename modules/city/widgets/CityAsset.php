<?php

namespace modules\city\widgets;


use yii\web\AssetBundle;

class CityAsset extends AssetBundle
{
    public $sourcePath = '@modules/city/widgets/assets';

    public $js = [
        'city.js'
    ];

    public $depends = [
        'yii\web\JqueryAsset'
    ];
}