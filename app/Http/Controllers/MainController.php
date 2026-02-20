<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Container\Attributes\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB as FacadesDB;
use Illuminate\View\View;
use PDOException;
use PhpParser\Node\Stmt\Echo_;
use PhpParser\Node\Stmt\TryCatch;

class MainController extends Controller
{

    public function index(){

        $userSession = session("user");

        $username = $userSession["username"];


        return view("home" , [
            "username" => $username
        ]);

    }


    public function newNotes(){
        echo "New Notes";
    }

}
