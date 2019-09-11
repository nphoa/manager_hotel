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
            $table->dateTime('date_check_in');
            $table->dateTime('date_check_out');
            $table->integer('id_room_price');
            $table->decimal('service_invoice',8,2)->nullable('0');
            $table->decimal('room_price_invoice',8,2)->nullable('0');
            $table->string('note',500);
            $table->boolean('status')->default(1);
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
