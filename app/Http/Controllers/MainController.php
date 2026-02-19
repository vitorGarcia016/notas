<?php

namespace App\Http\Controllers;

use Illuminate\Container\Attributes\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB as FacadesDB;
use Illuminate\View\View;
use PDOException;
use PhpParser\Node\Stmt\Echo_;
use PhpParser\Node\Stmt\TryCatch;

class MainController extends Controller
{

    public function login(){
        return view('login');
    }

    public function loginSubmit(Request $request){

       $request -> validate(
        [
            "text_username" => "required|email",
            "text_password" => "required|min:4|max:10"
        ],
        [
            "text_username.required" => "O campo username é obrigatório",
            "text_username.email" => "Deve informar um email válido",
            "text_password.required" => "O campo password é obrigatório",
            "text_password.min" => "A password deve ter no minino :min caracteres",
            "text_password.max" => "A password deve ter no maximo :max caracteres",

        ]
       );

       $userName = $request -> input("text_username");
       $userPassword = $request -> input("text_password");

       try {
        FacadesDB::connection() -> getPdo();
        echo "Sucesso ao tentar conectar ao bd";
       } catch (\PDOException $th) {
        echo "Falha ao tentar conectar: " .$th -> getMessage();
       }

       echo "FIM";



    }

    public function logout(){
        echo "logout";
    }

}
