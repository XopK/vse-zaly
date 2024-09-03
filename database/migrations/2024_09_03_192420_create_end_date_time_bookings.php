<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('end_date_time_bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_booking')->constrained('booking_halls');
            $table->dateTime('booking_start');
            $table->dateTime('booking_end')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('end_date_time_bookings');
    }
};
