<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRepresentorDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('representor__details', function (Blueprint $table) {
            $table->increments('id');
            $table->string('street')->nullable();
            $table->integer('represent_id');
            $table->integer('employee_id');
            $table->double('sales_percent')->nullable();
            $table->double('service_percent')->nullable();
            $table->double('spare_part_percent')->nullable();
            $table->boolean('team_leader')->nullable();
            $table->boolean('manager_leader')->nullable();
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
        Schema::dropIfExists('representor__details');
    }
}
