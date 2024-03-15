<x-layouts.main>
    <div class="flex justify-center items-center text-pink-500">
        <div class="w-full h-screen mr-5">
            <div class="p-3">
                <p class="text-cyan-500">{{$tag->created_at}}</p>
                <p>{{$tag->name}}</p>
            </div>
            <div class="p-3">
                <p>Concerns:</p>
                <ul class="list-disc list-inside">
                    @forelse($tag->concerns as $concern)
                        <li><span class="text-cyan-500">{{$concern->created_at->diffForHumans()}}</span> <a class="text-orange-400" href="{{route('admin.concern.show', $concern)}}">{{$concern->description}}</a></li>
                    @empty
                        <li>No Concerns</li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>
</x-layouts.main>
