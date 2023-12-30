<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

final class AdminStatusEnum extends Enum
{
    public const NGHI_VIEC = 0;
    public const HOAT_DONG = 1;

    public static function getKeyByValue($value): string
    {
        return array_search($value, self::getArrayView(), true);
    }

    public static function getArrayView(): array
    {
        return [
            'Nghỉ việc' => self::NGHI_VIEC,
            'Hoạt động' => self::HOAT_DONG,
        ];
    }
}
