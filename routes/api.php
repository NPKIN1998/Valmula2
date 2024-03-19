<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('payhero', function(Request $request){

    // Check if the JSON parsing was successful
    Log::alert($request);

    Log::alert($request->response['Amount']);

    if (!empty($request->response['MpesaReceiptNumber'])) {
        // Register the trx
        Log::alert($request->response['ResultDesc']);
        // Update user balance
        $deposit_amount = $request->response['Amount'];
        $username = $request->response['ExternalReference'];
        $code = $request->response['MpesaReceiptNumber'];

        return DB::transaction(function () use ($username, $deposit_amount, $code) {
            // Get the user
            $user = DB::table('users')->where('username', $username)->first();
            if (!$user) {
                Log::error('User not found: ' . $username);
                return response(['error' => 'User not found'], 404);
            }

            // Update user balance
            DB::table('users')->where('id', $user->id)->increment('balance', $deposit_amount);

            // Check if trx exists
            $current_trx = DB::table('deposits')->where('transaction', $code)->count();

            if ($current_trx == 0) {
                DB::table('deposits')->insert([
                    'method' => 'Mpesa',
                    'transaction' => $code,
                    'user_id' => $user->id,
                    'amount' => $deposit_amount,
                    'status' => 'healthy',
                ]);
            }
        });
    }

    return response($request, 200);
});
// Route::post('payhero', function(Request $request){
//     // Check if the JSON parsing was successful
//      Log::alert($request);
     
//      Log::alert($request->response['Amount']);
     
//      if(!empty($request->response['MpesaReceiptNumber']))
//      {
//          //register the trx
//          Log::alert($request->response['ResultDesc']);
//          //update user balance
//          $deposit_amount = $request->response['Amount'];
//          $user = $request->response['ExternalReference'];
//          $code = $request->response['MpesaReceiptNumber'];
//          //get that user
//          $userdetails = DB::table('users')->where('username', $user)->first();
//          $user_Id = $userdetails->id;
//          //get user data
//           $userData = DB::table('account_balances')->where('user_id', $user_Id)->first();
         
//          $current_balance = $userData->balance;
//          $total_balance = $current_balance + $deposit_amount;
         
//          //check if trx exist
//          $current_trx = DB::table('deposits')->where('transaction', $code)->get()->count();
         
//          if($current_trx == 0)
//          {
         
//          //add balance
//          DB::table('account_balances')->where('user_id', $user_Id)->update(['balance' => $total_balance]);
         
//          DB::table('deposits')->insert([
//              'method' => 'Mpesa', 
//              'transaction'=>$code, 
//              'user_id'=>$user_Id, 
//              'amount'=>$deposit_amount,
//              'status' => 'healthy'
//              ]);
             
//          }
      
         
//      }
    
//     //get data
    
//     return response($request, 200);
// });

// Route::post('/payhero', function(Request $request){

//     // Check if the JSON parsing was successful
//     Log::alert($request);

//     Log::alert($request->response['Amount']);

//     if (!empty($request->response['MpesaReceiptNumber'])) {
//         // Register the trx
//         Log::alert($request->response['ResultDesc']);
//         // Update user balance
//         $deposit_amount = $request->response['Amount'];
//         $username = $request->response['ExternalReference'];
//         $code = $request->response['MpesaReceiptNumber'];

//         return DB::transaction(function () use ($username, $deposit_amount, $code) {
//             // Get the user
//             $user = DB::table('users')->where('username', $username)->first();
//             if (!$user) {
//                 Log::error('User not found: ' . $username);
//                 return response(['error' => 'User not found'], 404);
//             }

//             // Update user balance
//             DB::table('users')->where('id', $user->id)->increment('balance', $deposit_amount);

//             // Check if trx exists
//             $current_trx = DB::table('deposits')->where('transaction', $code)->count();

//             if ($current_trx == 0) {
//                 DB::table('deposits')->insert([
//                     'method' => 'Mpesa',
//                     'transaction' => $code,
//                     'user_id' => $user->id,
//                     'amount' => $deposit_amount,
//                     'status' => 'healthy',
//                 ]);
//             }

//             return response($request, 200);
//         });
//     }
// });
