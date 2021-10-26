<?php

namespace modules\wechat\assets;

use yii\web\AssetBundle;

class AngularDragAndDropListsAsset extends AssetBundle
{
    public $sourcePath = '@modules/wechat/bower/angular-drag-and-drop-lists';
    public $js = [
        'angular-drag-and-drop-lists.js',
    ];
    public $depends = [
        'modules\wechat\assets\AngularAsset',
    ];
}