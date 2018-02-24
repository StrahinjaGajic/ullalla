<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServiceOptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_options', function (Blueprint $table) {
            $table->increments('id');
            $table->string('service_option_name_de');
            $table->string('service_option_name_en');
            $table->string('service_option_name_it');
            $table->string('service_option_name_fr');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('service_options');
    }
}
