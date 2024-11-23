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
        <form method="post" action="{{ route('categories.store') }}"
            class="w-full mx-auto grid grid-cols-1 md:grid-cols-2 gap-10" name="book_add" enctype="multipart/form-data">
            @csrf
            <h1 class="text-bold text-4xl">Tambah Kategori</h1>
            <div class="w-full flex justify-end">
                <button type="submit"
                    class="px-3 py-2 text-sm text-end font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 w-fit">Tambah</button>
            </div>
            <div class="col-span-1 md:col-span-2 w-full gap-10">
                <x-forms.normal-input>
                    <x-slot:judul>Nama Kategori</x-slot:judul>
                    <x-slot:nama>name</x-slot:nama>
                    <x-slot:type>text</x-slot:type>
                    <x-slot:placeholder>Fiksi</x-slot:placeholder>
                    <x-slot:pattern>.*</x-slot:pattern>
                </x-forms.normal-input>
            </div>
        </form>
    </div>

</x-admin.layout>
