<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'number',
        'full_name',
        'email',
        'job_title',
        'location_id',
    ];

    public function assets() {
        return $this->hasMany(Asset::class);
    }

    public function location() {
        return $this->belongsTo(Location::class);
    }
}
