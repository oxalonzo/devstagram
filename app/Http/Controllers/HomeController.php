<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controller;

class HomeController extends Controller
{



    public function __construct()
    {
       $this->middleware('auth');
    }




    //este controlador es para ver todas las publicaciones de los usuarios que sigue el usuario identificado
    //si vas  a tener un controlador que solo va a tener un solo metodo puedes hacer un metodo de tipo invocable
    //eso significa que en lugar de tener index, vas a tener __invoke
    //al tener es invoke loq ue hace es que ese metodo se manda a llamar automaticamente es como un constructor 

    public function __invoke()
    {


        //obtener a quienes seguimos
        //obtenemos su id para entonces filtrar en el modelo de post
        //recuerda que toarray lo convierte en un array 
        //pluck() lo que hace es que como solo me interea el id con pluck traigo esos campos en especifico en este caso solo quiero el id
        $ids = Auth::user()->followings->pluck('id')->toArray();

        //importamos el modelo de post y un where para filtra un valor pero en este caso es un arreglo asi qeu utilizamos whereIn
        //entonces post tiene una columna que se llama user_id y lo ponemos juntos con la variable ids que ya trae los id de las personas que sigo y asi solo filtrara esos resultados
        //y se pone pagiante para que traiga los resultados paginados
        //en anteriores versiones para poder filtrar las ultimas publicaciones utilizabas en sequel pero ahora solo utilizas la funcion latest ante de la paginacion 
        //y eso te traera con el orden del ultimo registro creado o publicacion como primero que te aparecera en la pantalla hast ael primer registro o publicacion
        $posts = Post::whereIn('user_id', $ids)->latest()->paginate(20);

        

       return view('home', [
        'posts' => $posts,
       ]);
    }
}
