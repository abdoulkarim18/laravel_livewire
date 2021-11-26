<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    {{-- <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet"> --}}
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <title>LivewireLaravel</title>
    <livewire:styles />
    <livewire:scripts/>
    <script src="{{ asset('js/app.js') }}"></script>
</head>
<body class="flex flex-wrap justify-center">

    <div class="flex w-full justify-between px-4 bg-purple-900 text-white">

        <a class="mx-3 py-4" href="{{route('home')}}">Home</a>

        @auth
            <livewire:logout/>
        @endauth

        @guest
            <div class="py-4">
                <a class="mx-3" href="{{route('login')}}">Login</a>
                <a class="mx-3" href="{{route('register')}}">Register</a>
            </div>
        @endguest
    </div>

    <div class="my-10 w-full mx-20">
        {{ $slot }}
    </div>

</body>
</html>

