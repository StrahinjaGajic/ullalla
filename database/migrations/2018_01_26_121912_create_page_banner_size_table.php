<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePageBannerSizeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('page_banner_size', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('page_id')->unsigned();
            $table->integer('banner_size_id')->unsigned();
            $table->integer('banner_price')->unsigned();
            $table->integer('price_per_day')->unsigned();
            $table->integer('price_per_week')->unsigned();
            $table->integer('price_per_month')->unsigned();

            $table->foreign('page_id')->references('id')->on('pages')->onDelete('cascade');
            $table->foreign('banner_size_id')->references('id')->on('banner_sizes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('page_banner_size');
    }
}
