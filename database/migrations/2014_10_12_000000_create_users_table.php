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
            $table->string('company_email')->unique();
            $table->string('company_name')->nullable();
            $table->string('website_url')->nullable();
            $table->string('company_owner_name')->nullable();
            $table->string('image')->nullable();
            $table->string('uu_id')->nullable();
            $table->bigInteger('ref_id')->nullable();
            $table->tinyInteger('email_verified')->default(0)->comment('1 for email verified status true');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->string('status')->nullable();
            $table->tinyInteger('role')->default(2);
            $table->string('g2fa_secret')->nullable();
            $table->tinyInteger('g2f_enabled')->default(0)->comment('0=inactive;1=active');
            $table->tinyInteger('is_withdraw_enable')->default(1)->comment('0=inactive;1=active');
            $table->tinyInteger('is_roi_enable')->default(1)->comment('0=inactive;1=active');
            $table->tinyInteger('is_affiliate_enable')->default(1)->comment('0=inactive;1=active');
            $table->tinyInteger('is_transfer_enable')->default(1);
            $table->tinyInteger('trading_mode')->default(0);
            $table->tinyInteger('auto_trading_mode')->default(0);
            $table->date('auto_trading_end_date')->nullable();
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
