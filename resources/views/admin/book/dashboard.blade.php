<x-admin.layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <div class="min-h-screen flex flex-col justify-center items-center px-24">
        @if (session('status'))
            <div class="w-1/4 bg-green-400 text-center font-bold text-white my-5 py-4">
                {{ session('status') }}
            </div>
        @endif
        <div class="flex flex-row mb-5 justify-between w-full">
            <h1 class="text-bold text-4xl">List Book</h1>
            <div class="flex flex-row gap-5">
                <form action="{{ route('books.index') }}" method="GET">
                    <select name="filter" id="filter">
                        <option value="all">All</option>
                        @foreach ($categories as $cat)
                            <option value="{{ $cat->name }}">{{ $cat->name }}</option>
                        @endforeach
                    </select>
                    <button type="submit"
                        class="px-3 py-2 text-sm font-medium text-white bg-green-600 rounded-lg hover:bg-green-700">Filter</button>
                </form>
                <a href="{{ route('books.create') }}"
                    class="px-3 py-2 text-sm text-end font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700">Tambah
                    Buku</a>
            </div>
        </div>
        <div class="w-full overflow-x-auto">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Cover Buku
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Judul Buku
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Penulis
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Penerbit
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Tanggal Terbit
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Aksi
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $book)
                        <tr class="bg-white border-b">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                <img src="{{ asset('storage/' . $book->cover_photo) }}" alt="Foto Pengguna"
                                    class="w-10 h-10 rounded-full">
                            </th>
                            <td class="px-6 py-4">
                                {{ $book->title }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $book->author }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $book->publisher }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $book->release_date }}
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex space-x-2">
                                    <a href="{{ route('books.show', $book->id) }}"
                                        class="px-3 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700">
                                        Detail
                                    </a>
                                    <a href="{{ route('books.edit', $book->id) }}"
                                        class="px-3 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700">
                                        Edit
                                    </a>
                                    <form action="{{ route('books.destroy', $book->id) }}" method="POST"
                                        onsubmit="return confirm('Are you sure?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="px-3 py-2 text-sm font-medium text-white bg-red-600 rounded-lg hover:bg-red-700">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            {{ $data->links() }}
        </div>
    </div>
</x-admin.layout>
