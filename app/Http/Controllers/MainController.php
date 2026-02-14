<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class MainController extends Controller
{
    public function index($nome){
        return View("Main", [
            'nome' => $nome
        ]);
    }
}
