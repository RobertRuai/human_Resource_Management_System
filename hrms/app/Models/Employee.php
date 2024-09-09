<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'personal_id_number', 'first_name', 'middle_name', 'last_name', 'date_of_birth', 
        'phone', 'email', 'city', 'address', 'postal_code', 'qualification',
        'current_experience', 'job_title', 'grade', 'date_of_employment',
        'type_of_employment', 'division', 'department', 'location',
        'gender', 'marital_status', 'next_of_kin'
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

    public function leave_information() {
        return $this->hasMany(leave_information::class);
    }



}
