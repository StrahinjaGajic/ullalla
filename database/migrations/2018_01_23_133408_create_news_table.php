<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('local_id')->unsigned()->nullable();
            $table->string('news_title')->nullable();
            $table->integer('news_total_amount')->nullable();
            $table->string('news_photo')->nullable();
            $table->text('news_description')->nullable();
            $table->timestamp('news_activation_date')->nullable();
            $table->timestamp('news_expiry_date')->nullable();
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
        Schema::dropIfExists('news');
    }
}
