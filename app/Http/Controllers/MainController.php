<?php

namespace App\Http\Controllers;

use App\Note;
use App\Services\Operations;
use App\User;
use Illuminate\Container\Attributes\DB;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB as FacadesDB;
use Illuminate\View\View;
use PDOException;
use PhpParser\Node\Stmt\Echo_;
use PhpParser\Node\Stmt\TryCatch;

class MainController extends Controller
{

    public function index(){

       $userSession = $this->getUserSession();
       $user = User::find($userSession["id"])->toArray();
       $notes = User::find($userSession["id"])->notes()->get()->toArray();



        return view("home" , [
            "username" => $user["username"],
            "notes" => $notes
        ]);

    }


    public function newNote(){

        $username = $this->getUserSession();

        return view("new_note",["username" => $username["username"]]);
    }

    public function newNoteSubmit(Request $request){

        $request->validate([
            "text_title" => "required",
            "text_note" => "required"
        ],
        [
            "text_title.required" => "O campo do titulo é obrigatorio",
            "text_note.required" => "O campo do texto é obrigatorio"
        ]);

        $titulo = $request->input("text_title");
        $texto = $request->input("text_note");

        $note = new Note();

        $userId = session("user.id");

        $note->title = $titulo;
        $note->text = $texto;
        $note->user_id = $userId;

        $note->save();

        return redirect()->route("home");

    }

    public function editNote($id){

        $id = Operations::decryptId($id);

        }

    public function deleteNote($id){

        $id =  Operations::decryptId($id);
    }


    private function getUserSession(){
        return session("user");
    }




}
