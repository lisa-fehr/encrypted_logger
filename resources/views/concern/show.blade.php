<x-layouts.main>
    <div class="flex justify-center items-center text-pink-500">
        <div class="w-full h-screen mr-5">
            <div class="p-3">
                <p class="text-cyan-500">{{$concern->created_at}}</p>
                <p>{{$concern->description}}</p>
            </div>
            <div class="p-3">
                <p>Photos:</p>
                @forelse($concern->photos as $photo)
                    <img class="flex mt-2" alt="{{ $photo->img }}" src="{{ route('admin.photos.show', $photo) }}" />
                @empty
                    No Photos
                @endforelse
            </div>
            <div class="p-3">
                <p>Observation:</p>
                <p>
                    <span class="text-cyan-500">{{$concern->observation->created_at->diffForHumans()}}</span>
                    <a class="text-orange-400" href="{{route('admin.observation.show', $concern->observation)}}">{{$concern->observation->name}}</a> - {{$concern->observation->description}}
                </p>
            </div>
            <div class="p-3">Additional Concerns:
                <ul class="list-disc list-inside">
                    @forelse($additional_concerns as $concern)
                        <li><span class="text-cyan-500">{{$concern->created_at->diffForHumans()}}</span> <a class="text-orange-400" href="{{route('admin.concern.show', $concern)}}">{{$concern->description}}</a></li>
                    @empty
                        <li>No Additional Concerns</li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>
</x-layouts.main>
