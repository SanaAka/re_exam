@foreach($auctions as $auction)
    <div class="border p-4 mb-4 rounded">
        <h3>{{ $auction->book->title }}</h3>
        <p>Status: {{ ucfirst($auction->status) }}</p>
        @if($auction->status == 'open')
            <form action="{{ route('admin.auctions.close', $auction) }}" method="POST">
                @csrf
                <button type="submit" class="bg-red-600 text-white px-3 py-1 rounded">Close Auction</button>
            </form>
        @else
            <p>Winner: {{ $auction->winner->name ?? 'N/A' }}</p>
        @endif
    </div>
@endforeach
