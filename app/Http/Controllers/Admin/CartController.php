<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CartItem;
use Illuminate\View\View;

class CartController extends Controller
{
    public function index(): View
    {
        $cartItems = CartItem::with(['user', 'product'])
            ->latest()
            ->paginate(15);

        return view('admin.carts.index', compact('cartItems'));
    }
}
