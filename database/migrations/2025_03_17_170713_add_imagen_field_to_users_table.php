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
        Schema::table('users', function (Blueprint $table) {
            //poner los nombres de la migraciones en ingles ayuda para que laravel automaticamente por lo menos en este caso detectara que es a la tabla users que quiero hacer el cambio
            //no siempre las migraciones son para agregar tablas completas si no tambien a veces para agregar columnas o campos extras
           //como las imagen no va a ser un campo obligatorio agregas nullable para que permita tambien el valor nulo
            $table->string('imagen')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //si damos un rollback solo eliminara la columna
            $table->dropColumn('imagen');
        });
    }
};
