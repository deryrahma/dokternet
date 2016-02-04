<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create( 'province', function( Blueprint $table ) {
            $table->increments( 'id' );
            $table->string( 'name', 30 );
        } );

        Schema::create( 'city', function( Blueprint $table ) {
            $table->increments( 'id' );
            $table->integer( 'province_id' )->unsigned();
            $table->string( 'name', 50 );
        } );

        Schema::create( 'clinic', function( Blueprint $table ) {
            $table->increments( 'id' );
            $table->integer( 'city_id' )->unsigned();
            $table->string( 'name', 100 );
            $table->text( 'address' );
            $table->float( 'latitude' );
            $table->float( 'longitude' );
            $table->string( 'telephone', 20 );
            $table->string( 'email', 50 );
            $table->text( 'password' );
            $table->string( 'activation_code' );
            $table->rememberToken();
            $table->timestamps();
        } );

        Schema::create( 'article_category', function( Blueprint $table ) {
            $table->increments( 'id' );
            $table->text( 'name' );
            $table->timestamps();
        } );

        Schema::create( 'article', function( Blueprint $table ) {
            $table->increments( 'id' );
            $table->integer( 'article_category_id' )->unsigned();
            $table->text( 'title' );
            $table->text( 'description' );
            $table->text( 'image' );
            $table->timestamps();
        } );

        Schema::create( 'schedule', function( Blueprint $table ) {
            $table->increments( 'id' );
            $table->integer( 'clinic_id' )->unsigned();
            $table->integer( 'doctor_id' )->unsigned();
            $table->time( 'schedule_start' );
            $table->time( 'schedule_end' );
            $table->integer( 'quota' );
            $table->string( 'status', 20 );
            $table->timestamps();
        } );

        Schema::create( 'doctor_clinic', function( Blueprint $table ) {
            $table->increments( 'id' );
            $table->integer( 'doctor_id' )->unsigned();
            $table->integer( 'clinic_id' )->unsigned();
            $table->timestamps();
        } );

        Schema::create( 'doctor', function( Blueprint $table ) {
            $table->increments( 'id' );
            $table->integer( 'specialization_id' )->unsigned();
            $table->integer( 'city_id' )->unsigned();
            $table->string( 'name', 50 );
            $table->text( 'address' );
            $table->float( 'latitude' );
            $table->float( 'longitude' );
            $table->string( 'email', 50 );
            $table->text( 'password' );
            $table->string( 'mobile', 20 );
            $table->string( 'telephone', 20 );
            $table->boolean( 'verified' )->default(0);
            $table->boolean( 'enabled' )->default(0);
            $table->string( 'activation_code' );
            $table->rememberToken();
            $table->timestamps();
        } );

        Schema::create( 'specialization_category', function( Blueprint $table ) {
            $table->increments( 'id' );
            $table->string( 'name', 50 );
            $table->timestamps();
        } );

        Schema::create( 'specialization', function( Blueprint $table ) {
            $table->increments( 'id' );
            $table->integer( 'specialization_category_id');
            $table->string( 'name', 50 );
            $table->timestamps();
        } );
        Schema::create( 'doctor_specialization', function( Blueprint $table ) {
            $table->increments( 'id' );
            $table->integer( 'doctor_id' )->unsigned();
            $table->integer( 'specialization_id' )->unsigned();
            $table->timestamps();
        } );

        Schema::create( 'review', function( Blueprint $table ) {
            $table->increments( 'id' );
            $table->integer( 'patient_id' )->unsigned();
            $table->integer( 'reservation_id' )->unsigned();
            $table->integer( 'doctor_id' )->unsigned();
            $table->text( 'description' );
            $table->smallInteger( 'rating' );
            $table->timestamps();
        } );

        Schema::create( 'recommendation', function( Blueprint $table ) {
            $table->increments( 'id' );
            $table->integer( 'doctor_id' )->unsigned();
            $table->integer( 'reservation_id' )->unsigned();
            $table->integer( 'recommendation_doctor_id' )->unsigned();
            $table->timestamps();
        } );

        Schema::create( 'admin', function( Blueprint $table ) {
            $table->increments( 'id' );
            $table->string( 'email', 50 );
            $table->text( 'password' );
            $table->string( 'first_name', 30 );
            $table->string( 'last_name', 30 );
            $table->timestamps();
        } );

        Schema::create( 'suggestion', function( Blueprint $table ) {
            $table->increments( 'id' );
            $table->string( 'email', 50 );
            $table->text( 'title' );
            $table->text( 'description' );
            $table->timestamps();
        } );

        Schema::create( 'reservation', function( Blueprint $table ) {
            $table->increments( 'id' );
            $table->integer( 'patient_id' )->unsigned();
            $table->integer( 'schedule_id' )->unsigned();
            $table->string( 'status', 50 );
            $table->text('diagnosis_in');
            $table->text('diagnosis_out');
            $table->text('laboratory_result');
            $table->text( 'activity' );
            $table->text( 'note' );
            $table->string( 'token', 10 );
            $table->boolean( 'verified' )->default(0);
            $table->timestamps();
        } );

        Schema::create( 'patient', function( Blueprint $table ) {
            $table->increments( 'id' );
            $table->string( 'first_name', 30 );
            $table->string( 'last_name', 30 );
            $table->char( 'gender', 1 );
            $table->date( 'birth_date' );
            $table->string( 'email', 50 );
            $table->text( 'password' );
            $table->boolean( 'enabled' )->default(0);
            $table->boolean( 'verified' )->default(0);
            $table->string( 'mobile', 20 );
            $table->string( 'telephone', 20 );
            $table->string( 'activation_code' );
            $table->rememberToken();
            $table->timestamps();
        } );

        Schema::create( 'notification', function( Blueprint $table ) {
            $table->increments( 'id' );
            $table->integer( 'patient_id' )->unsigned();
            $table->integer( 'user_flag' );
            $table->text( 'title' );
            $table->text( 'description' );
            $table->timestamps();
        } );
        Schema::create( 'users', function( Blueprint $table ) {
            $table->increments( 'id' );
            $table->string( 'first_name', 30 );
            $table->string( 'last_name', 30 );
            $table->char( 'gender', 1 );
            $table->date( 'birth_date' );
            $table->string( 'email', 50 );
            $table->text( 'password' );
            $table->text( 'address' );
            $table->boolean( 'enabled' )->default(0);
            $table->boolean( 'verified' )->default(0);
            $table->string( 'mobile', 20 );
            $table->string( 'telephone', 20 );
            $table->string( 'activation_code' );
            $table->integer('role_id')->unsigned()->nullable();
            $table->rememberToken();
            $table->timestamps();
        } );
        Schema::create('roles', function($table)
        {
            $table->increments('id');
            $table->string('code', 16)->nullable();
            $table->string('name', 32)->nullable();
            $table->boolean('locked')->nullable();
            $table->boolean('enabled')->nullable();
            $table->boolean('default')->nullable();
            $table->boolean('require_file')->nullable();
            $table->integer('level')->nullable();
        });

        Schema::create('adminmenus', function($table)
        {
            $table->increments('id');
            $table->integer('parent_id')->unsigned()->index()->nullable();
            $table->string('name')->index()->nullable();
            $table->string('route')->nullable();
            $table->integer('order_item')->nullable();
            $table->string('icon');
            $table->boolean('enabled')->nullable();
        });
        Schema::create('permissions', function($table)
        {
            $table->increments('id');
            $table->string('route')->index()->nullable();
            $table->boolean('enabled')->nullable();
        });
        Schema::create('role_user', function($table)
        {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->index()->nullable();
            $table->integer('role_id')->unsigned()->index()->nullable();
        });
        Schema::create('adminmenu_role', function($table)
        {
            $table->increments('id');
            $table->integer('role_id')->unsigned()->index()->nullable();
            $table->integer('adminmenu_id')->unsigned()->index()->nullable();
        });

        Schema::create('permission_role', function($table)
        {
            $table->increments('id');
            $table->integer('role_id')->unsigned()->index()->nullable();
            $table->integer('permission_id')->unsigned()->index()->nullable();
        });

        Schema::create('clinic_patient',function($table){
            $table->increments('id');
            $table->integer('patient_id');
            $table->integer('clinic_id');
            $table->string('registration_number');
            $table->string('person_in_charge');
            $table->string('person_in_charge_status');
            $table->text('description');
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
        Schema::dropIfExists( 'province' );
        Schema::dropIfExists( 'city' );
        Schema::dropIfExists( 'clinic' );
        Schema::dropIfExists( 'article_category' );
        Schema::dropIfExists( 'article' );
        Schema::dropIfExists( 'schedule' );
        Schema::dropIfExists( 'doctor_clinic' );
        Schema::dropIfExists( 'doctor' );
        Schema::dropIfExists( 'specialization' );
        Schema::dropIfExists( 'review' );
        Schema::dropIfExists( 'recommendation' );
        Schema::dropIfExists( 'admin' );
        Schema::dropIfExists( 'suggestion' );
        Schema::dropIfExists( 'reservation' );
        Schema::dropIfExists( 'patient' );
        Schema::dropIfExists( 'notification' );
        Schema::dropIfExists( 'users' );
        Schema::dropIfExists( 'roles' );
        Schema::dropIfExists( 'adminmenus' );
        Schema::dropIfExists( 'permissions' );
        Schema::dropIfExists( 'role_user' );
        Schema::dropIfExists( 'adminmenu_role' );
        Schema::dropIfExists( 'permission_role' );
        Schema::dropIfExists( 'clinic_patient' );
        Schema::dropIfExists( 'doctor_specialization' );
        Schema::dropIfExists( 'specialization_category' );
    }
}
