<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSumulasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sumulas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nr_protocolo', 10);
            $table->integer('user_id')->unsigned()->comment('Id do Protocolista');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->text('description');
            $table->date('date_protocolo');
            $table->time('hour_protocolo');
            $table->date('date_start')->nullable()->comment('Data de inicio de prazo');
            $table->enum('status', ['A', 'P'])->default('P')->comment('A-> Ativa, P-> Pendente');
            $table->string('image', 200)->nullable();
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
        Schema::dropIfExists('sumulas');
    }
}
