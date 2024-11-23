<div class="mb-5">
    <label for="{{ $nama }}"
        class="block mb-2 text-sm md:text-lg font-medium text-black">{{ $judul }}</label>
    <select id="{{ $nama }}" name="{{ $nama }}"
        class="bg-white border border-black text-black text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5">
        <option selected>{{ $judul }}</option>
        @foreach ($datas as $data)
            @if ($id && strval($loop->iteration) == $id)
                <option value="{{ $loop->iteration }}" selected>{{ $data }}</option>
            @else
                <option value="{{ $loop->iteration }}">{{ $data }}</option>
            @endif
        @endforeach
    </select>
</div>
