
@extends('layouts.app')



@section('titulo')
    registrate en DevStagram
@endsection 




@section('contenido')
    

      <div class="md:flex md:justify-center md:gap-10 md:items-center ">
        
                <div class="md:w-6/12 p-5">
                    <img src="{{ asset('img/registrar.jpg') }}" alt="IMagen registro de usuario">
                </div>

                <div class="md:w-4/12 bg-white p-6 rounded-lg shadow-xl">

                    <!-- con el csrf se evita la expiracion de la pagina y los ataques  -->
                    <!-- la funcion route identifica las rutas con el nombre register y las trae-->
                    <!-- novalidate quita la validacion de html y soo deja la validacion del servido la que esta en RegisterController-->
                    <form action="{{ route('register') }}" method="POST" novalidate>
                       
                        @csrf

                            <div class="mb-5">
                                <label for="name" class="mb-2 block uppercase text-gray-500 font-bold">
                                    Nombre
                                </label>
                                
                                <input 
                                type="text"
                                name="name"
                                id="name"
                                placeholder="Tu nombre"
                                class="border p-3 w-full rounded-lg @error('name') border-red-500 @enderror"
                                value="{{ old('name') }}"
                                >
                                 <!--la directiva error aqui en las clases lo que hace es que en caso de que en name tenga un error se pintara de rojo-->
                                @error('name') <!--esto es una directiva que imprime el mensaje de error cuando no se cumple las reglas ya puesta en el controlador-->
                                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center "> 
                                        {{ $message }} <!--la variable que guarda el mensaje de error se llama message-->
                                    </p>
                                @enderror

                            </div>

                            <div class="mb-5">
                                <label for="username" class="mb-2 block uppercase text-gray-500 font-bold">
                                    Username
                                </label>
                                <input 
                                type="text"
                                name="username"
                                id="username"
                                placeholder="Tu nombre de usuarios"
                                class="border p-3 w-full rounded-lg @error('username') border-red-500 @enderror"
                                value="{{ old('username') }}"
                                >

                                @error('username') <!--esto es una directiva que imprime el mensaje de error cuando no se cumple las reglas ya puesta en el controlador-->
                                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center "> 
                                        {{ $message }} <!--la variable que guarda el mensaje de error se llama message-->
                                    </p>
                                @enderror

                            </div>

                            <div class="mb-5">
                                <label for="email" class="mb-2 block uppercase text-gray-500 font-bold">
                                    Email
                                </label>
                                <input 
                                type="email"
                                name="email"
                                id="email"
                                placeholder="Tu email de registro"
                                class="border p-3 w-full rounded-lg @error('email') border-red-500 @enderror"
                                value="{{ old('email') }}"
                                >

                                @error('email') <!--esto es una directiva que imprime el mensaje de error cuando no se cumple las reglas ya puesta en el controlador-->
                                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center "> 
                                        {{ $message }} <!--la variable que guarda el mensaje de error se llama message-->
                                    </p>
                                @enderror

                            </div>


                            <div class="mb-5">
                                <label for="password" class="mb-2 block uppercase text-gray-500 font-bold">
                                    Password
                                </label>
                                <input 
                                type="password"
                                name="password"
                                id="password"
                                placeholder="Password de registro"
                                class="border p-3 w-full rounded-lg @error('password') border-red-500 @enderror"
                                >

                                @error('password') <!--esto es una directiva que imprime el mensaje de error cuando no se cumple las reglas ya puesta en el controlador-->
                                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center "> 
                                        {{ $message }} <!--la variable que guarda el mensaje de error se llama message-->
                                    </p>
                                @enderror

                            </div>

                            <div class="mb-5">
                                <label for="password_confirmation" class="mb-2 block uppercase text-gray-500 font-bold">
                                    Repetir Password
                                </label>
                                <input 
                                type="password"
                                name="password_confirmation"
                                id="password_confirmation"
                                placeholder="Repite tu Password"
                                class="border p-3 w-full rounded-lg"
                                >
                            </div>


                            <input 
                            type="submit"
                            value="Crear cuenta"
                            class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg"
                            >

                    </form>
                </div>

      </div>


@endsection 







