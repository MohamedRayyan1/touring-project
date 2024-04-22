<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTravelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('travels', function (Blueprint $table) {
            $table->id();
            $table->string('tourism_name_site');
            $table->integer('period');
            $table->string('country_name');
            $table->string('hotels_name');
            $table->string('seating_stoppages');
            $table->date('departing_appointment');
            $table->string('departing_place');
            $table->string('degree_valeting');
            $table->string('activities');
            $table->string('food_service_schedule');
            $table->double('price');
            $table->string('status');
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
        Schema::dropIfExists('travels');
    }
}
