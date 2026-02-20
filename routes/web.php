<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\TestController;
use App\Http\Middleware\CheckIsLogged;
use App\Http\Middleware\CheckUserSesseion;
use Illuminate\Support\Facades\Route;

//Auth routes
Route::middleware([CheckUserSesseion::class])->group(function(){
    Route::get("/login", [AuthController::class, 'login'])->name("login");
    Route::post("/login_submit", [AuthController::class, "loginSubmit"])->name("loginSubmit");

});

Route::middleware([CheckIsLogged::class])->group(function(){

    Route::get("/", [MainController::class, "index"])->name("home");
    Route::get("/new_notes", [MainController::class, "newNotes"])->name("newNotes");
    Route::get("/logout", [AuthController::class, 'logout'])->name("logout");
});

