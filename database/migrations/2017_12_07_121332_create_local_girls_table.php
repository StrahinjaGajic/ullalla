<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLocalGirlsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('local_girls', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nickname');
            $table->string('photos');
            $table->integer('local_id')->unsigned()->nullable();
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
        Schema::dropIfExists('local_girls');
    }
}
