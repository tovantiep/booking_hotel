<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class PhongTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('phong', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('loaiphong_id')->unsigned();
            $table->string('tenphong');
            $table->boolean('trangthai')->nullable();
            $table->text('chuthich')->nullable();
            $table->text('hinhanh')->nullable();
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('soluong')->default(0);
            $table->bigInteger('booked')->default(0);
            $table->float('gia')->default(0);
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
        Schema::dropIfExists('phong');
    }
}
