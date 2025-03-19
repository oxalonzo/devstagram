<?php

namespace App\Http\Controllers;

use App\Models\User;
//esto es la clase que tuve que importar para poder usar el middleware la que esta abajo de aqui
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Laravel\Facades\Image;

class PerfilController extends Controller
{



    public function __construct()
    {
        //recuerda esto es para proteger la url del usuario y que alguien sin autorizar no pueda acceder
        $this->middleware('auth');
    }

    

    //para hacer la edicion de los datos del perfil del usuario

    public function index()
    {
        //aqui devuelve la vista que esta guardada en la carpeta perfil y la vista llamada index
       return view('perfil.index');
    }




    public function store(Request $request)
    {


        //modificar el request
        //asi agrega a el username la funcion de slug y se modifica antes de las condicionens y se reescribe
        $request->request->add([ Str::slug($request->username)]);

        // Definir las reglas de validación
        //la validacion se ve diferente porque recuerda que cuando colocas mas de tres reglas es mejor colocarlo en un arreglo
         //el not_in indica una lista negra de nombres que no se puede poner el usuario para evitar confusion entre las url y el nombre del usuario not_in:twitter,editar-perfil
         //asi como exite not_in tambien exite in que obliga a el usuario a tomar el nombre de una lista de nombreS obligatoriamente sirve mucho para un crm donde obligas a las personas a seleccionar si es cliente proveedor empresa in:CLIENTE,VENDEDOR
        $request->validate([
            'username' => ['required','unique:users,username,'.Auth::user()->id,'min:3','max:20', 'not_in:twitter,editar-perfil'],
        ]);


        if ($request->imagen) {
           
        $imagen = $request->file('imagen');

        
        $nombreImagen = Str::uuid() . "." . $imagen->extension();

      
        $imagenServidor = Image::read($imagen);

        
        $imagenServidor->resize(1000, 1000);

        $imagenPath = public_path('perfiles') . '/' . $nombreImagen; 
        
        $imagenServidor->save($imagenPath);

        } 


        //guardar los cambios
        //esto buscara el usuario por su id el actual que esta modificando su informacion
        $usuario = User::find(Auth::user()->id);

        //aqui dice que el username buscado tiene que ser igual a el username del request generado
        $usuario->username = $request->username;
        //aqui indica que la imagen del usuario tiene que ser la imagen subida o la imagen que ya tenia o se puede dejar vacia 
        $usuario->imagen = $nombreImagen ?? Auth::user()->imagen ?? '';

        $usuario->save();


        //redireccionar
        //aqui lo mandamos a su muro y como puede ser que el usuario modificara su username por eso se le pasa para el nombre del usuario el username
        return redirect()->route('posts.index', $usuario->username);

    }



     //ojo algo muy importante si haces cambios en la ruta y ves que te dice que la ruta no exite utiliza en los comando: sail artisan route:cache
    //y si ves que aun asi no hay cambio utiliza: sail artisan route:list esto lo que hace es que te permite ver las rutas que soporta la 
    //aplicacion y donde hay variables y del lado derecho te dice el controlador y el metodo que utiliza esa ruta 


}
