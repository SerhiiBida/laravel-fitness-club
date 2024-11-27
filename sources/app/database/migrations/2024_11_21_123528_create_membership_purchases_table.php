<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('membership_purchases', function (Blueprint $table) {
            $table->id();
            $table->foreignId('membership_id')->constrained();
            $table->foreignId('user_id')->constrained();
            $table->enum('status', ['paid', 'pending', 'cancelled'])->default('pending');
            $table->dateTime('expired_at');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('membership_purchases');
    }
};
