<?php

namespace App\Http\Controllers;

use App\Models\Comentario;
use App\Models\User;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ComentarioController extends Controller
{
    public function store(Request $request, User $user, Post $post )
    {
        //metodo para crear los registros de los comentarios en las fotos
        //no estamos utilizando user porque no nos funciona para capturar el dato para pasarlo a la variable pero si utilizaremos post que ya se esta pasando a la vista 

       
        //validar
        $request->validate([
            'comentario' => 'required|max:255',
        ]);


        //almacenar el resultado
        Comentario::create([
            'user_id' => auth::user()->id,
            'post_id' => $post->id,
            'comentario' => $request->comentario
        ]);

        // //imprimir un mensaje
        //aqui regresa  ala pagina anterior de donde vino y con datos por eso el back y el with
        //recuerda que para imrpimir la variable mensaje que est acon el with necesitas poner en la vista la directiva session
        return back()->with('mensaje', 'comentario creado con exito');
    }


}
