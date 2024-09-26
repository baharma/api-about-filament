<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('room_id')->references('id')->on('rooms');
            $table->foreignId("rateplan_id")->references("id")->on("rete_plans");
            $table->foreignId("calendar_id")->references("id")->on("calendars");
            $table->string("reservation_number");
            $table->date("reservation_date");
            $table->dateTime("check_in");
            $table->dateTime("check_out");
            $table->string("name");
            $table->string("email");
            $table->string("phone_number");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
