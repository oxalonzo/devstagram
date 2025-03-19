@extends('layouts.app')

@section('titulo')
Página Principal
@endsection

@section('contenido')



    <!--forma de utilizar el template del componente ListarPost, la forma es como si fuera una etiqueta html <x-> esa etiqueta es siempre-->
    <!--siempre que veas en laravel una x- eso es un componente despues colocas el nombre del template(componente) -->

    <!--algunas veces vas a querer crear un componente o reutilizar un componente donde le puedas enviar diferentes informacion-->
    <!--ahi es donde los slot son muy utiles si eliminas el slash de cierre tienes que cerrar la etiqueta para que soporte los componentes-->
    <!--si lo pones entonces con el cierre de etiqueta completo entonces lo que coloques entre cada una de las etiquetas se pasa directamente al componente indicado en la etiqueta-->
    <!--y lo puedes mostrar alla en el template-->
    <!--para darle un nombre ene specifico a un slot utiliza la sintaxis mostrada abajo-->
    <!--aqui dentro de la etiqueta que llama al componente utiilizamos la sintasis :posts='$posts' para pasarle la vatiable posts con informacion que se esta pasando en homecontroller y depues ahi con eso se pasa al contructor del componente para utilizarlo en el componente -->
    <x-listar-post :posts="$posts" />


    
    {{-- <x-listar-post >
        <x-slot:titulo>
            <header>esto es un header</header>
        </x-slot:titulo>

        <h1>mostrando post desde slot</h1>
        
    </x-listar-post> --}}



    {{-- <x-listar-post >
        <h1>mostrando post desde slot2</h1>
    </x-listar-post>



    <x-listar-post >
        <h1>mostrando post desde slot3</h1>
    </x-listar-post> --}}



@endsection