<?php

namespace App\Console\Commands;

use App\Models\Invest;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class UpdateUserBalances extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-user-balances';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        try {
            // Query matured investments
            $expiredInvestments = Invest::where('status', 'active')
                ->where('end_date', '<', Carbon::now()->subHours(24))
                ->get();

            Log::info("Number of matured investments: " . $expiredInvestments->count());

            foreach ($expiredInvestments as $investment) {
                Log::info("Processing investment ID: {$investment->id}");

                $user = User::find($investment->user_id);

                if (!$user) {
                    Log::error("User with ID {$investment->user_id} not found. Skipping investment.");
                    continue;
                }

                // Calculate daily income
                $dailyIncome = $investment->capital * $investment->rate / 100;

                // Update user balance
                $user->balance += $dailyIncome;
                $user->save();

                // Update investment status
                if ($investment->days <= Carbon::now()->diffInDays($investment->start_date)) {
                    $investment->status = 'completed';
                    $investment->save();
                    Log::info("Investment ID {$investment->id} marked as completed.");
                }

                Log::info("Updated balance for user {$user->name}: {$dailyIncome} added.");
            }

            $this->info('Successfully updated user balances.');
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            Log::error("User retrieval error: " . $e->getMessage());
            $this->error('An error occurred while retrieving a user. Please check the logs for details.');
            return 1;
        } catch (\Exception $e) {
            Log::error("Error updating user balances: " . $e->getMessage());
            $this->error('An error occurred. Please check the logs for details.');
            return 1;
        }

        return 0;
    }

    // public function handle()
    // {
    //     try {
    //         // Query matured investments
    //         $expiredInvestments = Invest::where('status', 'active')
    //             ->where('end_date', '<', Carbon::now()->subHours(24))
    //             ->get();

    //         // dd($expiredInvestments);

    //         foreach ($expiredInvestments as $investment) {
    //             $user = User::find($investment->user_id);

    //             if (!$user) {
    //                 Log::error("User with ID {$investment->user_id} not found. Skipping investment.");
    //                 continue;
    //             }

    //             // Calculate daily income
    //             $dailyIncome = $investment->capital * $investment->rate / 100;

    //             // Update user balance
    //             $user->balance += $dailyIncome;
    //             $user->save();

    //             // Update investment status
    //             if ($investment->days <= Carbon::now()->diffInDays($investment->start_date)) {
    //                 $investment->status = 'completed';
    //                 $investment->save();
    //             }

    //             Log::info("Updated balance for user {$user->name}: {$dailyIncome} added.");
    //         }

    //         $this->info('Successfully updated user balances.');
    //     } catch (\Exception $e) {
    //         Log::error("Error updating user balances: " . $e->getMessage());
    //         $this->error('An error occurred. Please check the logs for details.');
    //         return 1;
    //     }

    //     return 0;
    // }
    // public function handle()
    // {
    //     // Get investments that are completed and need to be processed
    //     $completedInvestments = Invest::where('status', 'completed')
    //         ->where('end_date', '<=', Carbon::now()->subDays(1)) // Check if the investment has started
    //         ->get();

    //     foreach ($completedInvestments as $investment) {
    //         // Check if the investment has not been processed before to avoid double payment
    //         if (!$investment->processed) {
    //             // Calculate the number of days the investment ran
    //             $investmentDays = Carbon::parse($investment->start_date)->diffInDays(Carbon::now());

    //             // Check if the investment has run for the specified number of days
    //             if ($investmentDays >= $investment->days) {
    //                 // Update user balance
    //                 $user = User::find($investment->user_id);
    //                 $user->balance += $investment->amount + $investment->daily_income;
    //                 $user->save();

    //                 // Mark the investment as processed
    //                 $investment->processed = true;
    //                 $investment->save();

    //                 $this->info("User balance updated for user ID {$user->id}");
    //             }
    //         }
    //     }

    //     $this->info('User balances updated successfully.');
    // }
}
