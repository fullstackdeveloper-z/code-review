<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCoulumnToCatersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('caters', function (Blueprint $table) {
            $table->string('state')->after('city')->nullble();
            $table->string('country')->after('state')->nullble();
            $table->string('phone')->after('country')->nullble();
            $table->enum('home_delivery',['yes','no'])->nullable();
            $table->bigInteger('large_order_catering')->nullable();
            $table->bigInteger('min_order_catering')->nullable();
           
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('caters', function (Blueprint $table) {
            $table->dropColumn('phone');
            $table->dropColumn('home_delivery');
            $table->dropColumn('large_order_catering');
            $table->dropColumn('min_order_catering');
        });
    }
}
