<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Auction;
use Illuminate\Http\Request;
use App\Models\Bid;
class AuctionController extends Controller
{
    public function create()
    {
        $books = Book::doesntHave('auction')->get(); // books not already auctioned
        return view('admin.auctions.create', compact('books'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'book_id' => 'required|exists:books,id',
            'start_time' => 'required|date',
            'end_time' => 'required|date|after:start_time',
        ]);

        Auction::create([
            'book_id' => $request->book_id,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'status' => 'open',
        ]);

        return redirect()->route('admin.auctions.create')->with('success', 'Auction started successfully!');
    }

    public function close(Auction $auction)
{
    // Only allow closing if auction is still open
    if ($auction->status === 'closed') {
        return redirect()->back()->with('error', 'Auction is already closed.');
    }

    // Get highest bid
    $highestBid = Bid::where('auction_id', $auction->id)
        ->orderByDesc('bid_amount')
        ->first();

    if (!$highestBid) {
        return redirect()->back()->with('error', 'No bids found, cannot close auction.');
    }

    // Update auction status and winner
    $auction->status = 'closed';
    $auction->winner_id = $highestBid->user_id;
    $auction->save();

    return redirect()->back()->with('success', 'Auction closed successfully! Winner assigned.');
}
public function adminIndex()
{
    $auctions = Auction::with('book', 'winner')->orderByDesc('created_at')->get();
    return view('admin.auctions.index', compact('auctions'));
}

}
