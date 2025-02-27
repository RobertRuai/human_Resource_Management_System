<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'email',
        'password',
        'role_id',
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
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function role() 
    {
        return $this->belongsToMany(Role::class, 'role_user');
    }

    public function employee () 
    {
        return $this->hasOne(Employee::class);
    }

    public function notification() 
    {
        return $this->hasMany(notification::class);
    }

    public function audit_log() 
    {
        return $this->hasMany(audit_log::class);
    }

    public function paginate($count = 10) 
    {
        return $this->with('role')->latest()->paginate($count);
    }

    public function getProfile() 
    {
        return $this->with('employee')->where('id', auth()->id())->first();
    }

    public function hasAnyRole($roles)
    {
        return $this->roles()->whereIn('name', $roles)->exists();
    }
}
