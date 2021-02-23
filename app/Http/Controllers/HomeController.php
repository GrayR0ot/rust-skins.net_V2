<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function index() {
        $products = Product::withCount('orders')->withCount('pending_orders')->withCount('likes')->withCount('comments')->get();
        return Inertia::render('Home', [
            'products' => $products,
        ]);
    }
}
