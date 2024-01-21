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
        'cnh_src',
        'phone'
      ];

    public $timestamps = false;
    public function validatePhone($phone){
      if(isset($data['phone'])){
        $data['phone'] = preg_replace('/\D/', '', $data['phone']);
        if (strlen($data['phone']) == 14) $data['phone'] = preg_replace("/^1/", '',$data['phone']);
        if (strlen($data['phone']) < 11) return ['response' => "Invalid Phone Number", "stts" => 500];

        return $phone;
      }
      else{
        return null;
      }
    }
    public static function validateCNH($cnh){
      if(!isset($cnh)){
        $cnh = null;
      }
      return $cnh;
    }
}
