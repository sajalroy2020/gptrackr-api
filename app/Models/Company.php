<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Company extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'company_name',
        'website_url',
        'company_owner_name',
        'company_email',
        'password',
        'status',
    ];

    protected $hidden = [
        'password',
    ];

    public function fundProfiles()
    {
        return $this->hasMany(FundProfile::class);
    }
}
