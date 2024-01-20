<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

final class OrderStatusEnum extends Enum
{
    public const CHO_XAC_NHAN = 0;
    public const CHO_LAY_HANG = 1;
    public const DANG_GIAO = 2;
    public const DA_GIAO = 3;
    public const DA_HUY = 4;
    public const HOAN_THANH = 5;


    public static function getKeyByValue($value): string
    {
        return array_search($value, self::getArrayView(), true);
    }

    public static function getArrayView(): array
    {
        return [
            'Chờ xác nhận' => self::CHO_XAC_NHAN,
            'Chờ lấy hàng' => self::CHO_LAY_HANG,
            'Đang giao' => self::DANG_GIAO,
            'Đã giao' => self::DA_GIAO,
            'Đã hủy' => self::DA_HUY,
            'Hoàn thành' => self::HOAN_THANH,
        ];
    }
}
