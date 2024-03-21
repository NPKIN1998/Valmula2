<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Deposit;
use Illuminate\Http\Request;

class DepositController extends Controller
{
    public function index()
    {
        $deposits = Deposit::paginate(10);
        return view('admin.deposit.index', compact('deposits'));
    }

    public function edit(Deposit $deposit) 
    {
         // Eager load related data if needed
         $deposit->load('user'); // Assuming 'user' is the relationship name

         return view('admin.withdraw.edit', compact('deposit'));
    }
}
