<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    //
    public function index()
    {
        //la vista login es un lugar por defecto que la pagina te manda si no tienes un usuario autenticaado, te mandaa el middleware de postcontroller
        return view('auth.login');
    }

    // le pasamos el request y tambien la variable del request
    public function store(Request $request)
    {
        //validacion
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);


        //autenticacion
        //remember recuerda el usuario al momento del login y lo guarda para cuando haga el logout en tu navegador
        if(!Auth::attempt($request->only('email', 'password'), $request->remember)){

            //si las credenciales no son correctas entonces muestra este mensaje
            //esto va a llenar la session del mensaje de si las credenciales son incorrectas en el login
            //con este with se llena los valores ya indicado anteriormente que se tienen en la session ejemplo en este caso mensaje
            //entonces en tu template puedes comprobar esa session y mostrar mensajes como el de login si las credenciales no estan confirmadas 
            //son bastante utiles porque los puedes crear en un controlador y pasarlos a la vista
            return back()->with('mensaje', 'Credenciales incorrectas');

        }


        //si la utenticacion es correcta redirige a el muro 
        //Auth::user()->username esto le esta pasando el username del usuario como paramentro a la vaariable user en posts.index

        return redirect()->route('posts.index', Auth::user()->username );

    }
}
