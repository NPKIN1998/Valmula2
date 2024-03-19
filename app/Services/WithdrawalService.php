<?php


namespace App\Services;

use App\Models\User;
use App\Models\Withdrawal;
use App\Policies\WithdrawalPolicy;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class WithdrawalService
{
    protected $withdrawalPolicy;

    public function __construct(WithdrawalPolicy $withdrawalPolicy)
    {
        $this->withdrawalPolicy = $withdrawalPolicy;
    }

    public function store($amount)
    {
        // Validate input
        if (!is_numeric($amount) || $amount < 0) {
            throw ValidationException::withMessages(['amount' => 'Invalid withdrawal amount.']);
        }

        $user = Auth::user();

        // Ensure $user is an instance of the User model
        if (!$user instanceof User) {
            throw ValidationException::withMessages(['user' => 'Invalid user.']);
        }

        $this->authorizeWithdrawal($user);

        $balance = $user->balance;

        // Check if the withdrawal amount is less than 200
        if ($amount < 200) {
            throw ValidationException::withMessages(['amount' => 'Minimum withdrawal amount is 200.']);
        }

        // Check if the balance is sufficient
        if ($balance < $amount) {
            $error = 'Insufficient funds.';
            return back()->with('error', $error);
        }

        // Use transactions for atomicity
        return DB::transaction(function () use ($user, $amount, $balance) {
            try {
                // Update user balance
                $user->update(['balance' => $balance - $amount]);

                // Create withdrawal record
                Withdrawal::create([
                    'user_id' => $user->id,
                    'amount' => $amount,
                    'status' => 'pending',
                ]);

                $message = $user->username . ' has successfully withdrawn ' . $amount . ' to your ' . $user->phone;
                return back()->with('success', $message);
            } catch (\Exception $e) {
                // If an exception occurs, rollback the transaction
                DB::rollBack();

                // Handle different types of exceptions and provide feedback to the user
                if ($e instanceof ValidationException) {
                    return back()->with('error', $e->getMessage());
                } else {
                    // Log the exception for further investigation
                    // Log::error($e);

                    // Generic error message
                    return back()->with('error', 'An unexpected error occurred. Please try again.');
                }
            }
        });
    }

    protected function authorizeWithdrawal(User $user)
    {
        $this->withdrawalPolicy->withdraw($user);
    }
}
