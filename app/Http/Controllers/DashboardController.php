<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductStock;
use App\Models\ReturnProduct;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index() {
        $productsCount = Product::count();
        $usersCount = User::count();
        $stocksInCount = ProductStock::where('status', ProductStock::STOCK_IN)->count();
        $returnsCount = ReturnProduct::count();
        $recentProducts = Product::latest()->limit(10)->get();
        return view('dashboard', compact('productsCount', 'usersCount', 'stocksInCount', 'returnsCount', 'recentProducts'));
    }
}
