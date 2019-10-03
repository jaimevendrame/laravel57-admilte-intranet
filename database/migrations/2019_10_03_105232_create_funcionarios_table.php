<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFuncionariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('funcionarios', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('pessoa_id')->unsigned();
            $table->foreign('pessoa_id')
                ->references('id')
                ->on('pessoas')
                ->onDelete('cascade');

            $table->integer('sector_id')->unsigned();
            $table->foreign('sector_id')
                ->references('id')
                ->on('sectors')
                ->onDelete('cascade');

            $table->string('cargo',100);
            $table->string('ramal',10);
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
        Schema::dropIfExists('funcionarios');
    }
}
