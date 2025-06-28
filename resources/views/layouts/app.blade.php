<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Book Auction Platform</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" />
</head>
<body class="bg-gray-100 min-h-screen flex flex-col">

    <nav class="bg-white shadow p-4 flex justify-between items-center">
        <a href="{{ url('/') }}" class="text-xl font-bold text-indigo-600">BookAuction</a>
        <div>
            <a href="{{ route('auctions.index') }}" class="mr-4 hover:text-indigo-500">Auctions</a>

            @auth
                @if(auth()->user()->role === 'admin')
                    <a href="{{ route('admin.auctions.index') }}" class="mr-4 hover:text-indigo-500">Admin Auctions</a>
                    <a href="{{ route('admin.auctions.create') }}" class="mr-4 hover:text-indigo-500">Start Auction</a>
                @endif
                <a href="{{ route('profile.edit') }}" class="mr-4 hover:text-indigo-500">Profile</a>
                <form action="{{ route('logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="text-red-600 hover:text-red-800">Logout</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="hover:text-indigo-500 mr-4">Login</a>
                <a href="{{ route('register') }}" class="hover:text-indigo-500">Register</a>
            @endauth
        </div>
    </nav>

    <main class="flex-grow container mx-auto p-4">
        @yield('content')
    </main>

    <footer class="bg-white text-center p-4 shadow">
        &copy; {{ date('Y') }} Book Auction Platform
    </footer>

</body>
</html>
