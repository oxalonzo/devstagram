<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogoutController extends Controller
{
    //cierre de sesion 

    public function store()
    {
        //cierre de session
        Auth::logout();
        
        //redirige a el login
        return redirect()->route('login');
    }
}
