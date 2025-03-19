<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        //recuerda que el user_id esta buscando la mmigracion de user y se entra en la tabla de users
        //y para que entonces cuando se siga a la otra persoan se utiliza la columna de follower_id y con el constrained le decimos que va a ir relacionado con la tabla users
        Schema::create('followers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('follower_id')->constrained('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    //aqui lo que dice ejemplo que el usuario 2 sigue a el usuario 5 la referencia o foreingkey se saca de la tabla users

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('followers');
    }
};
