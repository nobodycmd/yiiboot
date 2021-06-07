<?php
namespace app\service;

class BrowserInfoService
{

    public static  function getBroswerName()
    {
        if(isset($_SERVER) && isset($_SERVER['HTTP_USER_AGENT']) == false)
            return '未知浏览器';

        $sys = $_SERVER['HTTP_USER_AGENT'];  //获取用户代理字符串

        $exp[0] = "未知浏览器";
        $exp[1] = "";
        //stripos() 函数查找字符串在另一字符串中第一次出现的位置（不区分大小写）    preg_match()执行匹配正则表达式
        if (stripos($sys, "Firefox/") > 0) {
            preg_match("/Firefox\/([^;)]+)+/i", $sys, $b);
            $exp[0] = "Firefox";
            $exp[1] = $b[1];  //获取火狐浏览器的版本号
        }
        if (stripos($sys, "Maxthon") > 0) {
            preg_match("/Maxthon\/([\d\.]+)/", $sys, $aoyou);
            $exp[0] = "傲游";
            $exp[1] = $aoyou[1];
        }
        if (stripos($sys, "MSIE") > 0) {
            preg_match("/MSIE\s+([^;)]+)+/i", $sys, $ie);
            $exp[0] = "IE";
            $exp[1] = $ie[1];  //获取IE的版本号
        }
        if (stripos($sys, "OPR") > 0) {
            preg_match("/OPR\/([\d\.]+)/", $sys, $opera);
            $exp[0] = "Opera";
            $exp[1] = $opera[1];
        }
        if (stripos($sys, "Edge") > 0) {
            //win10 Edge浏览器 添加了chrome内核标记 在判断Chrome之前匹配
            preg_match("/Edge\/([\d\.]+)/", $sys, $Edge);
            $exp[0] = "Edge";
            $exp[1] = $Edge[1];
        }
        if (stripos($sys, "Chrome") > 0) {
            preg_match("/Chrome\/([\d\.]+)/", $sys, $google);
            $exp[0] = "Chrome";
            $exp[1] = $google[1];  //获取google chrome的版本号
        }
        if (stripos($sys, 'rv:') > 0 && stripos($sys, 'Gecko') > 0) {
            preg_match("/rv:([\d\.]+)/", $sys, $IE);
            $exp[0] = "IE";
            $exp[1] = $IE[1];
        }
        return $exp[0] . '(' . $exp[1] . ')';
    }


