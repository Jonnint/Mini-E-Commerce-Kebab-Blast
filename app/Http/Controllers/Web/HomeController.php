<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $products = Product::all();
        return view('home', compact('products'));
    }

    public function show(Product $product): View
    {
        return view('product-detail', compact('product'));
    }
}
