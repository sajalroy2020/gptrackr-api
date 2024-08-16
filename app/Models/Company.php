<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Company extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'company_name',
        'email',
        'password',
        'user_type',
    ];

    protected $hidden = [
        'password',
    ];

    public function fundProfiles()
    {
        return $this->hasMany(FundProfile::class);
    }
}