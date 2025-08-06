<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Role;
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
        // 'first_name',
        // 'last_name',
        'full_name',
        // 'phone',
        'username',
        // 'email',
        // 'theme',
        // 'lang',
        // 'photo',
        // 'role_id',
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

    // public function getFullNameAttribute() {
    //     return $this->first_name . ' ' . $this->last_name;
    // }


    // public function getPhotoUrlAttribute() {
    //     return $this->photo ? asset('assets/img/photos/users/' . $this->photo) : asset('assets/img/photos/users/default.png');
    // }

    // public function getPhotoPathAttribute() {
    //     return $this->photo ? public_path('assets/img/photos/users/' . $this->photo) : null;
    // }

    public function role() {
        return $this->belongsTo(Role::class);
    }

    public function hasRole($roleName) {
        return $this->role && $this->role->name === $roleName;
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
}
