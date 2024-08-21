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
        Schema::table('studios', function (Blueprint $table) {
            $table->string('email_studio')->nullable()->after('photo_studio')->unique();
            $table->string('phone_studio')->nullable()->after('email_studio')->unique();
            $table->string('adress_studio')->nullable()->after('phone_studio');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('studios', function (Blueprint $table) {
            //
        });
    }
};
