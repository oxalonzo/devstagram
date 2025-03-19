<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class LikePost extends Component
{
    //aqui es donde se puede consultar un modelos lo unico no disponible aqui en livewire son los request 
    //livewire tiene su propia forma de hacerlo los request
    //difernecia de livewire con los componentes de laravel que livewire desde el momento que lo registras aqui en este archivo ya se pasa a la vista de livewire
    
    // public $mensaje = "Hola mundo desde un atributo con livewire";

    //tambien cuando quieras pasar informacion desde el template padre donde se esta mandando a llamar el componente de livewire se utiliza el siguiente comando <livewire:like-post :mensaje="$mensaje" />
    //y no es necesario poner igual y la variable porque ya se pasa automaticamente
    public $post;
    public $isLiked;
    public $likes;

    //nota importante recuerda que el mount monta la informacion en las variables pero para que cambie dinamicamente tenemos que hacer el codigo de forma reactiva como lo hicimos con isLiked

    //para que si le dio me gusta se pinte de rojo y si no dio me gust ase pinte de blanco para ellos utilizare una funcion que se le puede conocer como el ciclo de via de livewire llamada mount
    //mount() va a ser una funcion que se va a ejecutar automaticamente cuando sea instaciando el LikePost es exatamente igual que un constructor en php solo que aqui se llama mount
    public function mount($post)
    {
        //aqui lo que hace que cuando sea instanciado tenemos acceso a la variable post 
        //entonces accedes a islike y le dices que su valor va a ser de ese post, pero vamos a chequear si el usuario dio me gusta asi que se 
        //utiliza el metodo checklike y se le pasa el usuario actual
        //en likes loq eu hace es que una vez es instanciado que se sabe cuantos likes tiene la publicacion se pasa a la variable likes

        $this->isLiked = $post->checkLike(Auth::user());
        $this->likes = $post->likes->count();
       

    }
    public function like()
    {
        //si ya un usuario dio me gusta entonces se ejecutara un eliminado del usuario cuando de dislike
        if( $this->post->checkLike( Auth::user() ) ){

             //elimando like para que lo marque 

            //aqui lo que hacemos es que accedemos al request que va a tener el usuario atual y despues el metodo likes del modelo de User
            //y le ponemos where y donde le pasamos el post_id que eso va a almacenar el id del post donde estamos dando like y eso va a tener la referencia del usuario en automatico
            //gracias a esa relacion y despues se le pasa la variable post->id y despues la funcion de delete()
            //el post_id se refiere a la columna de likes   
            // entonces de aqui viene el usuario y en el usuario esta la relacion de likes de donde vienen y despues simplemente filtrar el post actual donde estamos eliminando el like estamos en el destroy y lo eliminamos
            $this->post->likes()->where('post_id', $this->post->id)->delete();
            
            //esto hace el re-render para que cambien en automatico el color y no haya que recargarlo
            $this->isLiked = false;

            //esto reduce de forma interactiva los like
            $this->likes--;

        }else{

              //dando like para que lo marque 
              //pasamos el post ya que pasa gracias a la relacion y asi no hay que ponerlo en el modelo de like 
              //pasamos el post despues el metodo de like y ponemos create para crear el registro
            $this->post->likes()->create([
                //accede a el id del usuario y lo guarda en la columna user_id
                'user_id' => Auth::user()->id
             ]);

             //esto hace el re-render para que cambien en automatico el color y no haya que recargarlo
             $this->isLiked = true;

             //esto aumenta de forma interactiva los like
             $this->likes++;
    
             
    

        }

        //con esto te evitaste muchas lineas de codigo a la vwez te evitaste el csrf automaticamente livewire tiene todas esas medidas de segurida y se puede ver que es una mezcla tomando lo mejor de php y lo mejor vue.js
        //para crear algo dinamico y tienes interaciones un poco mas dinamica que ese seria el problema de hacerlo todo en el servidor 

    }


    public function render()
    {
        return view('livewire.like-post');
    }
}
