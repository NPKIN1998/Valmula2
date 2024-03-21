<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Withdrawal;
use Illuminate\Http\Request;

class WithdrawalController extends Controller
{
    public function search(Request $request)
    {
        $searchTerm = $request->input('search');

        $withdrawals = Withdrawal::whereHas('user', function ($query) use ($searchTerm) {
            $query->where('username', 'like', '%' . $searchTerm . '%')
                  ->orWhere('phone', 'like', '%' . $searchTerm . '%');
        })
        ->orWhere('amount', 'like', '%' . $searchTerm . '%')
        ->orWhere('status', 'like', '%' . $searchTerm . '%')
        ->paginate(10);

        return view('admin.withdraw.index', compact('withdrawals'));
    }
    public function index()
    {
        $withdrawals = Withdrawal::get();
        // dd($withdrawals);
        return view('admin.withdraw.index', compact("withdrawals"));
    }
    public function edit(Withdrawal $withdrawal)
    {
        // Eager load related data if needed
        $withdrawal->load('user'); // Assuming 'user' is the relationship name

        return view('admin.withdraw.edit', compact('withdrawal'));
    }
    public function update(Request $request, Withdrawal $withdrawal)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'balance' => 'required|numeric',
            'amount' => 'required|numeric',
            'status' => 'required|in:pending,approved,completed',
        ]);

        $withdrawal->update($validatedData);

        $withdrawal->update([
            'amount' => $validatedData['amount'],
            'status' => $validatedData['status']
        ]);

        // Redirect back with success message
        return redirect()->route('withdrawal.edit', ['withdrawal' => $withdrawal->id])->with('success', 'Withdrawal updated successfully');

    }
}
