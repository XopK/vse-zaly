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
        Schema::create('cancelled_booking_halls', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_hall');
            $table->unsignedBigInteger('id_user')->nullable();
            $table->dateTime('booking_start');
            $table->dateTime('booking_end');
            $table->integer('total_price');
            $table->string('payment_id')->nullable();
            $table->boolean('is_archive')->default(false);
            $table->integer('min_people');
            $table->integer('max_people');
            $table->unsignedBigInteger('id_unregistered_user')->nullable();
            $table->timestamps();

            $table->foreign('id_hall')->references('id')->on('halls')->onDelete('cascade');
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('id_unregistered_user')->references('id')->on('unregistered_users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cancelled_booking_halls');
    }
};
