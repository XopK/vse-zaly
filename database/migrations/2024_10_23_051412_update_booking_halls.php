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
        Schema::table('booking_halls', function (Blueprint $table) {
            $table->dateTime('booking_start')->nullable()->change();
            $table->integer('total_price')->nullable()->change();
            $table->integer('min_people')->nullable()->change();
            $table->integer('max_people')->nullable()->change();
            $table->boolean('is_available')->default(true);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('booking_halls', function (Blueprint $table) {
            //
        });
    }
};
