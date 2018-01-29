<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePageBannerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('page_banner', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('page_id')->unsigned();
            $table->integer('banner_id')->unsigned();
            $table->integer('banner_size_id')->unsigned();
            $table->timestamps();

            $table->foreign('page_id')->references('id')->on('pages')->onDelete('cascade');
            $table->foreign('banner_id')->references('id')->on('banners')->onDelete('cascade');
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
        Schema::dropIfExists('page_banner');
    }
}
