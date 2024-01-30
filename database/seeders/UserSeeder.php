<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'number_id'=>'1093221111',
            'name'=>'David',
            'last_name'=>'Torres',
            'email'=>'fernando.zapata.live@gmail.com',
            'password'=>'123456789',
            'remember_token'=> Str::random(10),
        ]);
    }
}
