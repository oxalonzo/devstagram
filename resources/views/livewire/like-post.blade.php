<div>
    <div class="flex gap-2 items-center">


    <!--aqui hay una regla importante de los componentes de livewire al igual que react simepre tienes que retornar un div en el elemento padre -->
    <!--en react es lo mismo recuerda cuando tienes un componente nuevo solamente retornas un div en el elemento padre y si no quieres crear un div creas un frame pero aqui no hay frame eso es en react-->
    <!--pero siempre tienes que retornar un div, tienes que retornar todo el contenido que se va a mostrar con un div padre-->

    <!-- <h1> $post->titulo </h1> -->

    <!-- eventos en livewire utilizas la siguiente clase de livewire wire:nombredel evento ejemplo wire:click='"click"' o sea todos los eventos de javascript estan disponible en livewire -->
    <!--esto lo que hace es que cuando de click en el boton buscara la funcion llamada "like" en el archivo de la logica de livewire en este caso LikePost.php-->
    <button 
    wire:click="like"
    >
        <svg 
        xmlns="http://www.w3.org/2000/svg" 
        fill="{{ $isLiked ? "red" : "white" }}" 
        viewBox="0 0 24 24" stroke-width="1.5" 
        stroke="currentColor" class="size-6">
            
        <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
         
        </svg>
    </button>


       <!--debido a que el modelo de post ya tiene relacionado los likes entonces automaticamente laravel ya tiene asociado ese metodo de count para los likes en la publicacion -->
       <p class="font-bold">
        {{ $likes }} 
        <span>likes</span> 
       </p>

    
    </div>

</div>
