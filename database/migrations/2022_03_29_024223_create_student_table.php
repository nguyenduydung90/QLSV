<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sudent', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('image');
            $table->string('Khoi');
            $table->string('MaLH')->nullable();
            $table->string('MAGV');
            $table->string('gender');
            $table->string('birthday');
            $table->string('phone');
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
        Schema::dropIfExists('sudent');
    }
}
