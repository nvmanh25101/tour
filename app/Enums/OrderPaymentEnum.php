<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

final class OrderPaymentEnum extends Enum
{
    public const TIEN_MAT = 0;
    public const CHUYEN_KHOAN = 1;


    public static function getKeyByValue($value): string
    {
        return array_search($value, self::getArrayView(), true);
    }

    public static function getArrayView(): array
    {
        return [
            'Tiền mặt' => self::TIEN_MAT,
            'Chuyển khoản' => self::CHUYEN_KHOAN,
        ];
    }
}
