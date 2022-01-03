<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKhTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kh', function (Blueprint $table) {
            $table->increments('kh_id');   
            $table->string('jenis_kh');                     
            $table->integer('kkm');
            $table->string('aspek1');
            $table->string('aspek2');
            $table->string('aspek3');
            $table->string('aspek4');
            $table->string('max_a1');
            $table->string('max_a2');
            $table->string('max_a3');
            $table->string('max_a4');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kh');
    }
}
