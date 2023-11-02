<x-layout>
    <div class="h-full w-full">
        <h1 class="text-center uppercase font-semibold text-4xl mb-2"> My Salaries</h1>

        <form class="grid grid-cols-1" method="GET" action="{{ route('salary.index') }}" role="search">
            <label class="block text-gray-700 text-md font-semibold mb-2" for="year">
                Year
            </label>
            <input class="block bg-gray-200 text-gray-700 rounded py-3 px-4 mb-3" type="number" autofocus name="year" min="1970" placeholder="All" value={{ $year ? $year : ""}}>
            <button class="rounded bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4" type="submit">Filter</button>
        </form>


        @if (count($salaries) > 0)
        <div class="grid grid-cols-1 w-full place-items-center">
            @foreach($salaries as $salary)
            <div class="max-w-sm w-full rounded overflow-hidden shadow-lg my-1">
                <div class="px-6 py-4">
                    <p class="text-lg mb-2"> Amount : <b> ₹ {{ number_format($salary->amount, 2) }} </b> </p>
                    <p class=" text-lg mb"> Credited At: <b> {{ $salary->credited_at}} </b> </p>
                    <p class="text-right  text-gray-700 text-sm mb-2">({{ \Carbon\Carbon::parse($salary->credited_at)->isoFormat('MMM Do YYYY')}})</p>
                    <p class="text-gray-700 text-base">
                        Description : <b>{{ $salary->description ?? ""}}</b>
                    </p>
                </div>
                <div class="px-6 pt-4 pb-2 flex justify-center">
                    <a href="{{ route('salary.edit', $salary->id) }}" class="inline-block bg-yellow-300 rounded-full px-3 py-1 font-semibold mx-1">Edit</a>
                    <form action="{{ route('salary.destroy', $salary->id) }}" method="POST">
                        @csrf
                        <button class="inline-block bg-red-300 rounded-full px-3 py-1 font-semibold mx-1" type="submit">Delete</button>
                    </form>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <p class="text-gray-700 text-center">No salary records found.</p>
        @endif

        @if(session('success'))
        <p class="text-center font-semibold my-2 text-green-400"> {{ session('success') }}</p>
        @elseif($errors)
        <p class="text-center font-semibold my-2 text-red-500">{{ $errors->first() }}</p>
        @endif
    </div>
</x-layout>
