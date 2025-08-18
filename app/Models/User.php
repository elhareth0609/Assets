<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'full_name',
        'username',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime'
        ];
    }

    public function getAvatarInitialAttribute() {
        return mb_substr($this->full_name, 0, 1, 'UTF-8');
    }

    public function getAvatarBackgroundClassAttribute() {
        $colors = [
            'bg-red-300/50',
            'bg-blue-300/50',
            'bg-green-300/50',
            'bg-yellow-300/50',
            'bg-purple-300/50',
            'bg-pink-300/50',
            'bg-indigo-300/50',
            'bg-teal-300/50',
            'bg-orange-300/50',
        ];

        $index = $this->id % count($colors);
        return $colors[$index];
    }

    public function getAvatarTextColorClassAttribute() {
        $colors = [
            'text-red-800',
            'text-blue-800',
            'text-green-800',
            'text-yellow-800',
            'text-purple-800',
            'text-pink-800',
            'text-indigo-800',
            'text-teal-800',
            'text-orange-800',
        ];

        $index = $this->id % count($colors);
        return $colors[$index];
    }


public function permissions()
{
    return $this->belongsToMany(Permission::class, 'user_permission');
}

public function hasPermission($permissionName)
{
    // if user has id = 1 return true
    if ($this->id == 1) {
        return true;
    }
    return $this->permissions()->where('name', $permissionName)->exists();
}

public function givePermissionTo($permission)
{
    if (is_string($permission)) {
        $permission = Permission::where('name', $permission)->firstOrFail();
    }
    $this->permissions()->syncWithoutDetaching([$permission->id]);
}

public function revokePermissionTo($permission)
{
    if (is_string($permission)) {
        $permission = Permission::where('name', $permission)->firstOrFail();
    }
    $this->permissions()->detach($permission->id);
}

public function syncPermissions($permissions)
{
    $permissionIds = [];
    foreach ($permissions as $permission) {
        if (is_string($permission)) {
            $permission = Permission::where('name', $permission)->firstOrFail();
        }
        $permissionIds[] = $permission->id;
    }
    $this->permissions()->sync($permissionIds);
}
}
