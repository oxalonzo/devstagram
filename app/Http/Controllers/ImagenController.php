<?php

namespace App\Http\Controllers;



use Illuminate\Support\Str;
use Illuminate\Http\Request;

use Intervention\Image\Laravel\Facades\Image;

class ImagenController extends Controller
{
    //para almacenar las imagenes

    public function store(Request $request)
    {
        //la variable input recibe todo el valor del request
        // $input = $request->all();

        //toma el archivo ya subido en el dropzoone con el request y usando la funcion file agarrando el archivo que se llama file 
        $imagen = $request->file('file');

        //utilizando intervion imagen para intervenir las imagenes y ponerla de un tamaño especifico
        //esta linea de codigo genera un id unico para cada una de las imagenes porque no se puede tener dos archivos que se llamen igual
        $nombreImagen = Str::uuid() . "." . $imagen->extension();

        //imagen que se guarda en el servidor
        //esta clase: Image::make es la clase que nos permite crear la intervencion 
        $imagenServidor = Image::read($imagen);

        //cambiando el tamaño con intervencio
        $imagenServidor->resize(1000, 1000);

        $imagenPath = public_path('uploads') . '/' . $nombreImagen; 
        
        //aqui esta agarranod la imagen que esta guardada en el servidor momentaniamente y la guarda en la ruta de imagenPath
        $imagenServidor->save($imagenPath);



        //jsoon es una tenologia de comunicacion del backend con el fronend
        //response devuelve una respuesta que se convierte a json de un arreglo que era anteriormente 
        //esta recibiendo la imaagen en un arreglo con la funcion extension
        return response()->json(['imagen' => $nombreImagen]);



        
    }



    // public function store(Request $request)
    // {
     
    //     $imagen = $request->file('file');


    //     return response()->json(['imagen' => $imagen->extension() ]);

    // }


   


}
