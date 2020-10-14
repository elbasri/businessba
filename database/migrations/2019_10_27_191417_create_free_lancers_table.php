<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFreeLancersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('free_lancers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cat_id');
            $table->integer('sub_id')->nullable();
            $table->string('user_name');
            $table->string('name');
            $table->string('country');
            $table->text('desc');
            $table->string('keywords');
            $table->string('url_prtofolio')->nullable();
            $table->string('mobile');
            $table->string('whats_app')->nullable();
            $table->string('email')->nullable();
            $table->string('facebook')->nullable();
            $table->string('vodafon_cache')->nullable();
            $table->string('name_posta')->nullable();
            $table->string('nationalnumber_posta')->nullable();
            $table->text('others')->nullable();
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
        Schema::dropIfExists('free_lancers');
    }
}
