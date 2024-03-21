<p class="pt-2">Tag a concern:</p>
<form method="POST" action="{{ route('admin.concern.tag.store') }}" class="mt-2 p-4 space-y-2 border-dashed border-2 border-cyan-500">
    @method('patch')
    @csrf
    <div class="space-y-1">
        <label for="name" class="text-cyan-500">{{ __('Tag:') }}</label>
        <select name="tag" required autofocus
                class="w-full p-2 transition duration-150 ease-in-out border bg-pink-50 border-gray-300 rounded-md appearance-none focus:outline-none focus:shadow-outline focus:border-cyan-400" >
            @foreach($tags as $tag)
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
            @foreach($concerns as $concern)
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
