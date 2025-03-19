<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    //haciendo una relacion llamada posts
    //creamos el metodo
    public function posts() {
        return $this->hasMany(Post::class);
    }


    //aqui se hace una relacion de likes donde un usuario puede tener multiples likes
    public function likes()
    {
        return $this->hasMany(Like::class);

    }

    //aqui en user estamos creando un metodo que almacena los seguidores de los usuarios aunque no se sigan muchos las convensiones de laravel segun lo que vi en la migracion de follower
    //almacenar los seguidores de un usuario
    //aqui le decimos elmetodo follower en la tabla de followers pertenece a muchos usuarios 
    //aqui se esta haciendo la especificacion mas clara porque recuerda que te estas saliendo de las convenciones de laravel
    //user_id es la persona que estamos visitando follower_id es la persona que esta siguiendo
    public function followers()
    {
        return $this->belongsToMany(User::class, 'followers', 'user_id', 'follower_id');

    }

    //almacenar los que seguimos
    //este metodo es followings porque ahora es para sacar la canida de las personas que yo estoy siguiendo y por eso se cambia el orden pero todo lo otro es lo mismo
    public function followings()
    {
        return $this->belongsToMany(User::class, 'followers', 'follower_id', 'user_id');

    }

    //comprobar si un usuario ya sigue a otro
    //esto compuerba con el metodo de followers que esta arriba y contains si un usuario esta siguiendo al otro y devuelve true o false
    //con este metodo se le pasa un usuario para verificar si sigue a el otro usuario
    //con el contains se itera en toda la collecion de followers y ver si esa persona ya es un seguidor
    //entonces se le pasa adentro del contains el user->id para que tome el usuario para la comparacion 
    //este metodo no tiene nada que ver con las relaciones esto solo comprueba si el usuario esta en la lista
    public function siguiendo(User $user)
    {
        return $this->followers->contains($user->id);

    }    

    
   


    //hasMany() es el metodo dentro del modelo con el que se esta relacionado 
    //(Post::class); es el modelo con el que se va a relacionar 

    // relaciones en eloquent el ORM de laravel:
    // Las relaciones en eloquent son métodos que existen en tu modelos 

    // Un modelo tendrá un método y un tipo de relación, así como el modelo con cual esta relacionado, a esto se le conoce como colección 

    // sintaxis $user->posts

    // aqui esta relacionando el modelo de user(usuario) relacionado con posts

    // los 6 tipos de relaciones mas comunes: 

    // 1. One to One (las que mas se va a utilizar)
    // 2. One To Many (las que mas se va a utilizar) (se escribe como hasMany donde un usuario puede tener multiple posts)
    // 3. Belongs To (las que mas se va a utilizar)
    // 4. Has One Of Many
    // 5. Has One Through
    // 6. Has Many Through


}
