<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Wishlist;
use App\Models\Wallet;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $category = $request->query('category');
        $products = $category ? Product::where('category', $category)->get() : Product::all();
        return view('product.index', compact('products'));
    }

    public function buy(Request $request)
    {
        $request->validate([
            'user_name' => 'required|string|max:255',
            'product_id' => 'required|integer|exists:products,id',
        ]);

        $wallet = Wallet::where('user_name', $request->user_name)->first();
        if (!$wallet) {
            return redirect()->route('product.index')->with('error', 'User not found.');
        }

        $product = Product::find($request->product_id);
        if ($product->stock <= 0) {
            return redirect()->route('product.index')->with('error', 'Product out of stock.');
        }

        $price = $product->is_discounted ? $product->price * (1 - $product->discount_percentage / 100) : $product->price;
        if ($wallet->balance < $price) {
            return redirect()->route('product.index')->with('error', 'Insufficient balance.');
        }

        $wallet->balance -= $price;
        $wallet->save();

        $product->stock -= 1;
        $product->save();

        return redirect()->route('product.index')->with('success', 'Product purchased successfully.');
    }

    public function wishlist(Request $request)
    {
        $request->validate([
            'user_name' => 'required|string|max:255',
            'product_id' => 'required|integer|exists:products,id',
        ]);

        Wishlist::create(['user_name' => $request->user_name, 'product_id' => $request->product_id]);

        return redirect()->route('product.index')->with('success', 'Product added to wishlist.');
    }

    /**
     */
    public function __construct() {
    }
}