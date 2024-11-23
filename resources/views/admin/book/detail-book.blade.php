<x-admin.layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="flex flex-col w-full justify-center items-center mx-auto">
        <div class="p-5">
            <div class="flex flex-row mb-5 justify-center w-full">
                <h1 class="text-bold text-4xl">Detail Buku</h1>
            </div>
            <div class="flex flex-col gap-5">
                <div class="flex flex-row mb-5">
                    <div class="w-1/4">
                        <img src="{{ asset('storage/' . $book->cover_photo) }}" alt="Foto Pengguna" class="w-full h-full">
                    </div>
                    <div class="w-3/4">
                        <h1 class="text-bold text-2xl">{{ $book->title }}</h1>
                        <p class="text-gray-500">{{ $book->author }}</p>
                    </div>
                </div>
                <div class="flex flex-row mb-5">
                    <div class="w-1/4">
                        <p class="text-gray-500">Penerbit</p>
                    </div>
                    <div class="w-3/4">
                        <p>{{ $book->publisher }}</p>
                    </div>
                </div>
                <div class="flex flex-row mb-5">
                    <div class="w-1/4">
                        <p class="text-gray-500">Tanggal Terbit</p>
                    </div>
                    <div class="w-3/4">
                        <p>{{ $book->release_date }}</p>
                    </div>
                </div>
                <div class="flex flex-row mb-5">
                    <div class="w-1/4">
                        <p class="text-gray-500">Kategori</p>
                    </div>
                    <div class="w-3/4">
                        <p>
                            @foreach ($kategori as $kat)
                                {{ $kat }}
                                @if (!$loop->last)
                                    ,
                                @endif
                            @endforeach
                        </p>
                    </div>
                </div>
                <div class="flex flex-row mb-5">
                    <div class="w-1/4">
                        <p class="text-gray-500">Deskripsi</p>
                    </div>
                    <div class="w-3/4">
                        <p>{{ $book->description }}</p>
                    </div>
                </div>
                <div class="flex flex-row mb-5">
                    <div class="w-1/4">
                        <p class="text-gray-500">Tanggal Pinjam</p>
                    </div>
                    <div class="w-3/4">
                        <p>{{ $book->borrow_date ? $book->borrow_date : 'Tidak Ada Data' }}</p>
                    </div>
                </div>
                <div class="flex flex-row mb-5">
                    <div class="w-1/4">
                        <p class="text-gray-500">Peminjam</p>
                    </div>
                    <div class="w-3/4">
                        <p>{{ $book->user_id ? $book->user->name : 'Tidak Ada Data' }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>


</x-admin.layout>
