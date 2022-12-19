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
        Schema::create('offer_mediator', function (Blueprint $table) {
            $table->foreignId('offer_id')->constrained('offers');
            $table->foreignId('mediator_id')->constrained('mediators');

            $table->primary(['offer_id', 'mediator_id']);
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
        Schema::dropIfExists('offer_mediator');
    }
};
