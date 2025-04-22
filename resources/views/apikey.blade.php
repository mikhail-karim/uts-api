{{-- <x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            API Key
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <p class="mb-4 text-gray-700">Here is your API Key:</p>

                <div class="flex items-center space-x-2">
                    <input
                        type="text"
                        value="{{ $apiKey }}"
                        readonly
                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring"
                        id="apiKeyInput"
                    />
                    <button
                        onclick="copyApiKey()"
                        class="px-4 py-2 text-white bg-blue-600 rounded hover:bg-blue-700"
                    >
                        Copy
                    </button>
                </div>

                <div class="mt-6">
                    <a
                        href="{{ route('movies.index') }}"
                        class="inline-block px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600"
                    >
                        Continue to Movie List
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script>
        function copyApiKey() {
            const input = document.getElementById('apiKeyInput');
            input.select();
            input.setSelectionRange(0, 99999);
            navigator.clipboard.writeText(input.value);
            alert('API Key copied to clipboard!');
        }
    </script>
</x-app-layout> --}}

{{-- @extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto mt-10 p-6 bg-white shadow rounded">
    <h1 class="text-2xl font-bold mb-4">Your API Key</h1>
    <div class="bg-gray-100 p-4 rounded text-sm font-mono break-all">
        {{ $apiKey }}
    </div>
    <a href="{{ route('dashboard') }}" class="mt-6 inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
        Continue to Dashboard
    </a>
</div>
@endsection --}}

{{-- resources/views/apikey.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Your API Key') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <p class="text-sm text-gray-700 mb-2">
                    This is your personal API key. Keep it secure and use it to authenticate your API requests.
                </p>
                <input
                    type="text"
                    id="apiKeyInput"
                    value="{{ $apiKey }}"
                    class="bg-gray-100 text-gray-800 p-4 rounded font-mono break-all text-sm w-full"
                    readonly
                >
                <button
                onclick="copyApiKey()"
                class="mt-6 px-4 py-2 text-black bg-blue-600 rounded hover:bg-blue-700"
                >
                Copy
                 </button>
                {{-- <a href="{{ route('dashboard') }}"
                   class="mt-6 inline-block bg-blue-600 hover:bg-blue-700 text-black font-semibold py-2 px-4 rounded">
                    Continue to Dashboard
                </a> --}}
            </div>
        </div>
    </div>
    <script>
        function copyApiKey() {
            const input = document.getElementById('apiKeyInput');
            input.select();
            input.setSelectionRange(0, 99999);
            navigator.clipboard.writeText(input.value);
            alert('API Key copied to clipboard!');
        }
    </script>
</x-app-layout>
