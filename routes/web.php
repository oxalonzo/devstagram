<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ImagenController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ComentarioController;
use App\Http\Controllers\FollowerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PerfilController;

Route::get('/', HomeController::class)->name('home');

//controlador y el metodo index
Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'store']);
//pagina principal del login y post para el login

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'store']);

//cierre de session de el usuario 

Route::post('/logout', [LogoutController::class, 'store'])->name('logout');


//Rutas para le perfil, para que permita a el usuario modificar el perfil
//movi las rutas de edicion de perfil par arriba para que deje de decirme que no encuentra la pagina por la variable de username y asi que funcione correctamente esto estaba pasando por el cambio en la ruta
Route::get('/editar-perfil', [PerfilController::class, 'index'])->name('perfil.index');

//para terminar de hacer la modificacion de los datos del perfil
Route::post('/editar-perfil', [PerfilController::class, 'store'])->name('perfil.store');


//para crear las fotos que suba el usuario esta es la ruta, ojo estudia las convensione de las rutas a momento de crear, enviar, etc
Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');

//esta es la ruta para crear los registro de los post
Route::post('/posts', [PostController::class, 'store'])->name('posts.store');

//esta es la ruta para las fotos de los post al momento de ver una foto mas grande con todo y comentario
//se pone {post} como variable para poder colocar el id de cada una de las fotos
Route::get('/{user:username}/posts/{post}', [PostController::class, 'show'])->name('posts.show');

//esta ruta es la eliminacion de los post de los usuarios cuando quieran eliminar un post
Route::delete('/posts/{post}',[PostController::class, 'destroy'])->name('posts.destroy');

//ruta para los comentarios en las fotos y guardarlos
Route::post('/{user:username}/posts/{post}', [ComentarioController::class, 'store'])->name('comentarios.store');



//comunicacion con el controlador paraa las imagenes de el crear imagen del usuario
Route::post('/imagenes', [ImagenController::class, 'store'])->name('imagenes.store');


//dar likes a las fotos
Route::post('/posts/{post}/likes', [LikeController::class, 'store'])->name('posts.likes.store');

//elimnar likes a las fotos
Route::delete('/posts/{post}/likes', [LikeController::class, 'destroy'])->name('posts.likes.destroy');

//post para el usuario dirigirse a el muro que tendra su url unica para el usuario
//tiene url unicas donde dira el nombre del usurio que esta logiado y las llaves es para convertirlo en una variable para pasarla a el controlador en el index
//User es un modelo que tenemos en el proyecto
//al tener un modelo dentro de las llaves se aplica lo que se conoce como route model binding
//esta cosultando el modelo, identifica los campos como username y resolver las URL de esta forma
Route::get('/{user:username}', [PostController::class, 'index'])->name('posts.index');

//ruta para seguir a las personas
Route::post('/{user:username}/follow', [FollowerController::class, 'store'])->name('users.follow');

//unfollow cuando no los quieres seguir ya
Route::delete('/{user:username}/unfollow', [FollowerController::class, 'destroy'])->name('users.unfollow');




//cuando nombras una ruta es para cambiar el nombre con el que aparece en la url ejemplo la que esta arriba ->name('register) aqui la de abajo no tiene porque por defecto toma el nombre de la anterior que esta arriba pero siempre y cuando tenga la misma url
//el beneficio de nombrar la ruta es que despues puedes cambiar las url pero siempre en las view cuando trates de ubicarla mediante la funcion route la va a encontrar por su nombre en este caso register
//los tipos de request se utilizan en http y sobre todo en apis 
//get es cuando visitas un sitio
//post es cuando envias un formulario o informacion 
//put es cuando se utiliza para actualizar un elemento pero si ese elemento no exite, put crea uno nuevo
//delete es cuando se utiliza para eliminar un recurso
//patch es cuando se actualiza pero solo de forma parcial, es decir que lo que envies especificamente es lo que va a cambiar