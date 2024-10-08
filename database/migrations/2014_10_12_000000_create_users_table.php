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
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('company_name')->nullable();
            $table->string('email')->unique();
            $table->string('password');
            $table->enum('user_type', ['GP', 'LP']);
            $table->string('image')->nullable();
            $table->tinyInteger('email_verified')->default(0)->comment('1 for email verified status true');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('status')->nullable();
            $table->string('otp')->nullable();
            $table->rememberToken();
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