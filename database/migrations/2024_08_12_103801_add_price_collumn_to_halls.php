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
        Schema::table('halls', function (Blueprint $table) {
            $table->time('start_time')->after('step_booking');
            $table->time('end_time')->after('step_booking');
            $table->integer('price_weekday')->after('step_booking');
            $table->integer('price_weekend')->after('step_booking');
            $table->time('time_evening')->after('step_booking');
            $table->integer('price_evening')->after('step_booking');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('halls', function (Blueprint $table) {
            //
        });
    }
};