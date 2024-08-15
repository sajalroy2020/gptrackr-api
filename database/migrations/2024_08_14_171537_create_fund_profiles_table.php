<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFundProfilesTable extends Migration
{
    public function up()
    {
        Schema::create('fund_profiles', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->json('focused_sectors')->nullable();
            $table->binary('fund_logo_data')->nullable();
            $table->string('fund_logo_content_type')->nullable();
            $table->string('headline')->nullable();
            $table->text('description_as_investor')->nullable();
            $table->json('target_geographics')->nullable();
            $table->json('potential_added_value')->nullable();
            $table->json('asset_focus')->nullable();
            $table->json('fund_maturity_focus')->nullable();
            $table->string('venture_capital_fund_experience')->nullable();
            $table->string('no_of_vc_fund')->nullable();
            $table->string('investment_status')->nullable();
            $table->string('invest_amount_to_venture_capital')->nullable();
            $table->string('timeframe')->nullable();
            $table->string('check_size_range_upper_limit')->nullable();
            $table->string('check_size_range_lower_limit')->nullable();
            $table->string('ideal_check_size')->nullable();
            $table->date('last_fund_investment_date')->nullable();
            $table->foreignId('company_id')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('fund_profiles');
    }
}
