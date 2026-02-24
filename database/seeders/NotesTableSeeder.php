<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NotesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table("notes")->insert([[
            "user_id" => 1,
            "title" => "Atividade de Matematica",
            "text" => "Fazer exercicio da pagina 3",
            "created_at" => date("Y-m-d H:i:s"),
            "date_delivery" => date("Y-m-d")
        ],
        [
            "user_id" => 1,
            "title" => "Atividade de Filosofia",
            "text" => "Fazer Mapa mental",
            "created_at" => date("Y-m-d H:i:s"),
            "date_delivery" => date("Y-m-d")
        ]]);
    }
}
