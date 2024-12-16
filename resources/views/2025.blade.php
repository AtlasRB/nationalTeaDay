<x-app-layout>
    <div class="py-12 bg-no-repeat bg-cover min-h-screen text-md md:text-xl" style="background-image: url('{{ asset('images/teaBackground2.webp') }}');  background-position: bottom right;">
        <div class="max-w-7xl mx-[5%] sm:mx-auto sm:px-6 lg:px-8">
            <h1><b>NATIONAL TEA DRINKING YEAR 1</b></h1>

            <form method="POST" action="{{ route('2025.store') }}" class="bg-zinc-900/[.2] flex flex-col sm:flex-row items-start gap-1 sm:items-center justify-evenly">
                @csrf
                <div>
                    <label for="message">Tea Type: </label>
                    <input type="text" name="message" id="message" />
                </div>
                <div>
                    <label for="rating">Tea Rating: </label>
                    <input type="number" min="1" max="10" name="rating"/>
                </div>
                <x-input-error :messages="$errors->get('message')" class="mt-2" />
                <x-primary-button class="my-4">{{ __('Log') }}</x-primary-button>
            </form>

            <div class="mt-6">
                <p>Total teas logged: {{$teaCount}}</p>
                <p>Total teas you have logged: {{$userCount}}</p>
                <div class="mt-4 flex flex-col sm:flex-row gap-2">
                    <a href="{{ route('2025') }}" class="px-4 py-2 bg-blue-400 rounded max-w-[40%] text-center">Show All Teas</a>
                    <a href="{{ route('2025.filteredC') }}" class="px-4 py-2 bg-green-400 rounded max-w-[40%] text-center">Show Filtered Connor Teas</a>
                    <a href="{{ route('2025.filteredH') }}" class="px-4 py-2 bg-green-400 rounded max-w-[40%] text-center">Show Filtered Henry Teas</a>
                </div>
                <div>
                    <table class="my-8 w-full min-w-[50%] text-center bg-zinc-900/[.2] rounded">
                        <thead class="border-collapse border border-slate-500">
                        <tr>
                            <th>Name</th>
                            <th>Tea type</th>
                            <th>Rating</th>
                            <th>Logged Time</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($teas as $tea)
                            <tr>
                                <td class="py-2">{{ $tea->user->name }}</td>
                                <td>{{ $tea->message }}</td>
                                <td>{{ $tea->rating }}</td>
                                <td>{{ $tea->created_at->format('j M Y, g:i a') }}</td>
                                @if ($tea->user_id === auth()->id())
                                    <td class=" w-full max-w-[10%]">
                                        <form method="POST" action="{{ route('2025.destroy', $tea->id) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button class="px-2 py-1 bg-red-400 rounded" type="submit" onclick="return confirm('Are you sure you want to delete this log?');">
                                                Delete
                                            </button>
                                        </form>
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <section id="statistics" class="bg-zinc-900/[.2] w-fit">
                <h2><b>Statistics</b></h2>
                <p>Total tea average rating: {{$totalAverage}}</p>
                <p>Your total tea average rating: {{$userAverage}}</p>
            </section>
        </div>
    </div>
</x-app-layout>
