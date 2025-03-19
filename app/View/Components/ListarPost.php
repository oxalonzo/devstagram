<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ListarPost extends Component
{
    /**
     * Create a new component instance.
     */


     //esto es para que registre la variable y la identifique 
     public $posts;


     //usualmente cuando se introducen las vistas dinamicas se recomienda limpiar las vistas asi que utiliza el siguiente comando en la terminal 
     //sail artisan view:clear esto limpia la cache de las vistas

     //aqui es donde esta la logica para el lado del servidor para este componente
    ///y crea un render que esta es la funcion que muestra una vista, esa vista 
    //es la que se crea en resources/view/components/nombre del componente
    //aqui en este archivo es donde se va aobtener la informacion que se va a mostrar en el template
    //aqui ene ste constructor estar la informacion que se le pasara a un componente
    public function __construct($posts)
    {
        //aqui se esta pasando la variable que viene desde homecontroller despues la vista donde se llama al componente despues se pasa la variable al constructor y el componente y para que termine de pasarla a la vista del componente se escribe en el constructor
        $this->posts = $posts;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.listar-post');
    }
}
