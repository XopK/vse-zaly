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
            $table->bigInteger('id_unregistered_user')->unsigned()->nullable()->after('payment_id');
            $table->foreign('id_unregistered_user')->references('id')->on('unregistered_users')->onDelete('cascade');
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