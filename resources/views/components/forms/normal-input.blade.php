<div class="mb-5">
    <label for="{{ $nama }}"
        class="block mb-2 text-sm md:text-lg font-medium text-black">{{ $judul }}</label>
    <input type="{{ $type }}" id="{{ $nama }}" name="{{ $nama }}"
        class="bg-white border border-black text-black text-sm rounded-lg focus:ring-blue-600 focus:border-gold block w-full p-2.5"
        placeholder="{{ empty($value) ? $placeholder : '' }}" value="{{ $value ?? '' }}" pattern="{{ $pattern }}" required />
</div>
