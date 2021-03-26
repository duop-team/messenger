<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->text('text');
            $table->unsignedBigInteger('attachment')->nullable();
            $table->unsignedBigInteger('sender');
            $table->unsignedBigInteger('chat');
            $table->unsignedBigInteger('status');
            $table->timestamps();
            $table->foreign('sender')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('chat')->references('id')->on('chats');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('messages');
    }
}
