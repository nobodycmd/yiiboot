<?php
namespace backend\controllers;

use app\service\QiniuService;
use Qiniu\Auth;

class QiniuController extends BaseController {

    /**
     * 获取七牛上传凭证
     * @return array
     */
    public function actionGetUploadToken(){
        $auth = new Auth(QiniuService::getAK(), QiniuService::getSK());
        $token = $auth->uploadToken(QiniuService::getBucket());
        echo $token;
        exit();
    }
}