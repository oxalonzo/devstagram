@extends('layouts.app')


@section('titulo')
    {{ $post->titulo }}
@endsection


@section('contenido')


      <div class="container mx-auto md:flex">
          <div class="md:w-1/2">

            <img src="{{ asset('uploads'). '/' . $post->imagen }}" alt="imagen del post {{ $post->titulo }}"> 

            <div class="p-3 flex items-center gap-4">

                @auth

                <!--esto es un componente de livewire que a diferencia de un componente de laravl que es con una x- aqui la etiqueta es livewire:nombredelcomponente -->
                <livewire:like-post :post="$post" />

                {{-- <!--estoy utilizando el metodo checklike que esta creado en el modleo post para verificar si ya dio like-->
                @if( $post->checkLike( auth()->user() ) )

                <form action="{{ route('posts.likes.destroy',  $post) }}" method="POST" >

                    <!--receurda esto es metodo spoofing para que el navegador tome un metodo que no sea get o post aunque se este poniendo post-->
                    @method('DELETE')

                    @csrf

                    <div class="my-4">

                       
                          
                    </div>
                </form>

                @else

                <form action="{{ route('posts.likes.store',  $post) }}" method="POST" >

                    @csrf

                    <div class="my-4">

                        <button type="submit">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="white" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                              </svg>
                        </button>
                          
                    </div>
                </form>

                @endif --}}

                @endauth
 
            </div>

            <!--diffForHumans es una api para formatear la hora y que se vea mejor, todo esto es gracia a que laravel tiene una api muy sencilla llamada carbon-->
            <div>
                <p class="font-bold">{{ $post->user->username }}</p>
                <p class="text-sm text-gray-500">{{ $post->created_at->diffForHumans() }}</p>
                <p class="mt-5">{{ $post->descripcion }}</p>
            </div>
            
            @auth

            <!--aqui esta verificando que la persona que quiere eliminar sea la misma que publico-->

            @if( $post->user_id === Auth::user()->id )
            <form action="{{ route('posts.destroy',  $post) }}" method="POST" >
                <!-- method('DELETE') esto es metodo spoofing porque el navegador solo soporta POST y GET con el metodo spoofing te permite utilizar metodos como PUT/PATH y DELETE -->  
                <!-- el metodo spoofing se utiliza para poder eliminar y tambien para poder actualizar registro -->              
                @method('DELETE')
                @csrf
                <input 
                type="submit"
                value="Eliminar publicación"
                class="bg-red-500 hover:bg-red-600 p-2 rounded text-white font-bold mt-4 cursor-pointer"
                >
            </form>
            @endif

            @endauth

          </div>

          <div class="md:w-1/2 p-5">

            <div class="shadow bg-white p-5 mb-5">

            @auth

                <p class="text-xl font-bold text-center mb-4">Agrega un nuevo comentario</p>

                @if(session('mensaje'))
                <!--recuerda que cuando esta devolviendo el mensaje de comentario creado con exito es por un with y para que se pueda ver por eso se utiliza la funcion llamada session-->

                  <div class="bg-green-500 p-2 rounded-lg mb-6 text-white text-center uppercase font-bold">
                     {{ session('mensaje') }}
                  </div>

                @endif
             
            <form action="{{ route('comentarios.store', ['post' => $post, 'user' => $user]) }}" method="POST">

                @csrf

              <div class="mb-5">
                    <label for="comentario" class="mb-2 block uppercase text-gray-500 font-bold">
                        Añade un comentario
                    </label>

                    <textarea 
                    name="comentario" 
                    id="comentario" 
                    placeholder="Agrega un comentario"
                    class="border p-3 w-full rounded-lg @error('comentario') border-red-500 @enderror"
                    ></textarea>

                    <!--la directiva error aqui en las clases lo que hace es que en caso de que en comentario tenga un error se pintara de rojo-->
                    @error('comentario')
                        <!--esto es una directiva que imprime el mensaje de error cuando no se cumple las reglas ya puesta en el controlador-->
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center ">
                            {{ $message }} <!--la variable que guarda el mensaje de error se llama message-->
                        </p>
                    @enderror

                </div>


                <input 
                type="submit"
                value="Comentar"
                class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg"
                >

            </form>


            @endauth

            <!--aqui se mostraran los comentarios despues de hacer la relacion en post.php de un post a muchos comentarios-->
            <div class="bg-white shadow mb-5 max-h-96 overflow-y-scroll mt-10">

                <!--aqui dice que si al menso hay un comentario mostrara esta parte y no tuve que hacer niguna consulta para traerlos gracia a la relacion en el post.php con los comentarios  -->
                <!--para que se vea el usuario tuve que crear una relacion en el modelo de comentario ya que la tabla de comentario tiene el user_id-->
                @if($post->comentarios->count())

                    @foreach( $post->comentarios as $comentario)

                    <div class="p-5 border-gray-300 border-b">
                   
                    <!--esto inprime comentario->user->username user que es la relacion creada en comentario y eso da acceso a los username de los usuarios-->
                    <!--con el href lo que estoy haciendo es pasando el usuario que comento para ir a su perfil con la variable $comentario->user-->    
                    <a href="{{ route('posts.index', ['user' => $comentario->user]) }}" class="font-bold hover:text-gray-500" title="Usuario: {{ $comentario->user->username }}">
                        {{$comentario->user->username}}
                    </a>
                    <p> {{$comentario->comentario}}</p>
                    <p class="text-sm text-gray"> {{$comentario->created_at->diffForHumans()}}</p>
                   

                    </div>

                    @endforeach

                @else

                <p class="p-10 text-center font-bold">
                    No hay comentarios aun
                </p>

                @endif
                

            </div>


            </div>

          </div>
      </div>

@endsection