<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StockController extends Controller
{
    public function purchases()
    {
        return view('admin.stock.purchases');
    }

    public function distribution()
    {
        return view('admin.stock.distribution');
    }

    public function agentSales()
    {
        return view('admin.stock.agent-sales');
    }
}
