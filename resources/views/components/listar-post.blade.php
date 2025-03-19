<div>
    <!-- Always remember that you are absolutely unique. Just like everyone else. - Margaret Mead -->
    <!--esta es la vista que se mostrara como componente-->
    <!--esta vista es unicamente para mostrar la informacion a diferencia del componente para la logica que listarPost.php-->

    <!--los slot cuando se le pasa la informacion desde el otro lado con al etiqueta se utiliza una sintaxis especial la cual esta indicada abajo-->
    <!--los slot actuan como variables o contenedores que estan esperndo llenarse con informacion y lo llenas con la informacion que le pasas entre la apertura y el cierre del componente que quieres utilizr -->
    <!--la variable titulo se llena con los datos pasado entre la apertura y el cierre del componente y se identifica a el slot con la palabra titulo con su sintaxis-->
    
    {{-- {{ $titulo }}
    <h1>{{ $slot }}</h1> --}}

     <!-- en caso de que post traiga uno o mas se ejecutara este codigo en caso contrario se ejecutara el otro codigo-->
    @if ($posts->count())

    <div class="grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">

        @foreach($posts as $post)

            <div>
                <!--estoy pasando el valor de la foto selecionada con la variable post mediante el resources controller-->
                <!--al este post ser un objecto se mapea con la variable que pide la ruta en web.php donde da el valor del id de la imagen-->
                <!--el arreglo es para pasar dos valores a la url pero si es oslo uno no es necesario el arreglo y solo tienes que poner lo siguiente route('posts.show', $post)-->
                <a href="{{ route('posts.show', ['post' => $post, 'user' => $post->user]) }}">
                    <img src="{{ asset('uploads') . '/' . $post->imagen }}" alt="imagen de post {{ $post->titulo }}">
                </a> 
            </div>

        @endforeach

        </div>

        <div class="my-10">
         <!--esto es para la pagination que se esta relaizando en postcontroller directamente hacia aca y que aparecera los numeros por paginas-->
         <!--el estilo por defecto que es el de tailwind no funcionara porque a partir de la version 3 en adelante agregaron lo que se conoce como-->
         <!--JIT MODE es decir just in time es decir unicamente se agregara tailwind en los componentes que tu le digas que se quiere agregar tailwind-->
         <!-- es decir que si abres tailwind.config veras que se dice que agregue tailwind a todas las vistas.blade y a todos los archivos .js -->

            {{ $posts->links() }}

        </div>
   
    @else
        <p class="text-center font bold">No hay post, sigue a alguien para poder mstrar sus posts</p>
    
    @endif


   <!--esto es lo mismo que poner un if y despues un foreach y un endif-->
   {{-- @forelse ($posts as $post)

      @foreach ($posts as $post)
         <h1>{{ $post->titulo }}</h1>
      @endforeach
       
   @empty
       
   @endforelse --}}


   

</div>