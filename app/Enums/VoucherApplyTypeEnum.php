<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

final class VoucherApplyTypeEnum extends Enum
{
    public const SAN_PHAM = 0;
    public const DICH_VU = 1;


    public static function getKeyByValue($value): string
    {
        return array_search($value, self::getArrayView(), true);
    }

    public static function getArrayView(): array
    {
        return [
            'Sản phẩm' => self::SAN_PHAM,
            'Dịch vụ' => self::DICH_VU,
        ];
    }
}
