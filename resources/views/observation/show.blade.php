<x-layouts.main>
    <div class="flex justify-center items-center text-pink-500">
        <div class="w-full h-screen mr-5">
            <div class="p-3">
                <p>{{$observation->name}}</p>
                <p>{{$observation->description}}</p>
                <form method="POST" action="{{ route('admin.observation.update', $observation) }}" class="mt-2 p-4 space-y-2 border-dashed border-2 border-cyan-500">
                    @method('patch')
                    @csrf
                    <div class="space-y-1">
                        <label for="name" class="text-cyan-500">{{ __('Name:') }}</label>
                        <input type="text" name="name" value="{{ old('name', $observation->name) }}" required autofocus
                               class="w-full p-2 transition duration-150 ease-in-out border bg-pink-50 border-gray-300 rounded-md appearance-none focus:outline-none focus:shadow-outline focus:border-cyan-400" />
                    </div>
                    <div class="space-y-1">
                        <label for=description class="text-cyan-500">{{ __('Description:') }}</label>
                        <input type="text" name="description" value="{{ old('description', $observation->description) }}" autofocus
                               class="w-full p-2 transition duration-150 ease-in-out border bg-pink-50 border-gray-300 rounded-md appearance-none focus:outline-none focus:shadow-outline focus:border-cyan-400" />
                    </div>
                    <div class="space-y-1 flex">
                        <div>
                            <label for=started_at class="text-cyan-500">{{ __('Started:') }}</label><br>
                            <input type="date" name="started_at" value="{{ old('started_at', $observation->started_at ? \Carbon\Carbon::parse($observation->started_at)->format('Y-m-d') : '') }}" autofocus
                               class="p-2 transition duration-150 ease-in-out border bg-pink-50 border-gray-300 rounded-md appearance-none focus:outline-none focus:shadow-outline focus:border-cyan-400" />
                        </div>
                        <div class="ml-5">
                            <label for=ended_at class="text-cyan-500">{{ __('Ended:') }}</label><br>
                            <input type="date" name="ended_at" value="{{ old('ended_at', $observation->ended_at ? \Carbon\Carbon::parse($observation->ended_at)->format('Y-m-d') : '') }}" autofocus
                               class="p-2 transition duration-150 ease-in-out border bg-pink-50 border-gray-300 rounded-md appearance-none focus:outline-none focus:shadow-outline focus:border-cyan-400" />

                        </div>
                    </div>
                    <div class="space-y-1">
                        <label for=active class="text-cyan-500">{{ __('Active:') }}</label>
                        <input type="checkbox" name="active" value="1" {{ old('active', $observation->active) ? 'checked' : '' }} required autofocus
                               class="accent-pink-500 p-2 transition duration-150 ease-in-out border bg-pink-50 border-gray-300 rounded-md focus:outline-none focus:shadow-outline focus:border-cyan-400" />
                    </div>
                    <div class="space-y-1">
                        <label for=default class="text-cyan-500">{{ __('Default Selected:') }}</label>
                        <input type="checkbox" name="default" value="1" {{ old('default', $observation->default) ? 'checked' : '' }} required autofocus
                               class="accent-pink-500 p-2 transition duration-150 ease-in-out border bg-pink-50 border-gray-300 rounded-md focus:outline-none focus:shadow-outline focus:border-cyan-400" />
                    </div>
                    <button type="submit"
                            class="flex justify-center w-1/4 py-2 text-white transition duration-300 ease-in-out bg-pink-400 border border-pink-400 rounded-md hover:bg-pink-500 focus:outline-none focus:border-pink-600 focus:shadow-outline active:bg-pink-600">
                        {{ __('Submit') }}
                    </button>
                </form>
            </div>
            <div class="p-3">
                <p>Concerns:</p>
                <ul class="list-disc list-inside">
                @forelse($observation->concerns as $concern)
                        <li><span class="text-cyan-500">{{$concern->created_at->diffForHumans()}}</span> <a class="text-orange-400" href="{{route('admin.concern.show', $concern)}}">{{$concern->description}}</a></li>
                @empty
                    <li>No Concerns</li>
                @endforelse
                </ul>
            </div>
        </div>
    </div>
</x-layouts.main>
