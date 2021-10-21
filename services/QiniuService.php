<?php
namespace services;

use Qiniu\Auth;

class QiniuService{
    public static $domain = '..';

    //https://developer.qiniu.com/kodo/kb/5869/store-uploads-and-downloads-the-domain-name
    public static $updomain = 'http://up.qiniup.com';

    private static $ak='..';
    private static $sk='..';
    private static $bucket='..';

    public static function getBucket(){
        return self::$bucket;
    }

    public static function getAK(){
        return self::$ak;
    }

    public static function getSK(){
        return self::$sk;
    }

    /**
     * @return string
     */
    public static function getUploadToken(){
        $auth = new Auth(self::getAK(), self::getSK());
        $token = $auth->uploadToken(self::getBucket());
        return $token;
    }

    /**
     * 得到文件路径
     * @param $filePath
     * @return string
     */
    public static function getFileOrigin($filePath){
        if(strpos($filePath,'http://')===0 || strpos($filePath,'https://')===0){
            return $filePath;
        }
        return self::$domain . $filePath;
    }

    /**
     * 得到原始图片地址
     * @param $filePath
     * @return string
     */
    public static function getImgStyleOrigin($filePath){
        return self::getFileOrigin($filePath);
    }

    /**
     * 得到指定宽度的图片地址
     * https://developer.qiniu.com/dora/manual/1279/basic-processing-images-imageview2
     * @param $filePath
     * @param $width
     * @return string
     */
    public static function getImg($filePath , $width){
        if(strpos($filePath,'http://')===0 || strpos($filePath,'https://')===0){
            return $filePath."?imageView2/0/w/$width/h/$width/format/jpg";
        }
        return self::$domain . $filePath."?imageView2/0/w/$width/h/$width/format/jpg";
    }


    /**
     * 得到视频0秒时候指定宽度的图片地址
     * @param $filePath
     * @param $width
     * @return string
     */
    public static function getVideoCoverImgW($filePath , $width, $height = false){
        $p = "?vframe/jpg/offset/0/w/$width";
        /*
        if($height != false){
            $p .= "/h/$height";
        }
        */
        if(strpos($filePath,'http://')===0 || strpos($filePath,'https://')===0){
            return $filePath.$p;
        }
        return self::$domain . $filePath.$p;
    }
}