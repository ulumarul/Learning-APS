<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Wallet;

class WalletController extends Controller
{
    public function index()
    {
        $wallets = Wallet::all();
        return view('wallet.index', compact('wallets'));
    }

    public function topup(Request $request)
    {
        $request->validate([
            'user_name' => 'required|string|max:255',
            'amount' => 'required|numeric|min:1',
        ]);

        $wallet = Wallet::firstOrCreate(['user_name' => $request->user_name]);
        $wallet->balance += $request->amount;
        $wallet->save();

        return redirect()->route('wallet.index')->with('success', 'Top-up successful');
    }
}
