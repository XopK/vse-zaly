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
            $table->dropColumn('count_people_booking');
            $table->integer('min_people');
            $table->integer('max_people');
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
