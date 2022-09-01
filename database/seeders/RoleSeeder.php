<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            'name' =>   "Super Admin",
            "slug" => "super-admin",
            "status" => true,
        ]);
        DB::table('roles')->insert([
            'name' =>   "Admin",
            "slug" => "admin",
            "status" => true,
        ]);
        DB::table('roles')->insert([
            'name' =>   "Author",
            "slug" => "author",
            "status" => true,
        ]);
        DB::table('roles')->insert([
            'name' =>   "Editor",
            "slug" => "editor",
            "status" => true,
        ]);
        DB::table('roles')->insert([
            'name' =>   "Subscriber",
            "slug" => "subscriber",
            "status" => true,
        ]);
        DB::table('roles')->insert([
            'name' =>   "Customer",
            "slug" => "customer",
            "status" => true,
        ]);
    }
}
