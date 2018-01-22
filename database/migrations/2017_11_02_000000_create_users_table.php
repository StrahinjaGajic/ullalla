<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('username');
            $table->string('email');
            $table->string('password');
            $table->integer('user_type_id')->unsigned();
            $table->boolean('activated')->default(false);
            $table->boolean('approved')->default(false);
            $table->boolean('is_active_d_package')->default(false);
            $table->boolean('is_active_gotm_package')->default(false);
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('nickname')->nullable();
            $table->integer('country_id')->unsigned()->nullable();
            $table->string('age')->nullable();
            $table->string('height')->nullable();
            $table->string('weight')->nullable();
            $table->string('sex')->nullable();
            $table->string('sex_orientation')->nullable();
            $table->string('type')->nullable();
            $table->string('figure')->nullable();
            $table->string('breast_size')->nullable();
            $table->string('eye_color')->nullable();
            $table->string('hair_color')->nullable();
            $table->string('tattoos')->nullable();
            $table->string('piercings')->nullable();
            $table->string('body_hair')->nullable();
            $table->string('intimate')->nullable();
            $table->string('smoker')->nullable();
            $table->string('alcohol')->nullable();
            $table->text('about_me')->nullable();
            $table->string('photos')->nullable();
            $table->string('videos')->nullable();
            $table->string('phone')->nullable();
            $table->string('mobile')->nullable();
            $table->boolean('sms_notifications')->default(false);
            $table->string('website')->nullable();
            $table->string('prefered_contact_option')->nullable();
            $table->string('skype_name')->nullable();
            $table->boolean('no_withheld_numbers')->default(false);
            $table->integer('canton_id')->unsigned()->nullable();
            $table->string('city')->nullable();
            $table->string('zip_code')->nullable();
            $table->string('address')->nullable();
            $table->decimal('lat', 9, 6)->nullable();
            $table->decimal('lng', 9, 6)->nullable();
            $table->string('club_name')->nullable();
            $table->string('incall_type')->nullable();
            $table->string('outcall_type')->nullable();
            $table->text('working_time')->nullable();
            $table->integer('package1_id')->unsigned()->nullable();
            $table->timestamp('package1_activation_date')->nullable();
            $table->timestamp('package1_expiry_date')->nullable();
            $table->integer('package2_id')->unsigned()->nullable();            
            $table->timestamp('package2_activation_date')->nullable();
            $table->timestamp('package2_expiry_date')->nullable();
            $table->string('scheduled_default_package')->nullable();
            $table->string('scheduled_gotm_package')->nullable();
            $table->string('stripe_id')->nullable();
            $table->string('stripe_amount')->nullable();
            $table->rememberToken();
            $table->timestamps();

            $table->foreign('user_type_id')->references('id')->on('user_types')->onDelete('cascade');
            $table->foreign('country_id')->references('id')->on('countries')->onDelete('cascade');
            $table->foreign('canton_id')->references('id')->on('cantons')->onDelete('cascade');
            // $table->foreign('package1_id')->references('id')->on('packages')->onDelete('cascade');
            // $table->foreign('package2_id')->references('id')->on('packages')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
