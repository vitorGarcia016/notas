<?php

namespace Database\Seeders;

use DateTime;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table("users")->insert([[
            "username" => "vitor@gmail.com",
            "password" => bcrypt(1234),
            "created_at" => date("Y-m-d H:i:s")
        ],
        [
            "username" => "Jessyca@gmail.com",
            "password" => bcrypt(1234),
            "created_at" => date("Y-m-d H:i:s")
        ],
        [
            "username" => "Ana@gmail.com",
            "password" => bcrypt(1234),
            "created_at" => date("Y-m-d H:i:s")
        ]]
        );
    }
}
