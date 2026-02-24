<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class AuthController extends Controller
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


       $userBd = User::where("username", $userName)
                                ->where("deleted_at", null)
                                ->first();


        if(!($userBd && password_verify($userPassword, $userBd->password))){
            return redirect()
                    ->back()
                    ->withInput()
                    ->with("LoginError", "Username or Password not found");
        }


        $userBd->last_login = date("Y-m-d H:i:s");
        $userBd->save();


        session([
            "user" => [
                "id" => $userBd->id,
                "username" => $userBd->username
            ]
        ]);

        return redirect(route("home"));
    }

    public function logout(){
       session()->forget("user");

       return redirect()->to(route("login"));
    }
}
