<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

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
        $user = User::create([
            'name' => 'ADMIN', 
            'password' => 'admin@motobuddy',
            'email' => 'hiago8cs@gmail.com', 
            'phone' => '139976527406'
        ]);
        $user->assignRole(['admin', 'developer']);

        /* User::create([
            'name' => 'ADMIN', 
            'password' => 'admin@motobuddy',
            'email' => 'hiago8cs@gmail.com', 
            'phone' => '139976527406'
        ])->assignRole(['admin', 'developer']); */
    }
}
