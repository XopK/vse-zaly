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
        Schema::create('booking_halls', function (Blueprint $table) {
            $table->id();

            $table->foreignId('id_hall')
                ->nullable()
                ->constrained('halls')
                ->nullOnDelete();

            $table->foreignId('id_user')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->dateTime('booking_start');
            $table->dateTime('booking_end')->nullable();
            $table->boolean('status_booking')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('booking_halls');
    }
};
