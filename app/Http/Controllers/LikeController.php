<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function store(Request $request, Post $post)
    {
         //dando like para que lo marque 
         //pasamos el post ya que pasa gracias a la relacion y asi no hay que ponerlo en el modelo de like 
         //pasamos el post despues el metodo de like y ponemos create para crear el registro

         $post->likes()->create([
            //accede a el id del usuario y lo guarda en la columna user_id
            'user_id' => $request->user()->id
         ]);

         return back();



     
    }



    public function destroy(Request $request, Post $post)
    {
         //elimando like para que lo marque 

         //aqui lo que hacemos es que accedemos al request que va a tener el usuario atual y despues el metodo likes del modelo de User
         //y le ponemos where y donde le pasamos el post_id que eso va a almacenar el id del post donde estamos dando like y eso va a tener la referencia del usuario en automatico
         //gracias a esa relacion y despues se le pasa la variable post->id y despues la funcion de delete()
         //el post_id se refiere a la columna de likes   
         // entonces de aqui viene el usuario y en el usuario esta la relacion de likes de donde vienen y despues simplemente filtrar el post actual donde estamos eliminando el like estamos en el destroy y lo eliminamos
         $request->user()->likes()->where('post_id', $post->id)->delete();

         return back();



     
    }



}
