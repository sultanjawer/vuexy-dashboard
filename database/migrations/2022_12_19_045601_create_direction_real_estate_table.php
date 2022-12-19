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
        Schema::create('direction_real_estate', function (Blueprint $table) {
            $table->foreignId('real_estate_id')->constrained('real_estates');
            $table->foreignId('direction_id')->constrained('directions');

            $table->primary(['real_estate_id', 'direction_id']);
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
        Schema::dropIfExists('direction_real_estate');
    }
};
