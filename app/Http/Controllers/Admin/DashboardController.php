<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CartItem;
use App\Models\Product;
use App\Models\User;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $totalProducts = Product::count();
        $totalUsers = User::where('role', 'user')->count();
        $totalCartItems = CartItem::count();
        
        $totalRevenue = CartItem::with('product')
            ->get()
            ->sum(function ($item) {
                return $item->quantity * $item->product->price;
            });

        return view('admin.dashboard', compact(
            'totalProducts',
            'totalUsers',
            'totalCartItems',
            'totalRevenue'
        ));
    }
}
