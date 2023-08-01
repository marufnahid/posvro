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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('firstName');
            $table->string('lastName');
            $table->string('phone', 15)->unique();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('otp-mail')->nullable();
            $table->boolean('otpVerified')->default(false);
            $table->boolean('emailVerified')->default(false);
            $table->boolean('phoneVerified')->default(false);
            $table->string('role')->default('user');
            $table->string('status')->default('active');
            $table->string('profileImage')->nullable();
            $table->string('address')->nullable();
            $table->string('city')->nullable();
            $table->string('state', 50)->nullable();
            $table->string('country', 50)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
