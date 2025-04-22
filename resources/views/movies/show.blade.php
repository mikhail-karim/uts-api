{{-- <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ $movie->title }}
        </h2>
    </x-slot>

    <div class="py-12 max-w-4xl mx-auto">
        <div class="bg-white p-6 shadow rounded">
            @if($omdb)
                <img src="{{ $omdb['Poster'] }}" alt="Poster" class="w-40 mb-4">
                <p><strong>Year:</strong> {{ $omdb['Year'] }}</p>
                <p><strong>Genre:</strong> {{ $omdb['Genre'] }}</p>
            @endif
            <p><strong>Status:</strong> {{ $movie->status }}</p>
            <p><strong>Note:</strong> {{ $movie->note }}</p>
        </div>
    </div>
</x-app-layout> --}}

{{-- <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ $movie->title }} Details
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 rounded shadow">
                @if ($omdbData && $omdbData['poster'] !== 'N/A')
                    <img src="{{ $omdbData['poster'] }}" alt="Poster for {{ $movie->title }}" class="w-48 mb-4">
                @endif

                <p><strong>Title:</strong> {{ $movie->title }}</p>
                <p><strong>Status:</strong> {{ $movie->status }}</p>
                <p><strong>Note:</strong> {{ $movie->note }}</p>

                @if ($omdbData)
                    <p><strong>Year:</strong> {{ $omdbData['year'] }}</p>
                    <p><strong>Genre:</strong> {{ $omdbData['genre'] }}</p>
                @endif

                <div class="mt-6">
                    <a href="{{ route('movies.index') }}" class="text-blue-600 hover:underline">← Back to List</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> --}}

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ $movie->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                @if ($poster)
                    <img src="{{ $poster }}" alt="Movie Poster" class="mb-4 max-w-xs">
                @endif

                <p><strong>Title:</strong> {{ $movie->title }}</p>
                <p><strong>Status:</strong> {{ $movie->status }}</p>
                <p><strong>Note:</strong> {{ $movie->note }}</p>
                @if ($year)
                    <p><strong>Year:</strong> {{ $year }}</p>
                @endif
                @if ($genre)
                    <p><strong>Genre:</strong> {{ $genre }}</p>
                @endif

                <div class="mt-6 flex gap-4">
                    <a href="{{ route('movies.index') }}"
                        class="inline-block px-4 py-2 rounded text-white bg-gray-700 hover:bg-gray-600 border border-gray-500 dark:text-white dark:bg-gray-800 dark:hover:bg-gray-700">
                        Back to list
                    </a>
                
                    <a href="{{ route('movies.edit', $movie->id) }}"
                        class="inline-block px-4 py-2 rounded  text-white bg-gray-700 hover:bg-gray-600 border border-gray-500 dark:text-white dark:bg-gray-800 dark:hover:bg-gray-700">
                        Edit Movie
                    </a>
                    <form method="POST" action="{{ route('movies.destroy', $movie->id) }}" onsubmit="return confirm('Are you sure?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">
                            Delete
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

