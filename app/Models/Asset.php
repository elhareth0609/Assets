<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    const STATUS_IN_USE = 'in_use';
    const STATUS_IN_STORAGE = 'in_storage';
    const STATUS_MAINTENANCE = 'maintenance';
    const STATUS_DAMAGED = 'damaged';

    const STATUSES = [
        self::STATUS_IN_USE => 'In Use',
        self::STATUS_IN_STORAGE => 'In Storage',
        self::STATUS_MAINTENANCE => 'Under Maintenance',
        self::STATUS_DAMAGED => 'Damaged'
    ];

    protected $fillable = [
        'asset_name',
        'asset_number',
        'purchase_date',
        'status',
        'notes',
        'type',
        'user',
        'location',
        // 'asset_type_id',
        // 'current_user_id',
        // 'location_id'
    ];

}
