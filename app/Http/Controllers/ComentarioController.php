<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Admin;
use App\Models\Comentario;
use Illuminate\Http\Request;

class ComentarioController extends Controller
{
    public function store(Request $request, User $user, Admin $post) {
        //validar
        $this->validate($request, [
            'comentario' => 'required|max:255'
        ]);
        
        //almacenar
        Comentario::create([
            'user_id' => auth()->user()->id,
            'admin_id' => $post->id,
            'comentario' => $request->comentario
        ]);

        //imprimir mensaje
        return back()->with('mensaje', 'Comentario realizado correctamente');

    }
}
