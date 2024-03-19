<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class WithdrawalPolicy
{
    use HandlesAuthorization;
    /**
     * Create a new policy instance.
     */
    public function withdraw(User $user)
    {
        // Ensure the user is authenticated
        if (!Auth::check()) {
            throw new AuthorizationException('You must be logged in to withdraw funds.');
        }

        // Check if the user has active investments
        if (!$user->hasInvested()) {
            throw new AuthorizationException('You must have at least one active investment to withdraw funds.');
        }

        // Check if 24 hours have passed since the last withdrawal
        // $lastWithdrawal = $user->withdrawals()->latest()->first();
        $lastWithdrawal = $user->withdrawals()->latest()->first();

        if ($lastWithdrawal && now()->diffInHours($lastWithdrawal->created_at) < 24) {
            return false;
        }

        return true;
    }
}
