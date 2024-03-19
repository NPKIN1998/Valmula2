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
        // Get active downlines with active investments
        $activeDownlines = $userId->getDownlinesCountWithInvestmentStatus('active');

        // Get downlines without active investments
        $downlinesWithoutActiveInvestments = $userId->getDownlinesCountWithInvestmentStatus('inactive');
        $uplineBonus = $userId->uplineBonus();
        // dd($activeDownlines, $downlinesWithoutActiveInvestments, $uplineBonus, $downlineData );
        return view('user/account', compact(['referrals', 'activeDownlines', 'downlinesWithoutActiveInvestments', 'uplineBonus', 'downlineData']));
    }
}
