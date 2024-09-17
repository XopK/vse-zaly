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
        Schema::table('hall_prices', function (Blueprint $table) {
            $table->dropForeign(['id_hall']);

            $table->foreign('id_hall')
                ->references('id')
                ->on('halls')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('hall_prices', function (Blueprint $table) {
            $table->dropForeign(['id_hall']);

            $table->foreign('id_hall')
                ->references('id')
                ->on('halls');
        });
    }
};
