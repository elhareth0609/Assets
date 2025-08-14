<?php

namespace App\Enums;

enum AssetStatus: string
{
    case IN_USE = 'in_use';
    case DAMAGED = 'damaged';
    case MAINTENANCE = 'maintenance';
    case IN_STORAGE = 'in_storage';

    public function label(): string
    {
        return match($this) {
            self::IN_USE => __('statuses.in_use'),
            self::DAMAGED => __('statuses.damaged'),
            self::MAINTENANCE => __('statuses.maintenance'),
            self::IN_STORAGE => __('statuses.in_storage'),
        };
    }

    public function arabicLabel(): string
    {
        return match($this) {
            self::IN_USE => 'قيد الاستخدام',
            self::DAMAGED => 'تالف',
            self::MAINTENANCE => 'صيانة',
            self::IN_STORAGE => 'قيد الانتظار',
        };
    }

    public function class(): string
{
        return match($this) {
            self::IN_USE => '',
            self::DAMAGED => '',
            self::MAINTENANCE => '',
            self::IN_STORAGE => '' ,
        };
    }

}
