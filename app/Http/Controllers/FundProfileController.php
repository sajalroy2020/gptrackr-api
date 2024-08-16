<?php

namespace App\Http\Controllers;

use App\Models\FundProfile;
use App\Models\User;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Auth;

class FundProfileController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'focused_sectors' => 'required|array',
            'headline' => 'nullable|string',
            'description_as_investor' => 'nullable|string',
            'fund_logo_data' => 'nullable',
            'fund_logo_content_type' => 'nullable',
            'target_geographics' => 'nullable',
            'potential_added_value' => 'nullable',
            'asset_focus' => 'nullable',
            'fund_maturity_focus' => 'nullable',
            'venture_capital_fund_experience' => 'nullable',
            'no_of_vc_fund' => 'nullable',
            'investment_status' => 'nullable',
            'invest_amount_to_venture_capital' => 'nullable',
            'timeframe' => 'nullable',
            'check_size_range_upper_limit' => 'nullable',
            'check_size_range_lower_limit' => 'nullable',
            'ideal_check_size' => 'nullable',
            'last_fund_investment_date' => 'nullable',
            'company_id' => 'nullable',
            // 'type' => 'nullable',
        ]);

        $validatedData['company_id'] = Auth::id();
        $validatedData['type'] = Auth::user()->user_type;

         // Handle the logo file upload if exists
        if ($request->hasFile('fund_logo_content_type')) {
            $image = $request->file('fund_logo_content_type');
            $imageName = 'logo-' . time() . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(500, 500)->save(public_path('/image/' . $imageName));
            $imgPath = asset('image/' . $imageName);

            return $imgPath;

            $validatedData['fund_logo_content_type'] = $imgPath;
        }
        $fundProfile = FundProfile::create($validatedData);

        return response()->json($fundProfile, 201);
    }

    public function index()
    {
        $fundProfiles = Auth::user()->fundProfiles;
        return response()->json($fundProfiles);
    }

    public function getGeneralPartners(Request $request)
    {
        $gpUsers = User::where('user_type', 'GP')->with(['fundProfiles' => function ($query) {
            $query->select(
                'id',
                'type',
                'focused_sectors',
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
                'company_id'
            );
        }])->get();

        $result = $gpUsers->map(function ($user) {
            return $user->fundProfiles->map(function ($profile) use ($user) {
                return [
                    'fund_profile' => $profile,
                    'company_name' => $user->company_name,
                    'email' => $user->email,
                    'user_type' => $user->status,
                    'first_name' => $user->first_name,
                    'last_name' => $user->last_name,
                ];
            });
        })->flatten(1);

        return response()->json($result);
    }
}