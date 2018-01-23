<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLocalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('locals', function (Blueprint $table) {
            $table->increments('id');
            $table->string('username');
            $table->string('email');
            $table->string('password');
            $table->integer('activated')->nullable();
            $table->integer('approved')->nullable();
            $table->string('name')->nullable();
            $table->string('street')->nullable();
            $table->string('zip')->nullable();
            $table->string('city')->nullable();
            $table->string('web')->nullable();
            $table->string('phone')->nullable();
            $table->string('mobile')->nullable();
            $table->boolean('sms_notifications')->default(false);
            $table->text('about_me')->nullable();
            $table->string('photo')->nullable();
            $table->string('photos')->nullable();
            $table->string('videos')->nullable();
            $table->string('working_time')->nullable();
            $table->decimal('lat', 9, 6)->nullable();
            $table->decimal('lng', 9, 6)->nullable();
            $table->integer('club_entrance_id')->unsigned()->nullable();
            $table->integer('club_wellness_id')->unsigned()->nullable();
            $table->integer('club_food_id')->unsigned()->nullable();
            $table->integer('club_outdoor_id')->unsigned()->nullable();
            $table->integer('local_type_id')->unsigned()->nullable();
            $table->integer('package1_id')->unsigned()->nullable();
            $table->integer('is_active_d_package')->nullable();
            $table->string('package1_duration');
            $table->timestamp('package1_activation_date')->nullable();
            $table->timestamp('package1_expiry_date')->nullable();
            $table->integer('package2_id')->unsigned()->nullable();
            $table->boolean('is_active_gotm_package')->default(false);
            $table->timestamp('package2_activation_date')->nullable();
            $table->timestamp('package2_expiry_date')->nullable();
            $table->string('scheduled_default_package')->nullable();
            $table->string('scheduled_gotm_package')->nullable();
            $table->string('stripe_id')->nullable();
            $table->string('stripe_amount')->nullable();
            $table->rememberToken();
            $table->timestamps();

            $table->foreign('club_entrance_id')->references('id')->on('clubs_info')->onDelete('cascade');
            $table->foreign('club_wellness_id')->references('id')->on('clubs_info')->onDelete('cascade');
            $table->foreign('club_food_id')->references('id')->on('clubs_info')->onDelete('cascade');
            $table->foreign('club_outdoor_id')->references('id')->on('clubs_info')->onDelete('cascade');
            $table->foreign('local_type_id')->references('id')->on('local_types')->onDelete('cascade');
            $table->foreign('package1_id')->references('id')->on('local_packages')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('locals');
    }
}
