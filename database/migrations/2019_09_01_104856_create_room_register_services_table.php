<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoomRegisterServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('room_register_services', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('id_room_register');
            $table->integer('id_service');
            $table->integer('count')->default('1');
            $table->decimal('price',11,2);
            $table->decimal('price_discount',11,2)->nullable();
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
        Schema::dropIfExists('room_register_services');
    }
}
