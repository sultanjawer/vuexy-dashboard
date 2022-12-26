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

            $table->foreignId('order_id')->nullable()->unique()->constrained('orders')->cascadeOnDelete(); #
            $table->foreignId('real_estate_id')->constrained('real_estates')->cascadeOnDelete(); #
            $table->foreignId('offer_type_id')->constrained('offer_types')->cascadeOnDelete(); #
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete(); #

            #Fields
            $table->integer('who_add')->nullable(); #
            $table->integer('who_edit')->nullable(); #
            $table->integer('who_cancel')->nullable(); #
            // $table->json('mediators_ids'); #
            $table->json('booking_ids'); #

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
