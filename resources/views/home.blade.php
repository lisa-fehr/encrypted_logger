<x-layouts.main>
    <div class="flex justify-center text-pink-500">
        <div class="w-full mr-5">
            <p class="bg-orange-200 rounded-lg p-3 text-orange-400">You are logged in. Welcome {{ request()->user()->name }}</p>
            <x-alerts.errors />
            <x-alerts.status />

            @if($change_layout)
                <x-concern-form :observations="$observations"/>
            @endif

            <div class="p-3">
                <p>Active Observations</p>
                <ul class="list-disc list-inside">
                    @forelse($observations as $observation)
                        <li class="flex py-2 justify-between">
                            <form action="{{ route('admin.observation.update', $observation) }}" method="POST" class="w-1/4 sm:w-1/3">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="active" value="0">
                                <button class="bg-amber-500 hover:bg-amber-600 text-white font-bold py-2 px-4 border border-amber-700 rounded">Deactivate</button>
                            </form>
                            <a class="text-orange-400 w-1/2 sm:w-3/5" href="{{route('admin.observation.show', $observation)}}">{{$observation->name}}</a>
                            <span class="text-cyan-500 w-1/4 sm:w-1/5">{{$observation->created_at->diffForHumans()}}</span>
                        </li>
                    @empty
                        <li>None</li>
                    @endforelse
                </ul>

                <p class="pt-3">Recent Events</p>
                <ul class="list-disc list-inside">
                    @forelse($concerns as $concern)
                        <li><span class="text-cyan-500">{{$concern->created_at->diffForHumans()}}</span> <a class="text-orange-400" href="{{route('admin.concern.show', $concern)}}">{{$concern->description}}</a></li>
                    @empty
                        <li>None</li>
                    @endforelse
                </ul>

                <p class="pt-3">Here are the current tags</p>
                <ul class="list-disc list-inside">
                    @forelse($tags as $tag)
                        <li class="flex py-2">
                            <form action="{{ route('admin.tag.delete', $tag) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="bg-amber-500 hover:bg-amber-600 text-white font-bold py-2 px-4 border border-amber-700 rounded">Delete</button>
                            </form>
                            <a class="px-2 text-orange-400" href="{{route('admin.tag.show', $tag)}}">{{$tag->name}}</a> ({{$tag->count()}})
                        </li>
                    @empty
                        <li>None</li>
                    @endforelse
                </ul>

                <p class="pt-3">Archived Observations</p>
                <ul class="list-disc list-inside">
                    @forelse($archived_observations as $observation)
                        <li><a class="text-orange-400 w-1/2" href="{{route('admin.observation.show', $observation)}}">{{$observation->name}}</a></li>
                    @empty
                        <li>None</li>
                    @endforelse
                </ul>
            </div>
        </div>
        @if(!$change_layout)
            <div class="text-pink-500 py-4 sm:mx-auto sm:w-full sm:max-w-lg sm:shadow sm:bg-gray-50 sm:rounded-lg">
                <h1 class="underline">Quick Add</h1>
                <x-tags-form/>
                <x-observations-form/>
                <x-concern-form :observations="$observations"/>
                <x-tag-concern-form :tags="$tags" :concerns="$concerns"/>

            </div>
        @endif
    </div>
    @if($change_layout)
        <div class="text-pink-500 w-full sm:shadow sm:bg-gray-50 sm:rounded-lg p-3">
            <h1 class="underline">Quick Add</h1>
            <x-tags-form/>
            <x-observations-form/>
            <x-tag-concern-form :tags="$tags" :concerns="$concerns"/>
        </div>
    @endif
</x-layouts.main>
