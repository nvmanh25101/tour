<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

final class PaymentEnum extends Enum
{
    public const CHUYEN_KHOAN = 0;
    public const TAI_NHA = 1;

    public const TAI_VAN_PHONG = 2;



    public static function getKeyByValue($value): string
    {
        return array_search($value, self::getArrayView(), true);
    }

    public static function getArrayView(): array
    {
        return [
            'Chuyển khoản' => self::CHUYEN_KHOAN,
            'Tại nhà' => self::TAI_NHA,
            'Tại văn phòng' => self::TAI_VAN_PHONG,
        ];
    }
}
