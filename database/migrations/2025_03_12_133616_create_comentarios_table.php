<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */

     //importantisimo recuerda que si haces algun cambion en la migracion despues eso te llevara a hacer un rollback y volver a migrar para que se apliquen esos cambios
    public function up(): void
    {
        Schema::create('comentarios', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); //esto lo que hace el ondelete es que cuando se elimine un post tambien se elimine los comentarios para que no de error de integracion
            $table->foreignId('post_id')->constrained()->onDelete('cascade');
            $table->string('comentario');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comentarios');
    }
};
