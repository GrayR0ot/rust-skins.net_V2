<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\ProductComment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class ProductController extends Controller
{
    public function index() {
        $products = Product::all();
        return Inertia::render('Product/Products', [
            'products' => $products,
        ]);
    }

    public function show($id) {
        $product = Product::where('id', $id)->with('comments')->first();
        $comments = ProductComment::where('product_id', $id)->with('user')->get();
        return Inertia::render('Product/Product', [
            'product' => $product,
            'comments' => $comments,
        ]);
    }

    public function buy($id) {
        $product = Product::where('id', $id)->with('comments')->first();
        $comments = ProductComment::where('product_id', $id)->with('user')->get();
        return Inertia::render('Product/Buy', [
            'product' => $product,
            'comments' => $comments,
        ]);
    }

    public function newProduct() {
        return Inertia::render('Product/NewProduct');
    }

    public function create(Request $request) {
        Product::create($request->all());
        return Redirect::route('products.index');
    }

    public function comment(Request $request) {
        ProductComment::create($request->all());
        return \redirect('/product/' . $request->input('product_id'));
    }
}
