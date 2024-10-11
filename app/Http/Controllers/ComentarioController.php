<?php

namespace App\Http\Controllers;

use App\Models\Comentario;
use DragonCode\Contracts\Cashier\Auth\Auth;
use Illuminate\Http\Request;

class ComentarioController extends Controller
{
  /*   GUARDA COMENTARIO */
    public function store(Request $request, String $id){
        
        $request->validate([
            'body' => 'required'
        ]);

        $comentario = new Comentario();

        $comentario->body = $request->body;
        $comentario->user_id = auth()->user()->id;
        $comentario->ticket_id = $id;

        $comentario->save();

        return back();
    
    }

}
