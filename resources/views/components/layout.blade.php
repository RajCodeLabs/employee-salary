<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Employee Salary</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <!-- Styles -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="antialiased">
    <div class="relative min-h-screen sm:flex sm:justify-center">
        <div class="block bg-black w-full z-10 p-6 text-right sm:fixed sm:right-0 sm:top-0">
            <a href="{{ route('home') }}" class="font-semibold text-gray-400 hover:text-gray-100">Home</a>
            @auth
            <a href="{{ route('salary.index') }}" class="ml-4 font-semibold text-gray-400 hover:text-gray-100">Dashboard</a>
            <a href="{{ route('salary.create') }}" class="ml-4 font-semibold text-gray-400 hover:text-gray-100">Add Salary</a>
            <a href="{{ route('logout') }}" class="ml-4 font-semibold text-gray-400 hover:text-gray-100">Log Out</a>
            @else
            <a href="{{ route('login') }}" class="ml-4 font-semibold text-gray-400 hover:text-gray-100">Log In</a>
            @if (Route::has('register'))
            <a href="{{ route('register') }}" class="ml-4 font-semibold text-gray-400 hover:text-gray-100">Register</a>
            @endif
            @endauth
        </div>
        <div class="mt-10 sm:mt-20 md:mt-32 max-w-md w-full">
            {{ $slot }}
        </div>
    </div>
</body>

</html>
