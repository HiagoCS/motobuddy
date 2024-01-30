<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;


class UserPersonalData extends Authenticatable
{
    use HasApiTokens, HasFactory;

    protected $table = 'user_personal_data';
    protected $primaryKey = "id";
    protected $fillable = [
        'user_id',
        'profile_src',
        'cnh_src',
        'phone'
      ];

    public $timestamps = false;
}
