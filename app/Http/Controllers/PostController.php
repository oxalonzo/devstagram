<?php

namespace App\Http\Controllers;



use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\File;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Models\User;
use App\Models\Post;


class PostController extends Controller
{
    // public function __construct() es lo que se ejecuta cuando es ejecutado el controlador

    public function __construct()
    {
        //con esto se protege a la pagina muro cuando no tiene un usuario logueado
        //middleware antes de ejecutar a index verificcara que el usuario este logueado y si no mandara por defecto a el login
        // Route::middleware('auth');
        //la funcion except permite que el middleware proteja las rutas pero que le de permiso a los usuarios no identificados a otras areas cuando no este autenticados 
        //de esta forma permites el acceso algunos partes y restringir a otros
        $this->middleware('auth')->except(['show', 'index']);
    }

    //esto es para la politica o policies que permite a el usuario borrar una publicacion 
    // es necesario que para que el authorize funcione necesitas este dos codigos en tu controlador
    //esto son  use AuthorizesRequests; y use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
    use AuthorizesRequests;

    //el index espera la variable user porque se la estoy pasando desde la route con la variable entre llaves llamada user con la sintaxis y se trae aa el modelo User
    public function index(User $user)
    {


        //$en la variaable post se esta guardando la instancia con el modelo Post donde se le pone un where para indicar el que uno quiere traer 
        //cuando mandes a llamar un modelo recuerda que ya se situa en esa tabla
        //dentro del where estoy especificando que traiga donde la columna user_id de post es igual al user_id identificado del usuario
        //todo esto se hace con route model binding
        //la parte final donde se pone get es para terminar de generar la consulta

        // $posts = Post::where('user_id', $user->id)->get();

        //ahora en vez de get() tiene paginate() para poder hacer la paginacion cuando pase de cierta cantidad en este caso a partir de 20 post
        $posts = Post::where('user_id', $user->id)->latest()->paginate(20);

        //existe otro tipo de pagination mas simple por si quieres variar
        // $posts = Post::where('user_id', $user->id)->simplePaginate(4);

        //aqui estoy accediendo a el usuario desde la ruta solo poniendo el localhost/id en vez de localhost/muro
        // dd($user->username);
        //auth es la clade de laravel que ayuda a verificar si el usuario esta autenticado al momento de ir a la posts.index
        //y se llena el objecto de user
        // dd(Auth::user());

        //se le esta pasando a la vista la variable user mediante un arreglo para que el usuario aparezca tanto el usuaario de la url como el usuario imprimido
        //tambien se le esta pasando la variable posts para poder obtener informacion del usuario sobre cuanto post tiene de acuerdo a su user_id
      
        
        return view('dashboard', [
            'user' => $user,
            'posts' => $posts
        ]);

        //esta es otra forma de hacer llamada de los datos utilizando la relacion entre usuario y post
        //solo que recuerda que las colecciones de este tipo no se puede paginar mientras que las del tipo de arriba si se puede paginar
        //este es un ejemplo de como se utilizaria ne la vista @if($user->posts->count()) en vez de utilizarlo asi @if($posts->count())
        // return view('dashboard', [
        //     'user' => $user
        // ]);

    }



    //create es el que nos permite tener el formulario de tipo get para poder vvisualizar la pagina
    public function create()
    {
        return view('posts.create');
    }


    //es el que almacena en la base de datos
    //ete va a validar y va a guardar en la base de datos
    //siempre en el store va a tener el request porque es lo que se va a aguardar en al base de datos
    public function store(Request $request)
    {
        //validacion del formulario de la imagen
        $request->validate([
            'titulo' => 'required|max:255',
            'descripcion' => 'required',
            'imagen' => 'required',
        ]);

        //se crea el post de la informacion y la imagen 
        //recuerda siempre que esta es una forma de crear registro con Post::create
        // Post::create([
        //     'titulo' => $request->titulo,
        //     'descripcion' => $request->descripcion,
        //     'imagen' => $request->imagen,
        //     'user_id' => Auth::user()->id, //el usuario que esta creando esta entrada es la que esta autenticado podemos usar el helper de auth user y tomar su ID 
        // ]);

        //segunda forma de crear un nuevo registro 
        //seria creando una nueva instancia de ese modelo
        
        // $post = new Post;
        // $post->titulo = $request->titulo;
        // $post->descripcion = $request->descripcion;
        // $post->imagen = $request->imagen;
        // $post->user_id = Auth::user()->id;
        // $post->save();


        //tercera forma de crear un registro y utilizar las relaciones 
        //est elo que hace es queutiliza el usuario registrado, despues hacede a la relacion que hay entre los modelos que seria posts y despues termian creando el registro con esa relacion que en este caso vemos que sera Post
        $request->user()->posts()->create([
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'imagen' => $request->imagen,
            'user_id' =>  Auth::user()->id,
        ]);

        //despues redirige a la pagina principal del usuario donde se pasa la ruta pero tambien se le pasa el username de usuario autenticado 
        return redirect()->route('posts.index', Auth::user()->username);

    }


    //al este ser un resources controller puedes tambien pasarle la variable de post y le puedes pasar post
    //tambien gracias a route model bailding
    public function show(User $user, Post $post)
    {
        return view('posts.show', [
            'post' => $post,
            'user' => $user
        ]);
        
    }


    //¿Qué son las policies de Laravel? Las Políticas de Laravel son una función que permite a los desarrolladores definir reglas de autorización para los recursos de sus aplicaciones, incluyendo modelos, vistas y acciones.
    // asi cree el policie en la terminal y lo asocie con el modleo post:  sail artisan make:policy PostPolicy --model=Post
    //recuerda ya este toma la variable de post y esto ayuda a identificar facilemnte en que post se esta dando click para eliminarlo
    public function destroy(Post $post)
    {
        // if ($post->user_id === Auth::user()->id) {
        //     dd('si es la misma perosna');
        // }else{
        //     dd('no es la misma persona');
        // };

        //aqui se esta utilizando el policie, pasandole el metodo que se va a utilizar que es delete y la variable $post para identificar el post->id
        //el post vino de la url route model biding se para a la autorizacion y lo pasa al policie que es lo que se ve en el metodo delete, va a comprobar al usuario que sea el mismo y nos va a retornar true or false
        //se encarga de verificar si el usuario tiene permiso para realizar una acción determinada
        $this->authorize('delete', $post);

        //ya aqui si pasa la autorizacion se elimina ese post con la funcion delete()
        $post->delete();

        //para eliminar las imagenes cuando se  eliminen los post hay varias formas una es con un script que revise cada semana las imagenes que no se estan utilizando
        //pero tambien vamos a ver otra forma que si el usuario elimina su post veamos como se elimina la imagen a la vez
        //eliminar la imagen de la carpeta 
        $imagen_path = public_path( 'uploads/' . $post->imagen);

        //File es un facades(fasa) de laravel esta identificando que exista y si existe lo eliminara
        if (File::exists($imagen_path)) {
            //lo eliminara con una funcion de php esta funcion no es de laravel
            unlink($imagen_path);

            //existe tambien Fille::delete(); le pasas la imagen dentro de delete y esto lo eliminara tambien
            //File::delete($imagen_path);
        } 

        //redirecionamos con return a la pagina princiapl y le pasamos el username por la url para que sea directamente a la de el usuario que esta borrando la publicacion
        return redirect()->route('posts.index', Auth::user()->username);


        

    }



}
