<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    /** @use HasFactory<\Database\Factories\PostFactory> */
    use HasFactory;

    //laravel tiene algo llamado el filable que es la informacion que se va a llenar en la base de datos, es una forma de proteger tu base de datos y se evitan que te salga errores como esto 
    //Add [titulo] to fillable property to allow mass assignment on [App\Models\Post]. al momento de hacer el post
    
    
    protected $fillable = [
        'titulo',
        'descripcion',
        'imagen',
        'user_id'

    ];

    //recuerda este filable es la informacion que hara saber a laravel cual es la informacion que tiene que leer y cual es la que tiene que procesar antes de enviarla a la base de datos
    //siempre la misma que tengas en el controlador que se identifica con el modelo 


    //creando la relacion donde un post pertenece a un usuario 
    public function user() 
    { 
        return $this->belongsTo(User::class)->select([
            'name',
            'username'
        ]);
    }

    //el ->select([]) es para especificar lo que te quieres traer


    //puedes ver la relacion arriba que un post pertenece a un usuario pero aqui un post tendra varios comentarios con esta relacion
    //en donde dice class esta importando el modelo de comentario
    public function comentarios() 
    {

        return $this->hasMany(Comentario::class);

    }


    public function likes()
    {
        //ya que un post va a tener muchos likes le pasamos el modelo de like
        //relacion de muchos a muchos
        return $this->hasMany(Like::class);
    }


    //aqui verificaremos si un usuarioo le dio like para evitar que de like dos veces y que se guarde dos veces el registro
    public function checkLike(User $user)
    {
        //ya que aqui tenemos la relacion de like arriba podemos utilizarla aqui mismo recuerda que no lo estas utilizando aqui como una funcion asi que no le pongas ()
        //contains metodo esto lo que hace es ir automaticamente debido a la relacion y al modelo que tenemos y ese modelo como esta asociado a la migration 
        //tambien al controlador se situa aqui en likes y este contains va a revisar cualquiera de las columnas que tenemos en la tabla de likes
        //en este caso quiero revisar la de user_id entonces contiene a el user_id se trata de confirmar
        return $this->likes->contains('user_id', $user->id);
    } 


}
