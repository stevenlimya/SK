<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                "nama" => "admin",
                "email" => "admin@gmail.com",
                "username" => "admin",
                "password" => bcrypt("admin"),
                "hakakses" => "HRD",
                "created_by" => 1,
            ],
        ];

        foreach ($users as $user) {
            User::create([
                'nama' => $user['nama'],
                'email' => $user['email'],
                'username' => $user['username'],
                'password' => $user['password'],
                'hakakses' => $user['hakakses'],
                'created_by' => $user['created_by'],
            ]);
        };        
    }
};
