<label for="{{ $nama }}" class="block mb-2 text-sm md:text-lg font-medium text-black">{{ $judul }}</label>
<textarea id="{{ $nama }}" name="{{ $nama }}" rows="4"
    class="block px-2.5 pt-2.5 w-full h-full text-sm text-black bg-white rounded-lg border border-black focus:ring-blue-600 focus:border-blue-600 resize-none"
    placeholder="{{ empty($value) ? $placeholder : '' }}" required>{{ $value ?? '' }}</textarea>
