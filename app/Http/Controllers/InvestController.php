<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Order;
use App\Models\Invest;
use App\Models\Referral;
use Illuminate\Http\Request;
use App\Services\InvestService;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class InvestController extends Controller
{

    protected $investService;

    public function __construct(InvestService $investService)
    {
        $this->investService = $investService;
    }

    public function index()
    {
        // Retrieve investments related to the authenticated user
        $invests = Auth::user()->invests()->latest()->paginate(5);
        $orders = Order::all();
        return view('user.invest', compact(['orders', 'invests']));
    }
    public function store(Request $request)
    {
        // dd($request);;
        $user = Auth::user();
        $capital = floatval($request->input('capital'));
        $order_id = $request->input('order_id');

        $order = Order::findOrFail($order_id);
        // Retrieve user's current balance
        $userBalance = $user->balance;

        // Check if user's balance is sufficient for the investment
        if ($userBalance < $capital) {
            $message = 'Insufficient balance. Your current balance is Ksh ' . $userBalance . '. Please deposit more funds.';
            return redirect()->route('invest')->with('error', $message);
        }

        // Validate capital
        if ($capital < 800) {
            $message = 'Your capital is Ksh ' . $capital . '. Add Ksh ' . (1000 - $capital) . ' to continue investing.';
            return redirect()->route('invest')->with('error', $message);
        }

        try {
            // Use Dependency Injection for the InvestService instead of a direct property
            // $investment = $this->investService->createInvestment($user, $capital, new Invest(), new Referral(), $order);
            $investment = $this->investService->createInvestment($user, $capital, $order);
            // dd($investment);
            // Log or handle success of the investment
            // Add developer comment if necessary
            // ...

            return back()->with(['success' => 'Investment successful. Phone: ' . $user->phone . ', Capital invested: Ksh ' . $capital]);
        } catch (\Exception $e) {
            // Log the exception with detailed information
            Log::error('Error creating investment: ' . $e->getMessage(), ['exception' => $e]);

            // Return an error response with a more user-friendly message
            return back()->with(['error' => 'An error occurred while processing the investment. Please try again.'], 500);
        }
    }

    // public function store(Request $request)
    // {
    //     $user = Auth::user();
    //     $capital = floatval($request->input('capital'));

    //     // Validate capital
    //     if ($capital < 1000) {
    //         $message = 'Your capital is Ksh ' . $capital . '. Add Ksh ' . (1000 - $capital) . ' to continue investing.';
    //         return redirect()->route('invest')->with('message', $message);
    //     }

    //     try {
    //         // Use Dependency Injection for the InvestService instead of a direct property
    //         $investment = $this->investService->createInvestment($user, $capital, new Invest(), new Referral());

    //         // Check if 24 hours have passed since the last update
    //         $lastUpdateTimestamp = $investment->updated_at;
    //         if ($this->is24HoursPassed($lastUpdateTimestamp)) {
    //             // Update user balance
    //             $newBalance = $user->balance + $investment->daily_income;
    //             $user->update(['balance' => $newBalance]);

    //             // Update investment record
    //             $investment->update([
    //                 'daily_income' => 0, // Set daily income to 0 after adding to balance
    //                 'updated_at' => now(), // Update the timestamp to the current time
    //             ]);

    //             // Notify the user about the update
    //             $this->notifyUser($user, 'Your investment has earned ' . $investment->daily_income . ' and has been added to your balance.');

    //             // Log or handle success of the update
    //             Log::info('User balance and investment updated successfully for user ' . $user->id);
    //         }

    //         return  back()->with(['success' => 'Investment successful']);
    //     } catch (\Exception $e) {
    //         // Log the exception with detailed information
    //         Log::error('Error creating investment: ' . $e->getMessage(), ['exception' => $e]);

    //         // Return an error response with a more user-friendly message
    //         return  back()->with(['error' => 'An error occurred while processing the investment. Please try again.'], 500);
    //     }
    // }

    // // Function to check if 24 hours have passed since the last update
    // private function is24HoursPassed($lastUpdateTimestamp)
    // {
    //     $currentTimestamp = Carbon::now();
    //     $timeDifference = $currentTimestamp->diffInHours($lastUpdateTimestamp);

    //     return $timeDifference >= 24;
    // }
}
