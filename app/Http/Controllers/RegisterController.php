<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    //metodo
    public function index() 
    {
        return view('auth.register');
    }



    //aqui esta recibiendo el valor del request despues del post de manera de parametros y fue llamado de la misma forma request
    public function store(Request $request)
    {
        //enviar formulario
        //existen convenciones en laravel para nombrar los metodos como index, store se les conoce como resource controller 
        
        //modificar el request
        //asi agrega a el username la funcion de slug y se modifica antes de las condicionens y se reescribe
        $request->request->add([ Str::slug($request->username)]);

        //validacion
        //se utiliza la interacion de $this y el metodo de validate, se le pasa el valor del request ya genrado por el post y sus reglas 
        //la regla unique indica que tiene que ser unico el nombre de usuario y que no se puede repetir en la tabla users 

        // Definir las reglas de validación
        $request->validate([
            'name' => 'required|max:30',
            'username' => 'required|unique:users|min:3|max:20',
            'email' => 'required|email|unique:users|max:60',
            'password' => 'required|confirmed|min:6',
        ]);

        //User es el modelo que ya lo importe arriba y el metodo estactico create es el que crea un nuevo registro en la tabla users
        //los datos se estan pasando en forma de arreglo
        //la funcion slug elimina los espacios poniendolo como si fuera url los registro

        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

       //autenticar unn usuario
       //esto intentara autenticar a el usuario por las funnciones
        
    //    Auth::attempt([
    //     'email' => $request->email,
    //     'password' => $request->password,
    //    ]);

       //otra forma de autenticar mediante la clase Auth
       Auth::attempt($request->only('email','password'));


        //redirect con un helper de laravel y route ayuda a redirecionar a la url con el name posts.index
        // el route esta pasando el valor autenticado ddel usuario a posts.index para que no le falte al momento de haccer el login para despues ejecutar el route model bilding el uso de modleos en la ruta 
        return redirect()->route('posts.index', Auth::user()->username);
        // return redirect()->route('posts.index');
       
        

    }
}


//para hashear las password en express y node.js tienes que importar un paquete para hashear en laravel ya viene incluido
//redireccionar

// return response()->json([
//     'message' => 'Producto creado con éxito',
//     'user' => $user,
// ], 201);