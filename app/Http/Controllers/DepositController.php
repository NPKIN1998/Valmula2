<?php

namespace App\Http\Controllers;

use App\Models\Deposit;

class DepositController extends Controller
{
    public function index()
    {
        $deposits = Deposit::all();
        return view('user.deposit', compact('deposits'));
    }
}
