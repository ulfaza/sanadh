<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSiswaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('siswa', function (Blueprint $table) {
            $table->increments('s_id')->unique();                        
            $table->integer('k_id')->unsigned();
            $table->string('s_nama');
            $table->string('nis')->unique();
            $table->string('nisn')->unique();
        });
        Schema::table('siswa', function($table){
            $table->foreign('k_id')
                ->references('k_id')
                ->on('kelas')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('siswa');
    }
}
