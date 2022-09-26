<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCatersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('caters', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->text('intro')->nullable();
            $table->enum('gender', ['male', 'female', 'other']);
            $table->text('neighborhood');
            $table->string('town')->nullable();
            $table->string('city')->nullable();
            $table->string('how_many_times_hire', 54)->nullable();
            $table->text('notice')->nullable();
            $table->text('speciality')->nullable();
            $table->string('personal_pic')->nullable();
            $table->longText('description')->nullable();
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
        Schema::dropIfExists('caters');
    }
}
