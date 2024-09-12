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
        Schema::create('hall_prices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_hall')->constrained('halls');
            $table->integer('min_people')->default(1);
            $table->integer('max_people');
            $table->integer('weekday_price');
            $table->integer('weekday_evening_price');
            $table->integer('weekend_price');
            $table->integer('weekend_evening_price');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
