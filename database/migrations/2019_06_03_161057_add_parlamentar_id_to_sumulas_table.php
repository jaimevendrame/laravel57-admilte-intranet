<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddParlamentarIdToSumulasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sumulas', function (Blueprint $table) {
            $table->integer('parlamentar_id')->unsigned();
            $table->foreign('parlamentar_id')->references('id')->on('parlamentars')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sumulas', function (Blueprint $table) {
            $table->dropColumn('parlamentar_id');
        });
    }
}
