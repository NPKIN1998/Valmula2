<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\OrderFormRequest;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::paginate(10);
        return view('admin.order.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.order.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(OrderFormRequest $request)
    {
        // dd($request);
        // Retrieve the validated data from the request
        $validatedData = $request->validated();
        
        // dd($validatedData);
        
        // Calculate the daily_income as a percentage of the return
        $dailyIncome = $validatedData['amount'] * ($validatedData['rate'] / 100);
        // Calculate the return
        $return =  $dailyIncome * $validatedData['days'];

        // Create a new Order instance with fillable fields
        $order = Order::create([
            'amount' => $validatedData['amount'],
            'rate' => $validatedData['rate'],
            'return' => $return,
            'daily_income' => $dailyIncome,
            'days' => $validatedData['days'],
        ]);
        // dd($order);
          // Redirect to the order.index route after successful creation
          return redirect()->route('order.create')->with('success', 'Order created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }
}
