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
        Schema::create('feature_halls', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_feature')->constrained('features')->onDelete('cascade');
            $table->foreignId('id_hall')->constrained('halls')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('feature_halls');
    }
};
