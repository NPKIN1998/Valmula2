<?php

namespace App\Services;

use App\Models\User;
use App\Models\Order;
use App\Models\Invest;
use App\Models\Referral;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class InvestService
{
    public function createInvestment(User $user, $capital, Order $order)
    {
        // Calculate values based on investment details
        $rate = 0.20;
        $days = 9;
        $dailyIncome = $capital * $rate;

        return DB::transaction(function () use ($user, $capital, $rate, $days, $dailyIncome, $order) {
            // Create invest record
            $investment = Invest::create([
                'user_id' => $user->id,
                'order_id' => $order->id,
                'capital' => $capital,
                'returns' => $capital * (1 + $rate),
                'daily_income' => $dailyIncome,
                'rate' => $rate,
                'days' => $days,
                'start_date' => now(),
                'end_date' => now()->addDays($days),
                'status' => 'active',
            ]);

            // Update user balance after investment is created
            $user->balance -= $capital;
            $user->save();

            // Check if the user has a referral
            if ($user->referral_id) {
                // Find the referring user
                $referringUser = User::find($user->referral_id);

                // Check if the referring user is found
                if ($referringUser) {
                    // Calculate referral bonus
                    $referralBonus = 0.05 * $capital;

                    // Create or update referral record for the referring user
                    Referral::updateOrCreate(
                        ['user_id' => $referringUser->id],
                        ['referral_bonus' => DB::raw("COALESCE(referral_bonus, 0) + $referralBonus")]
                    );

                    // Log or handle success of referral bonus update
                    Log::info('Referral bonus updated successfully for user ' . $referringUser->id);
                } else {
                    // Log or handle the case where the referring user is not found
                    Log::warning('Referring user not found for user ' . $user->id . ' with referral_id ' . $user->referral_id);
                }
            } else {
                // Log or handle the case where the user has no referral
                Log::info('User ' . $user->id . ' has no referral.');
            }


            return $investment;
        });
    }
}
