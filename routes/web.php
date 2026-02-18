<?php

use App\Http\Controllers\MainController;
use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\Route;

//Auth routes
Route::get("/login", [MainController::class, 'login']);
Route::post("/login_submit", [MainController::class, "loginSubmit"]);
Route::get("/logout", [MainController::class, 'logout']);
