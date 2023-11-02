<x-layout>
    <div class="max-w-md">
        <h1 class="text-center uppercase font-semibold text-4xl mb-2"> Register </h1>
        <form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4" method="POST" action={{ route('signup') }}>
            @csrf
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
                    Name
                </label>
                <input class="border rounded w-full py-2 px-3 text-gray-700" id="name" name="name" type="text" placeholder="Name">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="email">
                    Email
                </label>
                <input class="border rounded w-full py-2 px-3 text-gray-700" id="email" name="email" type="email" placeholder="Email">
            </div>
            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
                    Password
                </label>
                <input class="border rounded w-full py-2 px-3 text-gray-700" id="password" name="password" type="password" placeholder="********">
            </div>
            <div class="flex items-center justify-center">
                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" type="submit">
                    Sign Up
                </button>
            </div>
            @if($errors)
            <p class="text-center text-red-500 text-xs mt-4">{{ $errors->first() }}</p>
            @endif

        </form>
    </div>
</x-layout>
