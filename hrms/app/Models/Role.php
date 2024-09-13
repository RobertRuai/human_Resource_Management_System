<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user() 
    {
        return $this->belongsTo(User::class);
    }

    public function paginate($count = 10) {
        return $this->latest()->paginate($count);
    }

    public function isAdmin() {
        return $this->user()->whereRoleId($this->role_id)->count() == 1;
    }
}
