<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('last_name')->nullable();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('image', 200)->nullable();
            $table->string('rg', 14)->nullable();
            $table->string('cpf', 11)->nullable();
            $table->date('birth_date')->nullable();
            $table->enum('sex', ['N', 'M', 'F'])->comment('N-> Não Informado, M-> Masculino, F-> Feminino')->nullable();
            $table->enum('marital_status', ['0','1','2','3','4','5','6'])->comment('0-> Não Informado, 1-> Solteiro, 2-> Casado, 3-> Desquitado, 4->Viúvo, 5-> União Estável, 6-> Outros')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}

