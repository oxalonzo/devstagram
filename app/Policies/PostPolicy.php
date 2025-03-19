<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class PostPolicy
{

    //esto es lo mas importante que debes entender este policie le va a permitir al usuario poder ver, eliminar y actualizar algun registro
    //tu vas a poder a asociarle un modelo y por default tienen asociado a un usuario 
    //viewany determina si un usuario desea ver algun modelo, tambien si un usuario puede ver un modelo, o si desea crear algun modelo,
    //esto sirve para empresas que tienen que tener diversos roles ejemploun repartidor no puede crear ordenes como un cocinero si 
    //de esta forma puedes ocultar cierta informacion o prohibir el acceso a cierta sesiones 


     /**
     * Determine whether the user can delete the model.
     */

     //aqui esa tomando con el route model biding la variable post que se esta pasando mediante el mismo para poder autorizar desde el postcontroller la eliminacion del post del usuario y confirmar que sea el 
    public function delete(User $user, Post $post): bool
    {
        //aqui se confirma que sea el
        return $user->id === $post->user_id;
    }

    /**
     * Determine whether the user can view any models.
     */
    // public function viewAny(User $user): bool
    // {
    //     return false;
    // }

    /**
     * Determine whether the user can view the model.
     */
    // public function view(User $user, Post $post): bool
    // {
    //     return false;
    // }

    /**
     * Determine whether the user can create models.
     */
    // public function create(User $user): bool
    // {
    //     return false;
    // }

    /**
     * Determine whether the user can update the model.
     */
    // public function update(User $user, Post $post): bool
    // {
    //     return false;
    // }

    /**
     * Determine whether the user can restore the model.
     */
    // public function restore(User $user, Post $post): bool
    // {
    //     return false;
    // }

    /**
     * Determine whether the user can permanently delete the model.
     */
    // public function forceDelete(User $user, Post $post): bool
    // {
    //     return false;
    // }
}
