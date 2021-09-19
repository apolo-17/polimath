<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'last_name', 'company_id', 'email', 'phone_number'];

    public function company()
    {
        return $this->hasOne(Company::class);
    }
}
