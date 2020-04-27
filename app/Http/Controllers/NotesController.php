<?php

namespace App\Http\Controllers;

use App\Http\Requests\NotesRequest;
use App\Notes;
use http\Env\Response;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class NotesController extends Controller
{
    public function index()
    {
        $notes= Notes::orderBy('created_at', 'desc')->get();
        if (sizeof($notes)==0){
            return response()->json(['error'=>'erreur']);
        }
        try{
            return response()->json(['notes'=>$notes,'error'=>null]);
        }catch (ModelNotFoundException $e){
            return response()->json(['error'=>'erreur'], 404);
        }
    }

    public function show($id){
        try{
            $note= Note::findOrFail($id);
            return response()->json(['note'=>$note,'error'=>null]);
        }catch (ModelNotFoundException $e){
            return response()->json(['error'=>'erreur'], 404);
        }
    }

    public function store(NotesRequest $request){
        try{
            return response()->json(['note'=>Notes::create($request->all()),'error'=>null]);
        }catch (ModelNotFoundException $e){
            return response()->json(['error'=>'erreur'], 404);
        }
    }

    public function destroy($id){
        try{
            $note= Note::findOrFail($id)->delete();
            return response()->json(['error'=>null]);
        }catch (ModelNotFoundException $e){
            return response()->json(['error'=>'Cet identifiant est inconnu'], 404);
        }
    }

    public function update(NotesRequest $request, $id){
        try{
            Notes::findOrFail($id)->update($request->all());
            return response()->json(['note'=>Notes::findOrFail($id),'error'=>null]);
        }catch (ModelNotFoundException $e){
            return response()->json(['error'=>'erreur'], 404);
        }
    }
}
