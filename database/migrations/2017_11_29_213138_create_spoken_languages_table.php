<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSpokenLanguagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spoken_languages', function (Blueprint $table) {
            $table->increments('id');
            $table->string('spoken_language_name_de');
            $table->string('spoken_language_name_en');
            $table->string('spoken_language_name_fr');
            $table->string('spoken_language_name_it');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('spoken_languages');
    }
}