    //获取操作系统
    public static function getOsName()
    {
        if(isset($_SERVER) && isset($_SERVER['HTTP_USER_AGENT']) == false)
            return '未知操作系统';

        $agent = $_SERVER['HTTP_USER_AGENT'];
        $os = '未知操作系统';

        if (preg_match('/win/i', $agent) && strpos($agent, '95')) {
            $os = 'Windows 95';
        }
        if (preg_match('/win 9x/i', $agent) && strpos($agent, '4.90')) {
            $os = 'Windows ME';
        }
        if (preg_match('/win/i', $agent) && preg_match('/98/i', $agent)) {
            $os = 'Windows 98';
        }
        if (preg_match('/win/i', $agent) && preg_match('/nt/i', $agent)) {
            $os = 'Windows NT';
        }
        if (preg_match('/win/i', $agent) && preg_match('/nt 6.0/i', $agent)) {
            $os = 'Windows Vista';
        }
        if (preg_match('/win/i', $agent) && preg_match('/nt 6.1/i', $agent)) {
            $os = 'Windows 7';
        }
        if (preg_match('/win/i', $agent) && preg_match('/nt 6.2/i', $agent)) {
            $os = 'Windows 8';
        }
        if (preg_match('/win/i', $agent) && preg_match('/nt 10.0/i', $agent)) {
            $os = 'Windows 10';#添加win10判断
        }
        if (preg_match('/win/i', $agent) && preg_match('/nt 5.1/i', $agent)) {
            $os = 'Windows XP';
        }
        if (preg_match('/win/i', $agent) && preg_match('/nt 5/i', $agent)) {
            $os = 'Windows 2000';
        }

        if (preg_match('/win/i', $agent) && preg_match('/32/i', $agent)) {
            $os = 'Windows 32';
        }
        if (preg_match('/linux/i', $agent)) {
            $os = 'Linux';
        }
        if (preg_match('/unix/i', $agent)) {
            $os = 'Unix';
        }
        if (preg_match('/sun/i', $agent) && preg_match('/os/i', $agent)) {
            $os = 'SunOS';
        }
        if (preg_match('/ibm/i', $agent) && preg_match('/os/i', $agent)) {
            $os = 'IBM OS/2';
        }
        if (preg_match('/Mac/i', $agent) && preg_match('/PC/i', $agent)) {
            $os = 'Macintosh';
        }
        if (preg_match('/PowerPC/i', $agent)) {
            $os = 'PowerPC';
        }
        if (preg_match('/AIX/i', $agent)) {
            $os = 'AIX';
        }
        if (preg_match('/HPUX/i', $agent)) {
            $os = 'HPUX';
        }
        if (preg_match('/NetBSD/i', $agent)) {
            $os = 'NetBSD';
        }
        if (preg_match('/BSD/i', $agent)) {
            $os = 'BSD';
        }
        if (preg_match('/OSF1/i', $agent)) {
            $os = 'OSF1';
        }
        if (preg_match('/IRIX/i', $agent)) {
            $os = 'IRIX';
        }
        if (preg_match('/FreeBSD/i', $agent)) {
            $os = 'FreeBSD';
        }
        if (preg_match('/teleport/i', $agent)) {
            $os = 'teleport';
        }
        if (preg_match('/flashget/i', $agent)) {
            $os = 'flashget';
        }
        if (preg_match('/webzip/i', $agent)) {
            $os = 'webzip';
        }
        if (preg_match('/offline/i', $agent)) {
            $os = 'offline';
        }
        if (strpos($agent, 'iphone')) {
            $os = 'iphone';
        }
        if (strpos($agent, 'ipad')) {
            $os = 'ipad';
        }
        if (strpos($agent, 'android')) {
            $os = 'android';
        }
        if (stripos($agent, "SAMSUNG") !== false || stripos($agent, "Galaxy") !== false || strpos($agent, "GT-") !== false || strpos($agent, "SCH-") !== false || strpos($agent, "SM-") !== false) {
            $os = 'android ->三星';
        }
        if (stripos($agent, "Huawei") !== false || stripos($agent, "Honor") !== false || stripos($agent, "H60-") !== false || stripos($agent, "H30-") !== false) {
            $os = 'android ->华为';
        }
        if (stripos($agent, "Lenovo") !== false) {
            $os = 'android ->联想';
        }
        if (strpos($agent, "MI-ONE") !== false || strpos($agent, "MI 1S") !== false || strpos($agent, "MI 2") !== false || strpos($agent, "MI 3") !== false || strpos($agent, "MI 4") !== false || strpos($agent, "MI-4") !== false) {
            $os = 'android ->小米';
        }
        if (strpos($agent, "HM NOTE") !== false || strpos($agent, "HM201") !== false) {
            $os = 'android ->红米';
        }
        if (stripos($agent, "Coolpad") !== false || strpos($agent, "8190Q") !== false || strpos($agent, "5910") !== false) {
            $os = 'android ->酷派';
        }
        if (stripos($agent, "ZTE") !== false || stripos($agent, "X9180") !== false || stripos($agent, "N9180") !== false || stripos($agent, "U9180") !== false) {
            $os = 'android ->中兴';
        }
        if (stripos($agent, "OPPO") !== false || strpos($agent, "X9007") !== false || strpos($agent, "X907") !== false || strpos($agent, "X909") !== false || strpos($agent, "R831S") !== false || strpos($agent, "R827T") !== false || strpos($agent, "R821T") !== false || strpos($agent, "R811") !== false || strpos($agent, "R2017") !== false) {
            $os = 'android ->OPPO';
        }
        if (strpos($agent, "HTC") !== false || stripos($agent, "Desire") !== false) {
            $os = 'android ->HTC';
        }
        if (stripos($agent, "vivo") !== false) {
            $os = 'android ->vivo';
        }
        if (stripos($agent, "K-Touch") !== false) {
            $os = 'android ->天语';
        }
        if (stripos($agent, "Nubia") !== false || stripos($agent, "NX50") !== false || stripos($agent, "NX40") !== false) {
            $os = 'android ->努比亚';
        }
        if (strpos($agent, "M045") !== false || strpos($agent, "M032") !== false || strpos($agent, "M355") !== false) {
            $os = 'android ->魅族';
        }
        if (stripos($agent, "DOOV") !== false) {
            $os = 'android ->朵唯';
        }
        if (stripos($agent, "GFIVE") !== false) {
            $os = 'android ->基伍';
        }
        if (stripos($agent, "Gionee") !== false || strpos($agent, "GN") !== false) {
            $os = 'android ->金立';
        }
        if (stripos($agent, "HS-U") !== false || stripos($agent, "HS-E") !== false) {
            $os = 'android ->海信';
        }
        if (stripos($agent, "Nokia") !== false) {
            $os = 'android ->诺基亚';
        }
        return $os;
    }


    /**
     * 是否移动端访问访问
     * 判断当前访问的用户是  PC端  还是 手机端  返回true 为手机端  false 为PC 端
     * @return boolean
     */
    function isMobile()
    {
        $code = 2;
        // 如果有HTTP_X_WAP_PROFILE则一定是移动设备
        if (isset ($_SERVER['HTTP_X_WAP_PROFILE'])) {
            $code = 1;
        }
        // 如果via信息含有wap则一定是移动设备,部分服务商会屏蔽该信息
        if (isset ($_SERVER['HTTP_VIA'])) {
            // 找不到为flase,否则为true
            $code = stristr($_SERVER['HTTP_VIA'], "wap") ? 1 : 2;
        }
        // 脑残法，判断手机发送的客户端标志,兼容性有待提高
        if (isset ($_SERVER['HTTP_USER_AGENT'])) {
            $clientkeywords = array('nokia',
                'sony',
                'ericsson',
                'mot',
                'samsung',
                'htc',
                'sgh',
                'lg',
                'sharp',
                'sie-',
                'philips',
                'panasonic',
                'alcatel',
                'lenovo',
                'iphone',
                'ipod',
                'blackberry',
                'meizu',
                'android',
                'netfront',
                'symbian',
                'ucweb',
                'windowsce',
                'palm',
                'operamini',
                'operamobi',
                'openwave',
                'nexusone',
                'cldc',
                'midp',
                'wap',
                'mobile'
            );
            // 从HTTP_USER_AGENT中查找手机浏览器的关键字
            if (preg_match("/(" . implode('|', $clientkeywords) . ")/i", strtolower($_SERVER['HTTP_USER_AGENT']))) {
                $code = 1;
            }
        }
        // 协议法，因为有可能不准确，放到最后判断
        if (isset ($_SERVER['HTTP_ACCEPT'])) {
            // 如果只支持wml并且不支持html那一定是移动设备
            // 如果支持wml和html但是wml在html之前则是移动设备
            if ((strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') !== false) && (strpos($_SERVER['HTTP_ACCEPT'], 'text/html') === false || (strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') < strpos($_SERVER['HTTP_ACCEPT'], 'text/html')))) {
                $code = 1;
            }
        }
        return $code;
    }


}