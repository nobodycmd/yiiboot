<?php
namespace services;


/**
 *
 * @package app\services
 */
class TimeService
{

    public static function getNowYmdhis(){
        return date('Y-m-d H:i:s');
    }

    /**
     * PHP获得两日期间隔天数
     * @param null $date1
     * @param null $date2
     * @return string
     */
    public static function getIntervalDay($date1 = null, $date2 = null){
        $datetime1 = date_create($date1);
        $datetime2 = date_create($date2);
        $interval = date_diff($datetime1, $datetime2);
        return $interval->format('%a');
    }

    /**
     * 返回当前是时间所在的年份里面的第几周
     * @param int $timestamp
     * @return false|string
     */
    public static function getWeekInCurrentYear($timestamp=0)
    {
        return date('W', $timestamp ? $timestamp : \time());
    }

}