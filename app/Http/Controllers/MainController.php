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
       $notes = User::find($userSession["id"])
                                                ->notes()
                                                ->orderBy("date_delivery", "asc")
                                                ->where("deleted_at", null)
                                                ->get()
                                                ->toArray();

        return view("home" , [
            "notes" => $notes
        ]);

    }

    public function newNote(){

        return view("new_note");
    }

    public function newNoteSubmit(Request $request){

        $request->validate([
            "text_title" => "required|min:3|max:200",
            "text_note" => "required|min:3|max:3000",
            "date_delivery" => "required|date|after_or_equal:today"
        ],
        [
            "text_title.required" => "O campo do titulo é obrigatório",
            "text_title.min" => "O titulo deve ter no minino :min caracteres",
            "text_title.max" => "O titulo deve ter no maximo :max caracteres",

            "text_note.required" => "O campo do texto é obrigatório",
            "text_note.min" => "O texto deve ter no minimo :min caracteres",
            "text_note.max" => "O texto deve ter no maximo :max caracteres",

            "date_delivery.required" => "O campo data de entrega é obrigatório",
            "date_delivery.date" => "Deve passar uma data valida",
            "date_delivery.after_or_equal" => "Deve ser passado uma data no futuro"
        ]);

        $userId = session("user.id");

        $note = new Note();
        $note->title = $request->text_title;
        $note->text = $request->text_note;
        $note->date_delivery = $request->date_delivery;
        $note->user_id = $userId;

        $note->save();

        return redirect()->route("home");
    }

    public function editNote($id){

        $id = Operations::decryptId($id);
        $note = Note::find($id);

        return view("edit_note", [
            "note" => $note
        ]);

        }


    public function editNoteSubmit(Request $request){

        $request->validate([
            "text_title" => "required|min:3|max:200",
            "text_note" => "required|min:3|max:3000",
            "date_delivery" => "required|date|after_or_equal:today"
        ],
        [
            "text_title.required" => "O campo do titulo é obrigatório",
            "text_title.min" => "O titulo deve ter no minino :min caracteres",
            "text_title.max" => "O titulo deve ter no maximo :max caracteres",

            "text_note.required" => "O campo do texto é obrigatório",
            "text_note.min" => "O texto deve ter no minimo :min caracteres",
            "text_note.max" => "O texto deve ter no maximo :max caracteres",

            "date_delivery.required" => "O campo data de entrega é obrigatório",
            "date_delivery.date" => "Deve passar uma data valida",
            "date_delivery.after_or_equal" => "Deve ser passado uma data no futuro"
        ]);


        if($request->note_id == null){
            return redirect()->route("home");
        }

        $noteId = Operations::decryptId($request->note_id);

        $note = Note::find($noteId);

        $note->title = $request->text_title;
        $note->text = $request->text_note;
        $note->date_delivery = $request->date_delivery;

        $note->save();

        return redirect()->route("home");
    }

    public function deleteNote($id){

        $id =  Operations::decryptId($id);

        $note = Note::find($id);

        return view("delete_note", ["note" => $note]);
    }

    public function deleteConfirmNote($id){

        $id = Operations::decryptId($id);

        $note = Note::find($id);

        $note->delete();

        return redirect()->route("home");


    }

    private function getUserSession(){
        return session("user");
    }
}
