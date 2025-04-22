{{-- <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('My Movie Watchlist') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-between items-center mb-4">
                <a href="{{ route('apikey.show') }}" class="text-blue-600 hover:underline">View API Key</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="text-red-600 hover:underline">Logout</button>
                </form>
            </div>

            <a href="{{ route('movies.create') }}" class="mb-6 inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">+ Add Movie</a>

            <!-- Example movie list -->
            @foreach ($movies as $movie)
                <div class="bg-white shadow p-4 mb-4 rounded flex items-center justify-between">
                    <div class="flex items-center">
                        @if ($movie->poster_url)
                            <img src="{{ $movie->poster_url }}" class="w-16 h-24 object-cover mr-4 rounded" alt="{{ $movie->title }}">
                        @endif
                        <div>
                            <h3 class="text-lg font-bold">{{ $movie->title }}</h3>
                            <p class="text-sm text-gray-500">Status: {{ ucfirst($movie->status) }}</p>
                        </div>
                    </div>
                    <a href="{{ route('movies.show', $movie->id) }}" class="text-blue-600 hover:underline">View</a>
                </div>
            @endforeach
        </div>
    </div>

    <footer class="bg-gray-100 text-center py-4 text-sm text-gray-600 fixed bottom-0 w-full">
        &copy; {{ date('Y') }} Movie Watchlist App
    </footer>
</x-app-layout> --}}

<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('My Watchlist') }}
            </h2>
            <a href="{{ route('movies.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
                + Add Movie
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                @forelse ($movies as $movie)
                    <div class="border-b pb-4 mb-4">
                        <h3 class="text-lg font-bold">{{ $movie->title }}</h3>
                        <p>Status: {{ $movie->status }}</p>
                        <p>{{ $movie->note }}</p>
                        <a href="{{ route('movies.show', $movie->id) }}"
                           class="inline-block mt-2 text-blue-600 hover:underline">
                            View Details →
                        </a>
                    </div>
                @empty
                    <p>You haven't added any movies yet.</p>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>


