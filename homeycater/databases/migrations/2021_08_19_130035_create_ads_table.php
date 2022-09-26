<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ads', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('company');
            $table->string('type_of_business');
            // $table->string('type_of_ad');
            $table->date('publish_start_date');
            $table->date('publish_end_date');
            $table->string('duration');
            $table->text('address');
            $table->string('city');
            $table->string('state');
            $table->string('country');
            $table->string('phone');
            $table->string('email');
            $table->string('im_id');
            $table->longText('comments')->nullable();
            $table->string('url');
            $table->morphs('adable');
            $table->enum('type', ['top', 'slider', 'side']);
            $table->tinyInteger('published')->default(0);
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
        Schema::dropIfExists('ads');
    }
}
