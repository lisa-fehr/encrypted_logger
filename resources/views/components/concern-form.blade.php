<p class="pt-2">Add an event to an Observation:</p>
<form method="POST" enctype="multipart/form-data" action="{{ route('admin.concern.store') }}" class="mt-2 p-4 space-y-2 border-dashed border-2 border-cyan-500">
    @csrf
    <div class="space-y-1">
        <label for="name" class="text-cyan-500">{{ __('Observation:') }}</label>
        <select name="observation_id" required autofocus
                class="w-full p-2 transition duration-150 ease-in-out border bg-pink-50 border-gray-300 rounded-md appearance-none focus:outline-none focus:shadow-outline focus:border-cyan-400" >
            @foreach($observations as $observation)
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
