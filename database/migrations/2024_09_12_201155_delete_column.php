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
            $table->dropColumn('price_evening');
            $table->dropColumn('max_price');
            $table->dropColumn('price_for_two');
            $table->dropColumn('price_for_four');
            $table->dropColumn('price_for_seven');
            $table->dropColumn('price_for_nine');
            $table->dropColumn('time_evening');
            $table->dropColumn('price_weekend');
            $table->dropColumn('price_weekday');
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