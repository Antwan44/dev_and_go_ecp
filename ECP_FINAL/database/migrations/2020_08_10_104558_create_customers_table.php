<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('firstname');
            $table->string('lastname');
            $table->string('phone')->unique();
            $table->string('email')->unique();
            $table->integer('street_number');
            $table->string('street_name');
            $table->integer('zip_code');
            $table->string('city');
            $table->string('lat')->nullable();
            $table->string('lng')->nullable();
            $table->string('route_to_door')->nullable();
            $table->date('birthday')->nullable();
            $table->string('special_note')->nullable();
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
        Schema::dropIfExists('customers');
    }
}
