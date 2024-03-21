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
        $rate = $this->rate($order);
        $days = $this->calculateInvestmentDays($order);
        $dailyIncome = $capital * $rate;
        // dd($dailyIncome, $days);
       
        return DB::transaction(function () use ($user, $capital, $rate, $days, $dailyIncome, $order) {
            $return = $dailyIncome * $days;
            // dd($return);
            // Create invest record
            $investment = Invest::create([
                'user_id' => $user->id,
                'order_id' => $order->id,
                'capital' => $capital,
                'returns' => $return,
                'daily_income' => $dailyIncome,
                'rate' => $rate,
                'days' => $days,
                'start_date' => now(),
                'end_date' => now()->addDays($days),
                'status' => 'active',
            ]);

            // dd($investment);

            // Update user balance after investment is created
            $user->balance -= $capital; // Subtract the capital from the user's balance
            $user->status = 'active'; // Set the status to 'active'
            $user->save(); // Save the changes to the user model
            
         
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
    private function calculateInvestmentDays(Order $order)
    {
        // Logic to calculate days from the order table
        return $order->days; // Default to 9 days if not specified in the order
    }

    private function rate(Order $order)
    {
        // Logic to calculate days from the order table
        return $order->rate; // Default to 9 days if not specified in the order
    }
}
