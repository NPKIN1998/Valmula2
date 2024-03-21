<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    public function index()
    {
        $userId = Auth::user();
        $referrals = $userId->referrals->count();
        $downlineData = $userId->referrals->all();
        // dd($downlineData);
        // Get active downlines with active investments
        $activeDownlines = $userId->getDownlinesCountWithInvestmentStatus('active');

        // Get downlines without active investments
        $downlinesWithoutActiveInvestments = $userId->getDownlinesCountWithInvestmentStatus('inactive');
        $uplineBonus = $userId->uplineBonus();
        // $downlines = User::whereHas('referrals', function ($query) use ($userId) {
        //     $query->where('referral_id', $userId); // Assuming 'referrer_id' is the column name that stores the ID of the referrer.
        // })->get();
        // dd($downlines);
        // dd($activeDownlines, $downlinesWithoutActiveInvestments, $uplineBonus, $downlineData );
        return view('user/account', compact(['referrals', 'activeDownlines', 'downlinesWithoutActiveInvestments', 'uplineBonus', 'downlineData']));
    }
}
