<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <form method="POST" action="{{ route('tea.store') }}">
                @csrf
                <label for="message">Tea Type: </label>
                <input type="text" name="message" id="message" />
                <input type="number" min="1" max="10" name="rating"/>
                <x-input-error :messages="$errors->get('message')" class="mt-2" />
                <x-primary-button class="mt-4">{{ __('Log') }}</x-primary-button>
            </form>

            <div class="mt-6 bg-white shadow-sm rounded-lg divide-y">
                <p>Total teas logged: {{$teaCount}}</p>
                <p>Total teas you have logged: {{$user->teaUserCount()}}</p>
                @foreach ($teas as $tea)
                    <div class="p-6 flex space-x-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-600 -scale-x-100" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                        </svg>
                        <div class="flex-1">
                            <div class="flex justify-between items-center">
                                <div>
                                    <span class="text-gray-800">{{ $tea->user->name }}</span>
                                    <small class="ml-2 text-sm text-gray-600">Time tea was logged: {{ $tea->created_at->format('j M Y, g:i a') }}</small>
                                    <p>Tea Rating: {{ $tea->rating }}</p>
                                </div>
                            </div>
                            <p class="mt-4 text-lg text-gray-900">{{ $tea->message }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
