<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChitietdatphongTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('chitietdp', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('datphong_id')->unsigned();
            $table->bigInteger('phong_id')->unsigned();
            $table->bigInteger('sophong')->default(0);
            $table->string('gia');
            $table->string('chuthich');
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
        //
        Schema::dropIfExists('chitietdp');
    }
}
