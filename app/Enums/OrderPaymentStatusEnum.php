<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

final class OrderPaymentStatusEnum extends Enum
{
    public const CHUA_THANH_TOAN = 0;
    public const DA_THANH_TOAN = 1;


    public static function getKeyByValue($value): string
    {
        return array_search($value, self::getArrayView(), true);
    }

    public static function getArrayView(): array
    {
        return [
            'Chưa thanh toán' => self::CHUA_THANH_TOAN,
            'Đã thanh toán' => self::DA_THANH_TOAN,
        ];
    }
}
