<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FollowerController extends Controller
{
    //para los seguidores a mediados que se vayan a agregando o dejando de seguir

    //el store va a almacenar los usuarios a mediados que den click en el boton de seguir
    //user es la persona que estamos siguiendo y el requeest la informacion que estamos enviando
    //es impportante saber que en este controller el user es el perfil que estamos visitando mentras que request si tiene a la persona que esta visitanod a el usuario
    public function store(User $user)
    {
        //estoy utilizando el metodo de follower que esta creado en el modelo de user
        //atatach es un metodo que se recomienda en vez de create cuando esta haciendo una tabla pivote o sea cuando es una relacion de muchos a muchos 
        //taambien cuando relacionas con la misma tabla es bueno utilizar attach 
        //si pones el metodo sin los parentesis te permite acceder a la informacion pero cuando lo pones con los parentesis te permite es acceder al metodo, la definicion del metodo y queremos agregar o acceder a attach
        //entonces esto va a leer la persona que estamos visitando su muro y le va a agregar que la persona que visita lo esta siguiendo y tiene que ser la persona que esta autenticada
        $user->followers()->attach(Auth::user()->id);

        return back();
        
    }

    public function destroy(User $user)
    {
        //con el metodo detach elimina a la persona y asi la deja de seguir
        $user->followers()->detach(Auth::user()->id);

        return back();
        
    }

}
