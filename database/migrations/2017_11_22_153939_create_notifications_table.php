<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->increments('id');
            $table->string('url')->nullable();
            $table->string('title_de')->nullable();
            $table->string('title_en')->nullable();
            $table->string('title_fr')->nullable();
            $table->string('title_it')->nullable();
            $table->string('note_de')->nullable();
            $table->string('note_en')->nullable();
            $table->string('note_fr')->nullable();
            $table->string('note_it')->nullable();
            $table->boolean('is_read')->default(false);
            $table->integer('notifiable_id')->unsigned()->nullable();
            $table->string('notifiable_type')->nullable();
            $table->timestamp('created');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notifications');
    }
}
