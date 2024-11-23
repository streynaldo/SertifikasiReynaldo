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
        <form method="post" action="{{ route('users.update', $user->id) }}"
            class="w-full mx-auto grid grid-cols-1 md:grid-cols-2 gap-10" name="users_add" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <h1 class="text-bold text-4xl">Ubah User</h1>
            <div class="w-full flex justify-end">
                <button type="submit"
                    class="px-3 py-2 text-sm text-end font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 w-fit">Ubah</button>
            </div>
            <x-forms.normal-input>
                <x-slot:judul>Nama</x-slot:judul>
                <x-slot:nama>name</x-slot:nama>
                <x-slot:type>text</x-slot:type>
                <x-slot:placeholder>name</x-slot:placeholder>
                <x-slot:pattern>.*</x-slot:pattern>
                <x-slot:value>{{ $user->name }}</x-slot:value>
            </x-forms.normal-input>
            <x-forms.normal-input>
                <x-slot:judul>Email</x-slot:judul>
                <x-slot:nama>email</x-slot:nama>
                <x-slot:type>email</x-slot:type>
                <x-slot:placeholder>example@gmail.com</x-slot:placeholder>
                <x-slot:pattern>.*</x-slot:pattern>
                <x-slot:value>{{ $user->email }}</x-slot:value>
            </x-forms.normal-input>
            <x-forms.normal-input>
                <x-slot:judul>Password</x-slot:judul>
                <x-slot:nama>password</x-slot:nama>
                <x-slot:type>password</x-slot:type>
                <x-slot:placeholder>Password</x-slot:placeholder>
                <x-slot:pattern>.*</x-slot:pattern>
            </x-forms.normal-input>
            <x-forms.normal-input>
                <x-slot:judul>Nomor Telepon</x-slot:judul>
                <x-slot:nama>phone</x-slot:nama>
                <x-slot:type>phone</x-slot:type>
                <x-slot:placeholder>08123456789</x-slot:placeholder>
                <x-slot:pattern>.*</x-slot:pattern>
                <x-slot:value>{{ $user->phone }}</x-slot:value>
            </x-forms.normal-input>
            <x-forms.select-input :datas="$role">
                <x-slot:judul>Pilih Role</x-slot:judul>
                <x-slot:nama>role</x-slot:nama>
                <x-slot:id>{{ $user->role }}</x-slot:id>
            </x-forms.select-input>
            <div class="col-span-1 md:col-span-2 w-full gap-10">
                <x-forms.image-input>
                    <x-slot:judul>Profile Photo</x-slot:judul>
                    <x-slot:name>photo</x-slot:name>
                </x-forms.image-input>
            </div>
        </form>
    </div>

</x-admin.layout>
