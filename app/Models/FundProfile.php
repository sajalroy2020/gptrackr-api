<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FundProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'focused_sectors',
        'fund_logo_data',
        'fund_logo_content_type',
        'headline',
        'description_as_investor',
        'target_geographics',
        'potential_added_value',
        'asset_focus',
        'fund_maturity_focus',
        'venture_capital_fund_experience',
        'no_of_vc_fund',
        'investment_status',
        'invest_amount_to_venture_capital',
        'timeframe',
        'check_size_range_upper_limit',
        'check_size_range_lower_limit',
        'ideal_check_size',
        'last_fund_investment_date',
        'company_id',
    ];

    protected $casts = [
        'focused_sectors' => 'array',
        'target_geographics' => 'array',
        'potential_added_value' => 'array',
        'asset_focus' => 'array',
        'fund_maturity_focus' => 'array',
        'last_fund_investment_date' => 'date',
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
