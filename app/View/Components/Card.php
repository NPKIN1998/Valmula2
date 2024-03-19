<?php

namespace App\View\Components;

use Closure;
use App\Models\Order;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class Card extends Component
{
    public $order;
    /**
     * Create a new component instance.
     */
    public function __construct($order)
    {
        $this->order = $order;
    }
    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        // $orders = Order::all();compact('orders')
        return view('components.card');
    }
}
