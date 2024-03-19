<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Invest;
use Illuminate\Http\Request;

class InvestController extends Controller
{
    public function index()
    {
        $invests = Invest::paginate(10);
        return view('admin.invest.index', compact('invests'));
    }
}
