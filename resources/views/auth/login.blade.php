<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login Page</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300..700&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
        rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gradient-to-br from-orange-400 via-yellow-500 to-orange-600 font-roboto min-h-screen">
    <div class="min-h-screen flex flex-col justify-center items-center">
        <div class="bg-white p-20 rounded-md">
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
            <h1 class="text-3xl font-semibold text-center mb-5">Login</h1>
            <form method="post" action="{{ route('validate-login') }}" class="max-w-sm mx-auto" name="login_form"
                enctype="multipart/form-data">
                @csrf
                <x-forms.normal-input>
                    <x-slot:judul>Email</x-slot:judul>
                    <x-slot:nama>email</x-slot:nama>
                    <x-slot:type>email</x-slot:type>
                    <x-slot:placeholder>example@gmail.com</x-slot:placeholder>
                    <x-slot:pattern>.*</x-slot:pattern>
                </x-forms.normal-input>
                <x-forms.normal-input>
                    <x-slot:judul>Password</x-slot:judul>
                    <x-slot:nama>password</x-slot:nama>
                    <x-slot:type>password</x-slot:type>
                    <x-slot:placeholder>Password</x-slot:placeholder>
                    <x-slot:pattern>.*</x-slot:pattern>
                </x-forms.normal-input>
                <div class="w-full flex justify-center">
                    <button type="submit"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">Login</button>
                </div>
            </form>
            <p class="my-5 text-center">Belum ada akun? <a href="{{ route('register') }}" class="text-blue-700">klik
                    disini</a></p>
        </div>

    </div>

</body>

</html>
