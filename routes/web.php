<?php

use App\Http\Controllers\MainController;
use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\Route;

Route::get('/main/{nome}', [MainController::class, 'index']);
