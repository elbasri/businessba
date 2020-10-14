<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubtractsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subtracts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('employee_id');
            $table->string('name');
            $table->date('date');
            $table->double('amount');
            $table->text('note');
            $table->enum('type',['sub','reward']);
            $table->enum('status',['active','inactive'])->nullable();
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
        Schema::dropIfExists('subtracts');
    }
}
