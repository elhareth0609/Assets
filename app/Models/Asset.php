<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Enums\AssetStatus;

class Asset extends Model {

    protected $fillable = [
        'name',
        'number',
        'manufacturer_serial',
        'purchase_date',
        'status',
        'notes',
        'type_id',
        'employee_id',
        'location_id',
    ];

    protected $casts = [
        'status' => AssetStatus::class,
    ];

    public function type() {
        return $this->belongsTo(Type::class, 'type_id');
    }

    public function employee() {
        return $this->belongsTo(Employee::class, 'employee_id');
    }

    public function location() {
        return $this->belongsTo(Location::class, 'location_id');
    }
}
