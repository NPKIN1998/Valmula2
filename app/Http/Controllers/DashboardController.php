<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use App\Models\Invest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $userId = Auth::user();
        $referrals =  $userId->referrals->count();
        // Retrieve investments for the authenticated user
        $orders = Order::all();
        // dd($orders);
        $investments = Invest::where('user_id', $userId->id)->get();
        // dd($investments);
        return view('user.dashboard', compact(['referrals', 'investments', 'orders']));
    }
}
