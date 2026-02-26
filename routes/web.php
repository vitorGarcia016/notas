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

    Route::get("/cadastro", [AuthController::class, "cadastro"])->name("cadastro");
    Route::post("/cadastro_Submit", [AuthController::class, "cadastroSubmit"])->name("cadastroSubmit");


});

Route::middleware([CheckIsLogged::class])->group(function(){

    Route::get("/", [MainController::class, "index"])->name("home");

    Route::get("/edit/{id}", [MainController::class, "editNote"])->name("editNotes");
    Route::post("/editSubmit", [MainController::class, "editNoteSubmit"])->name("editNotesSubmit");

    Route::get("/delete/{id}", [MainController::class, "deleteNote"])->name("deleteNotes");
    Route::get("/delete_confirm/{id}", [MainController::class, "deleteConfirmNote"])->name("deleteConfirmNotes");

    Route::get("/new_note", [MainController::class, "newNote"])->name("newNote");
    Route::post("/new_note_submit", [MainController::class, "newNoteSubmit"])->name("newNoteSubmit");

    Route::get("/logout", [AuthController::class, 'logout'])->name("logout");
});
