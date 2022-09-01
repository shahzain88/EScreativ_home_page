<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' =>   "Super Admin",
            'email' =>  "superadmin@info.com",
            "username" => "super-admin",
            "status" => true,
            "role_id" => 1,
            'password' => Hash::make('12345678'),
        ]);

        DB::table('users')->insert([
            'name' =>   "Admin",
            'email' =>  "admin@info.com",
            "username" => "admin",
            "status" => true,
            "role_id" => 1,
            'password' => Hash::make('12345678'),
        ]);
    }
}
