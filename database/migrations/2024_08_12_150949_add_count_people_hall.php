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
            $table->integer('price_for_two')->after('max_price');
            $table->integer('price_for_four')->after('price_for_two');
            $table->integer('price_for_seven')->after('price_for_four');
            $table->integer('price_for_nine')->after('price_for_seven');
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
