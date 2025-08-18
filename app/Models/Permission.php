<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'description',
    ];

    /**
     * 获取拥有此权限的所有用户
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'user_permission');
    }
}
