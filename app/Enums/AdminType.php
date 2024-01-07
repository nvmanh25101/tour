<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;


final class AdminType extends Enum
{
    public const NHAN_VIEN = 0;
    public const QUAN_LY = 1;
    public const VAN_CHUYEN = 2;

    public const DICH_VU = 3;

    public static function getKeyByValue($value): string
    {
        return array_search($value, self::getArrayView(), true);
    }

    public static function getArrayView(): array
    {
        return [
            'Nhân viên' => self::NHAN_VIEN,
            'Quản lý' => self::QUAN_LY,
            'Vận chuyển' => self::VAN_CHUYEN,
            'Nhân viên dịch vụ' => self::DICH_VU,
        ];
    }
}
