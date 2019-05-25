<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVeiculosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('veiculos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('tipo_viatura', 50);
            $table->string('titulo', 50);
            $table->string('marca', 30);
            $table->string('modelo', 30);
            $table->string('tipo', 30);
            $table->decimal('preco', 10,2);
            $table->string('combustivel', 15);
            $table->decimal('km', 15,2);
            $table->string('registo', 10);
            $table->string('cor', 15);
            $table->string('cilindrada', 20);
            $table->string('potencia', 20);
            $table->string('garantia', 20);
            $table->string('portas', 3);
            $table->string('caixa', 30);
            $table->longText('extras');
            $table->string('lotacao', 3);
            $table->string('tracao', 30);
            $table->boolean('fumador');
            $table->unsignedInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
        Schema::create('fotos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome');
            $table->unsignedInteger('veiculo_id');
            $table->foreign('veiculo_id')->references('id')->on('veiculos');
        });
        Schema::create('colecao', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('veiculo_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('veiculo_id')->references('id')->on('veiculos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fotos');
        Schema::dropIfExists('colecao');
        Schema::dropIfExists('veiculos');
    }
}