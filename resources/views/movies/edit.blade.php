<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Movie') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <form method="POST" action="{{ route('movies.update', $movie->id) }}">
                    @csrf
                    @method('PUT')

                    {{-- <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Title</label>
                        <input name="title" value="{{ old('title', $movie->title) }}"
                            class="mt-1 block w-full rounded-md dark:bg-gray-800 dark:text-white" required>
                    </div> --}}

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Status</label>
                        <select name="status"
                                class="mt-1 block w-full rounded-md dark:bg-gray-800 dark:text-white" required>
                            <option value="Watched" {{ $movie->status === 'Watched' ? 'selected' : '' }}>Watched</option>
                            <option value="To Watch" {{ $movie->status === 'To Watch' ? 'selected' : '' }}>To Watch</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Note</label>
                        <textarea name="note"
                                  class="mt-1 block w-full rounded-md dark:bg-gray-800 dark:text-white">{{ old('note', $movie->note) }}</textarea>
                    </div>

                    {{-- <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">IMDb ID</label>
                        <input name="imdb_id" value="{{ old('imdb_id', $movie->imdb_id) }}"
                            class="mt-1 block w-full rounded-md dark:bg-gray-800 dark:text-white">
                    </div> --}}

                    <div class="mt-6 flex gap-4">
                        <button type="submit"
                                class=" text-black bg-gray-700 hover:bg-gray-600">
                            Update Movie
                        </button>
                        <a href="{{ route('movies.index') }}"
                           class=" px-4 py-2 rounded text-white bg-gray-500 hover:bg-gray-600">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
