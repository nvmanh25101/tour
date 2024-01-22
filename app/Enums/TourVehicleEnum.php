<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

final class TourVehicleEnum extends Enum
{
    public const O_TO = 0;
    public const MAY_BAY = 1;
    public const TAU_HOA = 2;


    public static function getKeyByValue($value): string
    {
        return array_search($value, self::getArrayView(), true);
    }

    public static function getArrayView(): array
    {
        return [
            'Ô tô' => self::O_TO,
            'Máy bay' => self::MAY_BAY,
            'Tàu hỏa' => self::TAU_HOA,
        ];
    }
}
