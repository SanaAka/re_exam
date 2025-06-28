@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto p-4">
    <h2 class="text-2xl font-bold mb-4">Start New Auction</h2>

    @if(session('success'))
        <div class="bg-green-200 text-green-800 p-2 rounded mb-4">{{ session('success') }}</div>
    @endif

    <form action="{{ route('admin.auctions.store') }}" method="POST">
        @csrf

        <div class="mb-4">
            <label for="book_id" class="block font-medium">Select Book</label>
            <select name="book_id" id="book_id" class="w-full border p-2 rounded" required>
                <option value="">-- Select --</option>
                @foreach($books as $book)
                    <option value="{{ $book->id }}">{{ $book->title }} by {{ $book->author }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label for="start_time" class="block font-medium">Start Time</label>
            <input type="datetime-local" name="start_time" class="w-full border p-2 rounded" required>
        </div>

        <div class="mb-4">
            <label for="end_time" class="block font-medium">End Time</label>
            <input type="datetime-local" name="end_time" class="w-full border p-2 rounded" required>
        </div>

        <button class="bg-blue-600 text-white px-4 py-2 rounded">Start Auction</button>
    </form>
</div>
@endsection
