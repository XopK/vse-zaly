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
        Schema::create('hall_options', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_hall')->references('id')->on('halls')->onDelete('cascade');
            $table->boolean('coffee_hall')->default(false);
            $table->boolean('bar_hall')->default(false);
            $table->boolean('wifi_hall')->default(false);
            $table->boolean('tv_hall')->default(false);
            $table->boolean('lamp_hall')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hall_options');
    }
};
