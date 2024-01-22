<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

final class PaymentEnum extends Enum
{
    public const TAI_CUA_HANG = 0;
    public const CHUYEN_KHOAN = 1;
    public const TAI_NHA = 2;

    public const TAI_VAN_PHONG = 3;



    public static function getKeyByValue($value): string
    {
        return array_search($value, self::getArrayView(), true);
    }

    public static function getArrayView(): array
    {
        return [
            'Tại cửa hàng' => self::TAI_CUA_HANG,
            'Chuyển khoản' => self::CHUYEN_KHOAN,
        ];
    }
}
