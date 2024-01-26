<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\UserPersonalData;
class User extends Authenticatable
{
    use HasApiTokens, HasFactory;

    protected $table = 'users';
    protected $primaryKey = "id";
    protected $fillable = [
        'name',
        'password',
        'email',
        'email_verified_date',
        'reset_pass',
        'status'
      ];
    protected $hidden = ['password'];

    public $timestamps = false;
    public function validateData($data){
      if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
        return ['response' => "Invalid Email", "stts" => 500];
      }
      $user_data = ['name' => $data['name'], 'password' => $data['password'],'email' => $data['email']];
      return [
        'user_data' => $user_data
      ];
    }

    public function store($user, $data){
      $user = $this->create($user);
      if($user){
        $data['user_id'] = $user['id'];
        $personalData = UserPersonalData::create($data);
        if(!$personalData){
          return ['response' => "Personal data error", "data" => $data
          , "stts" => 500];
        }
        return ['response' => "Usuário Criado", "stts" => 200];
      }

    }
}