<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoomRegisterCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('room_register_customers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('id_room_register');
            $table->integer('id_customer')->nullable();
            $table->string('fullName',500);
            $table->string('phoneNumber',30)->nullable();
            $table->string('identityCard',100)->nullable();
            $table->string('is_member')->default('0');
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
        Schema::dropIfExists('room_register_customers');
    }
}
