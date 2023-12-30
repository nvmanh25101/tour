<?php declare(strict_types=1);

namespace App\Enums\Category;

use BenSampo\Enum\Enum;

final class StatusEnum extends Enum
{
    public const NGUNG_HOAT_DONG = 0;
    public const HOAT_DONG = 1;

    public static function getKeyByValue($value): string
    {
        return array_search($value, self::getArrayView(), true);
    }

    public static function getArrayView(): array
    {
        return [
            'Ngừng hoạt động' => self::NGUNG_HOAT_DONG,
            'Hoạt động' => self::HOAT_DONG,
        ];
    }
}
