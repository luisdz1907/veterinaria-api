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
        Schema::create('animals', function (Blueprint $table) {
            $table->id();
            $table->string("raza",100);
            $table->string("nombres",100);
            $table->enum("sexo",['M','F']);
            $table->string("peso",10);
            $table->string("color",50);
            $table->string("enfermedades",255);
            $table->string("alergias",255);
            $table->string("cirugias",255);
            $table->string("nro_partos",20);
            $table->enum("esteril",['si','no']);
            $table->string("edad",100);
            $table->foreignId('clientes_id')->constrained()->onDelete('cascade');
            $table->foreignId('tipoanimal_id')->constrained()->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('animals');
    }
};
