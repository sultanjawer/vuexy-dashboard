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
        Schema::create('real_estates', function (Blueprint $table) {
            #IDs
            $table->id();
            $table->foreignId('city_id')->constrained('cities');
            $table->foreignId('neighborhood_id')->constrained('neighborhoods');
            $table->foreignId('street_width_id')->nullable()->constrained('street_widths');
            $table->foreignId('direction_id')->nullable()->constrained('directions');
            $table->foreignId('land_type_id')->nullable()->constrained('land_types');
            $table->foreignId('interface_length_id')->nullable()->constrained('interface_lengths');
            $table->foreignId('licensed_id')->nullable()->constrained('licenseds');
            $table->foreignId('owner_ship_type_id')->nullable()->constrained('owner_ship_types');
            $table->foreignId('building_type_id')->nullable()->constrained('building_types');
            $table->foreignId('building_status_id')->nullable()->constrained('building_statuses');
            $table->foreignId('construction_delivery_id')->nullable()->constrained('construction_deliveries');
            $table->foreignId('property_type_id')->constrained('property_types');
            $table->foreignId('property_status_id')->constrained('property_statuses');
            $table->foreignId('branch_id')->nullable()->constrained('branches');

            #Fields Integer
            $table->integer('real_estate_age')->nullable();
            $table->integer('floor_number')->nullable(); #The number of the floor
            $table->integer('floors_number')->nullable(); #The number of the floors in Condominium
            $table->integer('flats_numbers')->nullable(); #The number of the flats in Condominium
            $table->integer('flat_rooms_number')->nullable(); #The number of the rooms in flats of Condominium.
            $table->integer('rooms_number')->nullable(); #The number of the rooms in flat.
            $table->integer('stores_number')->nullable(); #The number of the stores in Condominium.

            #Fields Double
            $table->string('price_by_meter')->nullable();
            $table->string('price')->nullable();
            $table->string('total_price')->nullable();
            $table->string('annual_income')->nullable();
            $table->string('space')->nullable();

            #Fields Text
            $table->text('notes')->nullable();
            $table->unsignedBigInteger('land_number');
            $table->unsignedBigInteger('block_number');
            $table->string('character')->nullable();

            #Fields Enum
            $table->enum('real_estate_type', ['land', 'duplex', 'condominium', 'flat', 'chalet']);

            #Fields Dates
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
        Schema::dropIfExists('real_estates');
    }
};
