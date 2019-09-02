<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rooms', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('room_code',500);
            $table->string('room_name',500);
            $table->integer('id_type')->default(0);
            $table->integer('id_floor')->default(0);;
            $table->decimal('price',8,2);
            $table->integer('number_count');
            $table->boolean('status')->default(0);
            $table->string('note',500)->nullable();
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
        Schema::dropIfExists('rooms');
    }
}
