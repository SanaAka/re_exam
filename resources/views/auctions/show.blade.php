@extends('layouts.app')

@section('content')
<div class="p-4 max-w-2xl mx-auto">
    <h2 class="text-2xl font-bold">{{ $auction->book->title }}</h2>
    <p>Author: {{ $auction->book->author }}</p>
    <p>Ends at: {{ $auction->end_time }}</p>

    <hr class="my-4" />

    <h3 class="text-lg font-semibold">Place a Bid</h3>

    @auth
        @if(session('success'))
            <div class="bg-green-200 text-green-800 p-2 rounded mb-4">{{ session('success') }}</div>
        @endif

        @if($errors->any())
            <div class="bg-red-200 text-red-800 p-2 rounded mb-4">
                <ul class="list-disc ml-5">
                    @foreach($errors->all() as $e)
                        <li>{{ $e }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('bids.store') }}" method="POST" class="mb-4">
            @csrf
            <input type="hidden" name="auction_id" value="{{ $auction->id }}">
            <input type="number" name="bid_amount" step="0.01" min="1" class="border p-2 rounded w-full mb-2" placeholder="Enter your bid">
            <button class="bg-blue-600 text-white px-4 py-2 rounded">Submit Bid</button>
        </form>
    @else
        <p class="text-red-500">You must <a href="{{ route('login') }}" class="text-blue-600 underline">login</a> to bid.</p>
    @endauth

    <h3 class="text-lg font-semibold mt-6">Bids</h3>
    <ul class="space-y-2">
        @foreach($auction->bids->sortByDesc('bid_amount') as $bid)
            <li>{{ $bid->user->name }} - ${{ number_format($bid->bid_amount, 2) }}</li>
        @endforeach
    </ul>
</div>
@endsection
