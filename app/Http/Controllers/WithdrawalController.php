<?php

namespace App\Http\Controllers;

use App\Services\WithdrawalService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WithdrawalController extends Controller
{
    protected $withdrawalService;

    public function __construct(WithdrawalService $withdrawalService)
    {
        $this->withdrawalService = $withdrawalService;
    }

    public function index()
    {
        // Retrieve withdrawals in descending order based on the created_at timestamp
        $withdrawals = Auth::user()->withdrawals()->latest()->paginate(5);
        // dd($withdraw);
        return view('user.withdrawal', compact('withdrawals'));
    }

    public function store(Request $request)
    {
        $amount = $request->input('amount');
        return $this->withdrawalService->store($amount);
    }
}
