<div class="mb-5">
    <label class="block mb-2 text-sm md:text-lg font-medium text-black"
        for="file_input">{{ $judul }}</label>
    <input class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50"
        id="{{ $name }}" name="{{ $name }}" type="file" value="{{ $value ?? '' }}">
</div>
