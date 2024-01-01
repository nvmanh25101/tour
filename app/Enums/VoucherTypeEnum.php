<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

final class VoucherTypeEnum extends Enum
{
    public const PHAN_TRAM = 0;
    public const TIEN = 1;


    public static function getKeyByValue($value): string
    {
        return array_search($value, self::getArrayView(), true);
    }

    public static function getArrayView(): array
    {
        return [
            'Theo %' => self::PHAN_TRAM,
            'Theo tiền' => self::TIEN,
        ];
    }
}
