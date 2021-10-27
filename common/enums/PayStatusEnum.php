<?php

namespace common\enums;

/**
 * 支付状态
 *
 * Class PayStatusEnum
 * @package common\enums

 */
class PayStatusEnum extends BaseEnum
{
    const NO = 0;
    const MIDWAY = 1;
    const YES = 2;

    /**
     * @return array
     */
    public static function getMap(): array
    {
        return [
            self::NO => '待支付',
            self::MIDWAY => '支付中',
            self::YES => '已支付',
        ];
    }
}