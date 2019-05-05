<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSectorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sectors', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 200);
            $table->string('label', 200);
            $table->string('initials', 100);
            $table->string('image', 200)->nullable();
            $table->enum('status', ['A', 'I', 'R'])->default('A')->comment('A-> Aprovado, I-> Inativo');

            $table->text('description' );
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
        Schema::dropIfExists('sectors');
    }
}
