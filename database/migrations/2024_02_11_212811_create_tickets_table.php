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
        Schema::create('Ticket', function (Blueprint $table) {
            $table->id('ID_Ticket');
            $table->unsignedBigInteger('ID_Usuario');
            $table->unsignedBigInteger('ID_Auxiliar');
            $table->unsignedBigInteger('ID_Departamento');
            $table->date('Fecha');
            $table->string('Clasificacion',100);
            $table->text('Detalles');
            $table->string('Estatus',50);

            //Claves foráneas
            $table->foreign('ID_Usuario')->references('ID_Usuario')->on('Usuario')->onDelete('cascade');
            $table->foreign('ID_Departamento')->references('ID_Departamento')->on('Departamento')->onDelete('cascade');

            $table->timestamps(); //Nos sirve para crear las columnas created_at y updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
