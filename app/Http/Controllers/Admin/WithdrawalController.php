<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Withdrawal;
use Illuminate\Http\Request;

class WithdrawalController extends Controller
{
    public function index()
    {
        // $withdrawals = Withdrawal::paginate(10);
        $withdrawals = User::leftJoin('withdrawals', 'users.id', '=', 'withdrawals.user_id')
        ->select('users.*', 'withdrawals.amount as withdrawal_amount', 'withdrawals.status as withdrawal_status')
        ->get();
    
        // dd( $withdrawals);
        return view('admin.withdraw.index', compact("withdrawals"));
    }
    public function edit(Withdrawal $withdrawal)
    {
          // Eager load related data
         $withdrawal->load('user'); // Assuming 'user' is the relationship name
        // Use the $withdrawal model instance to perform editing operations
        return view('admin.withdraw.edit', compact('withdrawal'));
    }
    public function update(Request $request, Withdrawal $withdrawal)
    {

    }
}