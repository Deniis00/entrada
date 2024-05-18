<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entradas', function (Blueprint $table) {
            $table->id();
            $table->integer('nro_entrada');
            $table->string('responsable')->nullable();
            $table->boolean('estado_pago')->default(false);
            $table->boolean('asistio')->default(false);
            $table->dateTime('fecha_asistio')->nullable();
            $table->unsignedBigInteger('usuario_actualizo_id')->nullable();
            $table->dateTime('fecha_cobro')->nullable();
            $table->unsignedBigInteger('usuario_cobro_id')->nullable();
            $table->timestamps();

            // Asegurar que la tabla de usuarios exista antes de ejecutar esto o usar onDelete('set null')
            $table->foreign('usuario_actualizo_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('entradas');
    }
};
