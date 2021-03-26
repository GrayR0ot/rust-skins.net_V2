<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use LaravelDaily\Invoices\Classes\Buyer;
use LaravelDaily\Invoices\Classes\InvoiceItem;
use LaravelDaily\Invoices\Invoice;

class OrderController extends Controller
{
    public function index() {
        $orders = Order::with('user')->get();
        return Inertia::render('Order/Orders', [
            'orders' => $orders,
        ]);
    }

    public function show($id) {
        $order = Order::where('id', $id)->with('user')->first();
        return Inertia::render('Order/Order', [
            'order' => $order,
        ]);
    }

    public function update(Request $request) {
        $order = Order::find($request->input('orderId'));
        $order->status = $request->input("status");
        $order->save();
        return $order->status;
    }

    public function buy(Request $request) {
        if(Auth::user()) {
            if(isset(Auth::user()->email_verified_at)) {
                $product = Product::find($request->input('productId'));
                $order = new Order();
                $order->user_id = Auth::user()->id;
                $order->product_id = $product->id;
                $order->price = $product->price * ($product->discount / 100);
                $order->status = 1;
                $order->save();
                return $order->id;
            } else {
                return -2;
            }
        } else {
            return -1;
        }
    }

    public function delete(Request $request) {
        $order = Order::find($request->input('orderId'));
        $order->delete();
    }

    public function invoice($id) {
        $order = Order::where('id', $id)->with('user')->with('product')->first();
        $customer = new Buyer([
            'name' => $order->user->name,
            'email' => $order->user->email,
        ]);
        $product = (new InvoiceItem())->title($order->product->name)->pricePerUnit($order->product->price)->discountByPercent($order->product->discount);
        $invoice = Invoice::make()->series('EU')->sequence($order->id)->buyer($customer)->taxRate(20)->addItem($product)->filename($order->user->name . "_" . $order->id)->logo("https://dev.grayroot.eu/logo.png");
        return $invoice->stream();
    }
}
