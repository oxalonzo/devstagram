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
            //aqui crea en la tabla de users la columna de tipo string llamada 'username'
            //la funcion unique se ejecuta para que el username sea unico
            
            $table->string('username')->unique();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //aqui elimina la columna de tipo string llamada 'username' de la tabla de users
            $table->dropColumn('username');
        });
    }
};
