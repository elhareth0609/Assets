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

/*************  ✨ Windsurf Command ⭐  *************/
    /**
     * Get the Arabic translation of the status.
     *
/*******  f8744fab-cac0-4dae-ac7e-ed256df7add4  *******/
    public function arabicLabel(): string
    {
        return match($this) {
            self::IN_USE => 'قيد الاستخدام',
            self::DAMAGED => 'تالف',
            self::MAINTENANCE => 'صيانة',
            self::IN_STORAGE => 'قيد الانتظار',
        };
    }
}
