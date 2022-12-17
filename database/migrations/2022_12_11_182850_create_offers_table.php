<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offers', function (Blueprint $table) {
            $table->id();
            $table->string('offer_code')->unique()->nullable(); #

            $table->foreignId('real_estate_id')->constrained('real_estates')->cascadeOnDelete(); #
            $table->foreignId('offer_type_id')->constrained('offer_types')->cascadeOnDelete(); #
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete(); #

            #Fields
            $table->integer('who_add')->nullable(); #
            $table->integer('who_edit')->nullable(); #
            $table->integer('who_cancel')->nullable(); #
            $table->json('mediators_ids'); #
            $table->json('booking_ids'); #


            // $table->foreignId('property_type_id')->constrained('property_types')->cascadeOnDelete();
            // $table->foreignId('property_status_id')->constrained('property_statuses')->cascadeOnDelete();
            // $table->foreignId('price_type_id')->constrained('price_types')->cascadeOnDelete();
            // $table->foreignId('land_type_id')->constrained('land_types')->cascadeOnDelete();
            // $table->foreignId('branch_id')->constrained('branches')->cascadeOnDelete();
            // $table->foreignId('city_id')->constrained('cities')->cascadeOnDelete();
            // $table->foreignId('neighborhood_id')->constrained('neighborhoods')->cascadeOnDelete();
            // $table->foreignId('property_id')->constrained('properties')->cascadeOnDelete();
            // $table->foreignId('street_id')->constrained('streets')->cascadeOnDelete();
            // $table->foreignId('street_width_id')->constrained('street_widths')->cascadeOnDelete();
            // $table->foreignId('direction_id')->constrained('directions')->cascadeOnDelete();

            // $table->double('price_by_meter');
            // $table->double('total_price');
            // $table->unsignedBigInteger('land_number');
            // $table->unsignedBigInteger('block_number');

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
        Schema::dropIfExists('offers');
    }
};
