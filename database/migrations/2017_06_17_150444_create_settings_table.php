<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('mobile')->nullable();
            $table->string('color')->nullable();
            $table->string('logo')->nullable();
            $table->string('icon')->nullable();
            $table->text('keywords')->nullable();
            $table->text('description')->nullable();
            $table->text('address')->nullable();
            $table->string('admin_path')->nullable();
            $table->string('admin_theme')->nullable();
            $table->string('website_theme')->nullable();
            $table->enum('language',['en','ar'])->nullable();
            $table->enum('enable_watermark',['yes','no'])->nullable();
            $table->string('watermark_image')->nullable();
            $table->enum('watermark_position',['top-left','top','top-right','left','center','right','bottom-left','bottom','bottom-right'])->nullable();
            $table->string('watermark_offset')->nullable();
            $table->enum('multi_lang',['yes','no'])->nullable();
            $table->enum('website_status',['open','closed'])->nullable();
            $table->enum('allow_admin_theme',['yes','no'])->nullable();
            $table->enum('allow_website_theme',['yes','no'])->nullable();
            $table->longText('close_message')->nullable();
            $table->enum('allow_register',['yes','no'])->nullable();
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
        Schema::dropIfExists('settings');
    }
}
