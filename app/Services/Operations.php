<?php

namespace App\Services;

use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;

class Operations{

    public static function decryptId($id){
        try{
                $id = Crypt::decrypt($id);

                } catch(DecryptException $e){
                    return redirect()->route('home');
                }

            return $id;
    }


    public static function existDataBd (Model $model, $column, $data){

        $data = $model::where($column, $data)->first();

        if(is_null($data)){
            return false;
        }

        return true;


    }


}
