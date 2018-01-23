<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('local_id')->unsigned()->nullable();
            $table->string('events_title')->nullable();
            $table->string('events_venue')->nullable();
            $table->integer('events_duration')->nullable();
            $table->integer('events_total_amount')->nullable();
            $table->string('events_photo')->nullable();
            $table->text('events_description')->nullable();
            $table->timestamp('events_date')->nullable();
            $table->timestamps();

            $table->foreign('local_id')->references('id')->on('locals')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('events');
    }
}
