@extends('layouts.app')

@section('titulo')
    Perfil: {{ $user->username}}
@endsection


@section('contenido')

      <div class="flex justify-center">
            <div class="w-full md:w-8/12 lg:w-6/12 flex flex-col items-center md:flex-row">

               
                <div class="w-8/12 lg:w-6/12 px-5" >
                    <img class="border rounded-full" src="{{ $user->imagen ? asset('perfiles') . '/' . $user->imagen : asset('img/usuario.svg') }}" alt="imagen de usuario">
                </div>

               

                <div class="md:w-8/12 lg:w-6/12 px-5 flex flex-col items-center md:justify-center md:items-start py-10 md:py-10">

                   <div class="flex items-center gap-2">

                     {{-- <p class="text-gray-700 text-2xl">{{ auth()->user()->username }}</p> --}}
                     <p class="text-gray-700 text-2xl">{{ $user->username }}</p>

                     @auth
 
                     <!--aqui decimos que si el user->id es igual a la misma persona autenticada que permita hacer lo sigueinte-->
 
                     @if($user->id === auth()->user()->id)
                         
                      <a 
                      href="{{ route('perfil.index') }}" 
                      class="text-gray-500 hover:text-gray-600 cursor-pointer "
                      >
                         <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                             <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                         </svg>
                           
                      </a>
                         
                     @endif
 
 
                     @endauth


                   </div>

                   <!--con la directiva choice les paso una serie de enum o diccionarios donde indicas que terminos puede utilizar donde le indicamos en base a la cantida que haya pues eliges seguidor o seguidores-->
                   <!--ya simplemente el choice identica la cantida de usuario y si es uno seguior o si es mas seguidores-->
                   <p class="text-gray-800 text-sm mb-3 font-bold mt-5">
                        {{ $user->followers->count() }}
                        <span class="font-normal"> @choice('Seguidor|Seguidores', $user->followers->count())</span>
                    </p>

                    <p class="text-gray-800 text-sm mb-3 font-bold">
                        {{ $user->followings->count() }}
                        <span class="font-normal">Siguiendo</span>
                    </p>

                    <p class="text-gray-800 text-sm mb-3 font-bold">
                        {{ $user->posts->count() }}
                        <span class="font-normal"> Posts</span>
                    </p>

            @auth
                    <!--esto verifica si el usuario no es el mismo que esta autenticado ene el momento para que solo le aparezca a lo usuario que son diferentes para poder seguir-->
                @if($user->id !== Auth()->user()->id)

                     <!--es importante que no confundas este user con el user del modelo User porque este user es el usuario que estamos visitando -->
                     <!--siguiendo es el metodo creado en el modelo de User y recuerda que toma un usuario que le va a mostrar de forma condicional estos mensajes entonces esta persona es la persona que esta auteticada-->
                    <!--user es la persoan que estamos visitando y auth->user es la persona que esta visitando a el usuario y recuerda user el de auth lleva los parentesis porque necesito que acceda a toda la instancia y no solo a un valor en especifico-->
                    @if(!$user->siguiendo(auth()->user()))

                    <!--este user que se esta pasando en la url el usuario que se esta visitando su perfil y es el autenticado en esta parte-->
                    <form 
                    action="{{ route('users.follow', $user) }}"
                    method="POST"
                    >
                        @csrf

                        <input 
                        type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white uppercase rounded-lg px-3 py-1 text-xs font-bold cursor-pointer"
                        value="Seguir"
                        >

                    </form>

                   
                       
                   @else
                       
                 

                    <form 
                    action="{{ route('users.unfollow', $user) }}"
                    method="POST"
                    >
                        @csrf
                        @method('DELETE')

                        <input 
                        type="submit"
                        class="bg-red-600 hover:bg-red-700 text-white uppercase rounded-lg px-3 py-1 text-xs font-bold cursor-pointer"
                        value="Dejar de Seguir"
                        >

                    </form>


                    @endif

                @endif

            @endauth

                </div>

            </div>
      </div>

      <section class="container mx-auto mt-10">

        <h2 class="text-4xl text-center font-black my-10">Publicaciones</h2>
        
        <!--recuerda esto es un componente que estoy usando aqui y en home.blade-->
       <x-listar-post :posts="$posts" />

        
 
      </section>

@endsection