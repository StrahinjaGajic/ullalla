<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVisitorDateUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('visitor_date_user', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('visitor_date_id');
            $table->integer('user_id')->default(0);
            $table->integer('local_id')->default(0);
            $table->integer('visitors');
            $table->integer('active');
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
        Schema::dropIfExists('visitor_date_user');
    }
}
