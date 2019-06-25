<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateParlamentarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parlamentars', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->comment('Id do Usuario do Parlamentar');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('nome_parlamentar', 200);
            $table->string('nome_partido', 200);
            $table->string('sigla_partido', 200);
            $table->enum('status', ['A', 'I'])->default('A')->comment('A-> Ativo, I-> Inativo');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('parlamentars');
    }
}
