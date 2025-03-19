@extends('layouts.app')



@section('titulo')
    Inicia sesión en DevStagram
@endsection




@section('contenido')
    <div class="md:flex md:justify-center md:gap-10 md:items-center ">

        <div class="md:w-6/12 p-5">
            <img src="{{ asset('img/login.jpg') }}" alt="Imagen login de usuario">
        </div>

        <div class="md:w-4/12 bg-white p-6 rounded-lg shadow-xl">

            <!-- con el csrf se evita la expiracion de la pagina y los ataques  -->
            <!-- la funcion route identifica las rutas con el nombre register y las trae-->
            <!-- novalidate quita la validacion de html y soo deja la validacion del servido la que esta en RegisterController-->
            <form action="{{ route('login') }}" method="POST" novalidate>

                @csrf

                @if (session('mensaje'))
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center ">
                        {{ session('mensaje') }} <!--la variable que muestra el mensaje de error de cuando las credenciales no son correctas-->
                    </p>
                @endif


                <div class="mb-5">
                    <label for="email" class="mb-2 block uppercase text-gray-500 font-bold">
                        Email
                    </label>
                    <input type="email" name="email" id="email" placeholder="Tu email de registro"
                        class="border p-3 w-full rounded-lg @error('email') border-red-500 @enderror"
                        value="{{ old('email') }}">

                    @error('email')
                        <!--esto es una directiva que imprime el mensaje de error cuando no se cumple las reglas ya puesta en el controlador-->
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center ">
                            {{ $message }} <!--la variable que guarda el mensaje de error se llama message-->
                        </p>
                    @enderror

                </div>


                <div class="mb-5">
                    <label for="password" class="mb-2 block uppercase text-gray-500 font-bold">
                        Password
                    </label>
                    <input type="password" name="password" id="password" placeholder="Password de registro"
                        class="border p-3 w-full rounded-lg @error('password') border-red-500 @enderror">

                    @error('password')
                        <!--esto es una directiva que imprime el mensaje de error cuando no se cumple las reglas ya puesta en el controlador-->
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center ">
                            {{ $message }} <!--la variable que guarda el mensaje de error se llama message-->
                        </p>
                    @enderror

                </div>


                <div class="mb-5">
                    <input type="checkbox" name="remember"><label class="text-gray-500 text-sm"> Mantener mi sesión abierta</label>
                </div>



                <input type="submit" value="Iniciar Sesión"
                    class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg">

            </form>
        </div>

    </div>
@endsection
