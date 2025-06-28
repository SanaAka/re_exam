<?php

namespace App\Http\Controllers;

use App\Models\Bid;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BidController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'auction_id' => 'required|exists:auctions,id',
            'bid_amount' => 'required|numeric|min:1',
        ]);

        $highest = Bid::where('auction_id', $request->auction_id)->max('bid_amount');

        if ($request->bid_amount <= $highest) {
            return back()->withErrors(['bid_amount' => 'Your bid must be higher than the current highest bid ('. $highest .')']);
        }

        Bid::create([
            'auction_id' => $request->auction_id,
            'user_id' => Auth::id(),
            'bid_amount' => $request->bid_amount,
        ]);

        return back()->with('success', 'Your bid was placed successfully!');
    }
}
