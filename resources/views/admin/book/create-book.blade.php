<x-admin.layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <div class="min-h-screen flex flex-col justify-center items-center px-24">
        @if ($errors->any())
            <div class="w-full bg-red-500 text-white p-3 text-center rounded-lg mb-5">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @elseif (session('error'))
            <div class="w-full bg-red-500 text-white p-3 text-center rounded-lg mb-5">
                {{ session('error') }}
            </div>
        @endif
        <form method="post" action="{{ route('books.store') }}"
            class="w-full mx-auto grid grid-cols-1 md:grid-cols-2 gap-10" name="book_add" enctype="multipart/form-data">
            @csrf
            <h1 class="text-bold text-4xl">Tambah Buku</h1>
            <div class="w-full flex justify-end">
                <button type="submit"
                    class="px-3 py-2 text-sm text-end font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 w-fit">Tambah</button>
            </div>
            <x-forms.normal-input>
                <x-slot:judul>Judul Buku</x-slot:judul>
                <x-slot:nama>title</x-slot:nama>
                <x-slot:type>text</x-slot:type>
                <x-slot:placeholder>Judul Buku</x-slot:placeholder>
                <x-slot:pattern>.*</x-slot:pattern>
            </x-forms.normal-input>
            <x-forms.normal-input>
                <x-slot:judul>Penulis</x-slot:judul>
                <x-slot:nama>author</x-slot:nama>
                <x-slot:type>text</x-slot:type>
                <x-slot:placeholder>Penulis</x-slot:placeholder>
                <x-slot:pattern>.*</x-slot:pattern>
            </x-forms.normal-input>
            <x-forms.normal-input>
                <x-slot:judul>Penerbit</x-slot:judul>
                <x-slot:nama>publisher</x-slot:nama>
                <x-slot:type>text</x-slot:type>
                <x-slot:placeholder>Penerbit</x-slot:placeholder>
                <x-slot:pattern>.*</x-slot:pattern>
            </x-forms.normal-input>
            <x-forms.normal-input>
                <x-slot:judul>Tanggal Terbit</x-slot:judul>
                <x-slot:nama>release_date</x-slot:nama>
                <x-slot:type>date</x-slot:type>
                <x-slot:placeholder>yyyy-mm-dd</x-slot:placeholder>
                <x-slot:pattern>.*</x-slot:pattern>
            </x-forms.normal-input>

            <div class="col-span-1 md:col-span-2 w-full gap-10">
                <div class="mb-5">
                    <label class="block mb-2 text-sm md:text-lg font-medium text-black">Kategori</label>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        @foreach ($kategori as $kat)
                            <x-forms.check-box>
                                <x-slot:name>categories</x-slot:name>
                                <x-slot:value>{{ $kat->id }}</x-slot:value>
                                <x-slot:label>{{ $kat->name }}</x-slot:label>
                            </x-forms.check-box>
                        @endforeach
                    </div>
                </div>

                <div class="h-fit mb-5">
                    <x-forms.text-area-input>
                        <x-slot:judul>Deskripsi Buku</x-slot:judul>
                        <x-slot:nama>description</x-slot:nama>
                        <x-slot:placeholder>Deskripsi Buku</x-slot:placeholder>
                    </x-forms.text-area-input>
                </div>

                <x-forms.image-input>
                    <x-slot:judul>Cover Buku</x-slot:judul>
                    <x-slot:name>cover_photo</x-slot:name>
                </x-forms.image-input>
            </div>
        </form>
    </div>

</x-admin.layout>
