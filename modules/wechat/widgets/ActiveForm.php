<?php
namespace modules\wechat\widgets;

class ActiveForm extends \yii\bootstrap\ActiveForm
{
    /**
     * @inheritdoc
     */
    public $fieldClass = 'modules\wechat\widgets\ActiveField';
}