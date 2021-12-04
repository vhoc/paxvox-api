<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubmissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('submissions', function (Blueprint $table) {
            $table->id();

            $table->string('cliente_nombre')->nullable();
            $table->string('cliente_email')->nullable();
            $table->string('cliente_telefono')->nullable();

            $table->string('nombre_mesero');
            $table->string('frecuencia_visita');
            $table->integer('atencion_mesero');
            $table->integer('rapidez_servicio');
            $table->integer('calidad_comida');
            $table->integer('experiencia_general');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('submissions');
    }
}
