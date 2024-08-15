<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class CompanyController extends Controller
{
    public function signup(Request $request)
    {
        $validatedData = $request->validate([
            'company_name' => 'required',
            'website_url' => 'required|url',
            'company_owner_name' => 'required',
            'company_email' => 'required|email|unique:companies',
            'password' => 'required|min:6',
            'status' => 'required|in:GP,LP',
        ]);

        $validatedData['password'] = Hash::make($validatedData['password']);

        $company = Company::create($validatedData);

        $token = $company->createToken('auth_token')->plainTextToken;

        return response()->json([
            'company' => $company,
            'token' => $token
        ], 201);
    }

    public function login(Request $request)
    {
        if (!Auth::attempt($request->only('company_email', 'password'))) {
            return response()->json([
                'error' => 'Invalid email or password'
            ], 401);
        }

        $company = Company::where('company_email', $request['company_email'])->firstOrFail();

        $token = $company->createToken('auth_token')->plainTextToken;

        return response()->json([
            'token' => $token
        ]);
    }
}


