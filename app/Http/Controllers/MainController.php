<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class MainController extends Controller
{

    public function login(){
        return view('login');
    }

    public function loginSubmit(Request $request){

       $request -> validate(
        [
            "text_username" => "required",
            "text_password" => "required"
        ]
       );

       $userName = $request -> input("text_username");
       $userPassword = $request -> input("text_password");

       echo "ok";



    }

    public function logout(){
        echo "logout";
    }

}
