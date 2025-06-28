@extends('layouts.app')

@section('content')
<div class="p-4">
    <h2 class="text-2xl font-bold mb-4">Open Auctions</h2>
    @foreach($auctions as $auction)
        <div class="border p-4 mb-4 rounded">
            <h3 class="text-xl font-semibold">{{ $auction->book->title }}</h3>
            <p>{{ $auction->book->author }} ({{ $auction->book->year }})</p>
            <a href="{{ route('auctions.show', $auction->id) }}" class="text-blue-600">View & Bid</a>
        </div>
    @endforeach
</div>
@endsection
