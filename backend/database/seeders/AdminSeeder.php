<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\UserPersonalData;

use App\Models\User;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::create([
            'id' => '88',
            'name' => 'ADMIN', 
            'password' => bcrypt('admin@motobuddy'),
            'email' => 'hiago8cs@gmail.com', 
            'phone' => '139976527406'
        ]);
        UserPersonalData::create([
            "id" => $admin->id,
            "user_id" => $admin->id,
            "cnh_src" => null,
            "profile_src" => "assets/jpg/$admin->id/sour_bill.jpg"
        ]);
        $admin->assignRole(['admin', 'developer']);
        $user = User::create([
            'id' => '1',
            'name' => 'Usuario', 
            'password' => bcrypt('123456'),
            'email' => 'usuario@gmail.com', 
            'phone' => '13912345678'
        ]);
        UserPersonalData::create([
            "id" => $user->id,
            "user_id" => $user->id,
            "cnh_src" => null,
            "profile_src" => "assets/jpg/$user->id/user_logo.jpg"
        ]);
        $user->assignRole(['user']);

        /* User::create([
            'name' => 'ADMIN', 
            'password' => 'admin@motobuddy',
            'email' => 'hiago8cs@gmail.com', 
            'phone' => '139976527406'
        ])->assignRole(['admin', 'developer']); */
    }
}
