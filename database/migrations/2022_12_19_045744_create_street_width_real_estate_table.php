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
        Schema::create('street_width_real_estate', function (Blueprint $table) {
            $table->foreignId('real_estate_id')->constrained('real_estates');
            $table->foreignId('street_width_id')->constrained('street_widths');

            $table->primary(['real_estate_id', 'street_width_id']);
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
        Schema::dropIfExists('street_width_real_estate');
    }
};
