<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoomRegisterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('room_register', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('id_room');
            $table->integer('id_customer');
            $table->date('date_check_in');
            $table->date('date_check_out');
            $table->string('note',500);
            $table->string('del_flg')->default('0');
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
        Schema::dropIfExists('room_register');
    }
}
