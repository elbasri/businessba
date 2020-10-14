<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLeadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leads', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique()->nullable();
            $table->string('mobile')->unique();
            $table->string('country_code');
            $table->json('other_mobiles')->nullable();
            $table->string('company')->nullable();
            $table->text('facebook_url')->nullable();
            $table->text('address')->nullable();
            $table->string('phone')->nullable();
            $table->integer('lead_source')->nullable();
            $table->integer('campaign_id')->nullable();
            $table->integer('industry_id')->nullable();
            $table->string('image')->nullable();
            $table->integer('agent_id')->nullable();
            $table->integer('country_id')->nullable();
            $table->integer('city_id')->nullable();
            $table->integer('state_id')->nullable();
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
        Schema::dropIfExists('leads');
    }
}
