<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Item;
use App\Models\Sale;
use App\Models\Supplier;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $data = [
            'item' => Item::count(),
            'supplier' => Supplier::count(),
            'customer' => Customer::count(),
            'user' => User::count(),
            'sale' => Sale::count()
        ];
        return view('pages.dashboard',[
            'title' => 'Dashboard',
            'data' => $data
        ]);
    }
}
