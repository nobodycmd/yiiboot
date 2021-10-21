<?php
namespace services;

use yii\web\Response;

/**
 *
 * @package app\services
 */
class RestErrorHandleService extends \yii\web\ErrorHandler
{
    public function renderException($exception)
    {
        if( defined('YII_ENV') && YII_ENV === 'dev' ){
            parent::renderException($exception);
            return;
        }

        $ary = $this->convertExceptionToArray($exception);
        \Yii::error($ary);
        header('Content-Type: application/json; charset=UTF-8');
        echo json_encode([
            'code' => 500,
            'msg' => $ary['message'],
            'data' => null
        ]);
        exit;
    }
}