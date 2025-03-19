<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    

    <!--stack('styles') lo que hace es que reserva ese espacio para agregar hojas de estilo diferente que no se requieran en todas las vistas-->
    @stack('styles')

    @vite('resources/css/app.css')
    <title>Devstagram - @yield('titulo')</title>
    @vite('resources/js/app.js')

    {{-- <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" /> --}}

    <!--agregando los stilos de livewire-->
    @livewireStyles
</head>

<body class="bg-gray-100">


    <header class="p-5 border-b bg-white shadow">

        <div class="container mx-auto flex justify-between items-center ">

            <a href="{{ route('home') }}" class="text-3xl font-black " title="Home">
                DevStagram
            </a>


            <!--para que cambie el menu cuando el usuario este autenticado es con el helper auth y cuando no este aautenticado -->
            {{-- @if (auth()->check())
                <p>Usuario autenticado</p>
            @else
                <p>no autenticado</p>    
            @endif --}}
            <!--otra forma de autenticar a el usuario y que cambie el menu es esta es con auth y guest y agregale @ a el inicio de cada uan guest es para cuando no este autenticado -->
            @auth
                <nav class="flex gap-2 items-center">

                    <a 
                    href="{{ route('posts.create') }}" 
                    class="flex items-center gap-2 bg-white border p-2 text-gray-600 rounded text-sm uppercase font-bold cursor-pointer hover:bg-gray-600 hover:text-white"
                    title="Crear publicación"
                    >

                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.827 6.175A2.31 2.31 0 0 1 5.186 7.23c-.38.054-.757.112-1.134.175C2.999 7.58 2.25 8.507 2.25 9.574V18a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18V9.574c0-1.067-.75-1.994-1.802-2.169a47.865 47.865 0 0 0-1.134-.175 2.31 2.31 0 0 1-1.64-1.055l-.822-1.316a2.192 2.192 0 0 0-1.736-1.039 48.774 48.774 0 0 0-5.232 0 2.192 2.192 0 0 0-1.736 1.039l-.821 1.316Z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 12.75a4.5 4.5 0 1 1-9 0 4.5 4.5 0 0 1 9 0ZM18.75 10.5h.008v.008h-.008V10.5Z" />
                          </svg>
                          
                        Crear
                    </a>
                    <!--el route como es una funncion permite recibir el dato faltante ahi mismo-->
                    <!--y esto hace que el usuario se devuelva haca su perfil cuando pulse su nombre-->
                    <a href="{{ route('posts.index', auth()->user()->username ) }}" class="font-bold uppercase text-gray-600 text-sm">
                        Hola:
                        <span class="font-normal">
                            <!--aqui accede a el objecto auth y el user estando autenticado y toma el valor de username del objecto -->
                            {{ auth()->user()->username }}
                        </span>
                    </a>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="font-bold uppercase text-gray-600 text-sm">
                            Cerrar sesión
                        </button> <!--la llave que tiene route esta buscando el nombramiento d ela ruta register -->
                        <!--la funcion route de laravel y le pasas el nombre de alguna de tus rutas registradas en web.php -->
                    </form>

                </nav>
            @endauth

            @guest
                <nav class="flex gap-2 items-center">
                    <a href="{{ route('login') }}" class="font-bold uppercase text-gray-600 text-sm">Login</a>
                    <a href="{{ route('register') }}" class="font-bold uppercase text-gray-600 text-sm">Crear cuenta</a>
                    <!--la llave que tiene route esta buscando el nombramiento d ela ruta register -->
                    <!--la funcion route de laravel y le pasas el nombre de alguna de tus rutas registradas en web.php -->
                </nav>
            @endguest


        </div>


    </header>

    <main class="container mx-auto mt-10">


        <h2 class="font-black text-center text-3xl mb-10">
            @yield('titulo')
        </h2>

        @yield('contenido')

    </main>

    <footer class="mt-10 text-center p-5 text-gray-500 font-bold uppercase ">
        Devstagram - Todos los derechos reservados {{ now()->year }} {{-- aqui esta entrando al helper de now que es un objecto de fecha real donde esta accediendo a el año de el objecto --}}
    </footer>



    <!--agregando los script para el ajax de livewire-->
    @livewireScripts

</body>

</html>
