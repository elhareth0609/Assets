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
        'first_name',
        'last_name',
        'phone',
        'username',
        'email',
        'theme',
        'lang',
        'photo',
        'role_id',
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

    public function getFullNameAttribute() {
        return $this->first_name . ' ' . $this->last_name;
    }


    public function getPhotoUrlAttribute() {
        return $this->photo ? asset('assets/img/photos/users/' . $this->photo) : asset('assets/img/photos/users/default.png');
    }

    public function getPhotoPathAttribute() {
        return $this->photo ? public_path('assets/img/photos/users/' . $this->photo) : null;
    }
    

    public function chatRooms() {
        return $this->belongsToMany(ChatRoom::class)
                    ->using(ChatRoomUser::class) // Specify the pivot model
                    ->withTimestamps(); // Include timestamps if needed
    }
    

    public function messages() {
        return $this->hasMany(Message::class);
    }

    public function car() {
        return $this->belongsTo(Car::class);
    }

    public function role() {
        return $this->belongsTo(Role::class);
    }

    public function hasRole($roleName) {
        return $this->role && $this->role->name === $roleName;
    }

}
