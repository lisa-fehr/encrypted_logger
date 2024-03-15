<x-layouts.main>
    <div class="flex justify-center items-center text-pink-500">
        <div class="w-full h-screen mr-5">
            <p class="bg-orange-200 rounded-lg p-3 text-orange-400">You are logged in. Welcome {{ request()->user()->name }}</p>
            <x-alerts.errors />
            <x-alerts.status />

            <div class="p-3">
                <p>Active Observations</p>
                <ul class="list-disc list-inside">
                    @forelse(App\Models\Observation::where('active', true)->get() as $observation)
                        <li class="flex py-2 justify-between">
                            <form action="{{ route('admin.observation.update', $observation) }}" method="POST" class="w-1/4">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="active" value="0">
                                <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 border border-red-700 rounded">Deactivate</button>
                            </form>
                            <a class="text-orange-400 w-1/2" href="{{route('admin.observation.show', $observation)}}">{{$observation->name}}</a>
                            <span class="text-cyan-500 w-1/4">{{$observation->created_at->diffForHumans()}}</span>
                        </li>
                    @empty
                        <li>None</li>
                    @endforelse
                </ul>

                <p class="pt-3">Recent Events</p>
                <ul class="list-disc list-inside">
                    @forelse(App\Models\Concern::orderBy("created_at")->take(100)->get() as $concern)
                        <li><span class="text-cyan-500">{{$concern->created_at->diffForHumans()}}</span> <a class="text-orange-400" href="{{route('admin.concern.show', $concern)}}">{{$concern->description}}</a></li>
                    @empty
                        <li>None</li>
                    @endforelse
                </ul>

                <p class="pt-3">Here are the current tags</p>
                <ul class="list-disc list-inside">
                    @forelse(App\Models\Tag::all() as $tag)
                        <li class="flex py-2">
                            <form action="{{ route('admin.tag.delete', $tag) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 border border-red-700 rounded">Delete</button>
                            </form>
                            <a class="px-2 text-orange-400" href="{{route('admin.tag.show', $tag)}}">{{$tag->name}}</a> ({{$tag->count()}})
                        </li>
                    @empty
                        <li>None</li>
                    @endforelse
                </ul>

                <p class="pt-3">Archived Observations</p>
                <ul class="list-disc list-inside">
                    @forelse(App\Models\Observation::where('active', false)->get() as $observation)
                        <li><a class="text-orange-400 w-1/2" href="{{route('admin.observation.show', $observation)}}">{{$observation->name}}</a></li>
                    @empty
                        <li>None</li>
                    @endforelse
                </ul>
            </div>
        </div>
        <div class=" text-pink-500 py-4 sm:mx-auto sm:w-full sm:max-w-lg sm:shadow sm:bg-gray-50 sm:rounded-lg">
            <h1 class="underline">Quick Add</h1>
            <p class="pt-2">Add new tags:</p>
            <form method="POST" action="{{ route('admin.tag.store') }}" class="p-4 space-y-2 border-dashed border-2 border-cyan-500">
            @csrf
                <div class="space-y-1">
                    <label for="name" class="text-cyan-500">{{ __('Name:') }}</label>
                    <input type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name"
                           class="w-full p-2 transition duration-150 ease-in-out border bg-pink-50 border-gray-300 rounded-md appearance-none focus:outline-none focus:shadow-outline focus:border-cyan-400" />
                </div>
                <button type="submit"
                        class="flex justify-center w-1/2 py-2 text-white transition duration-300 ease-in-out bg-pink-400 border border-pink-400 rounded-md hover:bg-pink-500 focus:outline-none focus:border-pink-600 focus:shadow-outline active:bg-pink-600">
                    {{ __('Submit') }}
                </button>
            </form>
            <p class="pt-2">Add an observation:</p>
            <form method="POST" action="{{ route('admin.observation.store') }}" class="mt-2 p-4 space-y-2 border-dashed border-2 border-cyan-500">
                @csrf
                <div class="space-y-1">
                    <label for="name" class="text-cyan-500">{{ __('Name:') }}</label>
                    <input type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name"
                           class="w-full p-2 transition duration-150 ease-in-out border bg-pink-50 border-gray-300 rounded-md appearance-none focus:outline-none focus:shadow-outline focus:border-cyan-400" />
                </div>
                <div class="space-y-1">
                    <label for=description class="text-cyan-500">{{ __('Description:') }}</label>
                    <input type="text" name="description" value="{{ old('description') }}" required autofocus autocomplete="description"
                           class="w-full p-2 transition duration-150 ease-in-out border bg-pink-50 border-gray-300 rounded-md appearance-none focus:outline-none focus:shadow-outline focus:border-cyan-400" />
                </div>
                <button type="submit"
                        class="flex justify-center w-1/2 py-2 text-white transition duration-300 ease-in-out bg-pink-400 border border-pink-400 rounded-md hover:bg-pink-500 focus:outline-none focus:border-pink-600 focus:shadow-outline active:bg-pink-600">
                    {{ __('Submit') }}
                </button>
            </form>
            <p class="pt-2">Add an event to an Observation:</p>
            <form method="POST" enctype="multipart/form-data" action="{{ route('admin.concern.store') }}" class="mt-2 p-4 space-y-2 border-dashed border-2 border-cyan-500">
                @csrf
                <div class="space-y-1">
                    <label for="name" class="text-cyan-500">{{ __('Observation:') }}</label>
                    <select name="observation_id" required autofocus
                           class="w-full p-2 transition duration-150 ease-in-out border bg-pink-50 border-gray-300 rounded-md appearance-none focus:outline-none focus:shadow-outline focus:border-cyan-400" >
                            @foreach(App\Models\Observation::all() as $observation)
                            <option {{ $observation->default ? 'selected': '' }} value="{{ $observation->id }}">
                                {{ $observation->name }}
                            </option>
                            @endforeach
                    </select>
                </div>
                <div class="space-y-1">
                    <label for="name" class="text-cyan-500">{{ __('Date (if not today):') }}</label>
                    <input type="date" name="alternate_date" value="{{ old('alternate_date') }}" class="w-full p-2 transition duration-150 ease-in-out border bg-pink-50 border-gray-300 rounded-md appearance-none focus:outline-none focus:shadow-outline focus:border-cyan-400" />
                </div>
                <div class="space-y-1">
                    <label for="description" class="text-cyan-500">{{ __('Why this may have happened:') }}</label>
                    <input type="text" name="description" value="{{ old('description') }}" required autofocus autocomplete="description"
                           class="w-full p-2 transition duration-150 ease-in-out border bg-pink-50 border-gray-300 rounded-md appearance-none focus:outline-none focus:shadow-outline focus:border-cyan-400" />
                </div>
                <div class="space-y-1">
                    <label for="files" class="text-cyan-500">{{ __('Photos:') }}</label>
                    <input type="file" name="files[]" multiple class="w-full p-2 transition duration-150 ease-in-out border bg-pink-50 border-gray-300 rounded-md appearance-none focus:outline-none focus:shadow-outline focus:border-cyan-400" />
                </div>
                <button type="submit"
                        class="flex justify-center w-1/2 py-2 text-white transition duration-300 ease-in-out bg-pink-400 border border-pink-400 rounded-md hover:bg-pink-500 focus:outline-none focus:border-pink-600 focus:shadow-outline active:bg-pink-600">
                    {{ __('Submit') }}
                </button>
            </form>

            <p class="pt-2">Tag a concern:</p>
            <form method="POST" action="{{ route('admin.concern.tag.store') }}" class="mt-2 p-4 space-y-2 border-dashed border-2 border-cyan-500">
                @method('patch')
                @csrf
                <div class="space-y-1">
                    <label for="name" class="text-cyan-500">{{ __('Tag:') }}</label>
                    <select name="tag" required autofocus
                            class="w-full p-2 transition duration-150 ease-in-out border bg-pink-50 border-gray-300 rounded-md appearance-none focus:outline-none focus:shadow-outline focus:border-cyan-400" >
                        @foreach(App\Models\Tag::all() as $tag)
                            <option value="{{ $tag->id }}">
                                {{ $tag->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="space-y-1">
                    <label for="name" class="text-cyan-500">{{ __('Concern:') }}</label>
                    <select name="concern" required autofocus
                            class="w-full p-2 transition duration-150 ease-in-out border bg-pink-50 border-gray-300 rounded-md appearance-none focus:outline-none focus:shadow-outline focus:border-cyan-400" >
                        @foreach(App\Models\Concern::all() as $concern)
                            <option value="{{ $concern->id }}">
                                {{ $concern->description }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <button type="submit"
                        class="flex justify-center w-1/2 py-2 text-white transition duration-300 ease-in-out bg-pink-400 border border-pink-400 rounded-md hover:bg-pink-500 focus:outline-none focus:border-pink-600 focus:shadow-outline active:bg-pink-600">
                    {{ __('Submit') }}
                </button>
            </form>
        </div>
    </div>
</x-layouts.main>
