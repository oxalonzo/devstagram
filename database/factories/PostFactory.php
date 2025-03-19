<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //aqui defines tus fatedata o datos falsos
            //laravel utiliza una libreria llamada faker
            'titulo' => $this->faker->sentence(5), //esto indica la cantida de palabras que quieres que te genere faker para la pruba de base de datos 
            'descripcion' => $this->faker->sentence(20),
            'imagen' => $this->faker->uuid() . '.jpg', //aqui esta generando imagen con un unico id por uuid con la extension .jpg
            'user_id' => $this->faker->randomElement([1, 2, 3]), //este de un listado de un arreglo va a seleccionar diferentes y va a asignar cada vez que vaya a selccionar uno nuevo, va ir seleccionando de forma aleatoria
        ]; //recuerda que todo esto se corre con la termianl con una herramienta llamada tinker entras a la termianl y pones sail artisan tinker
    }
    
    //recomendacion utiliza estos factory unicamente en tu base de datos local 
    //si quiero revertir un factory que hice solo debo revertir la migration
    //es importante que recuerdes que si en la migration que se conecta con este factory tu pusiste un foreingid que es un forenkey tienes que pasarle en el randomelement los id que yas esten en la tabla 
    //tinker es un cli que ya viene integrado en laravel en el cual puedes interactuar con tu aplicaciony con tu base de datos
}
