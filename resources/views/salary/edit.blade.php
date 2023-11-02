<x-layout>
    <h1 class="text-center uppercase font-semibold text-4xl mb-2"> Edit Salary </h1>
    <form class="w-full max-w-lg" method="POST" action="{{ route('salary.update', $salary->id) }}">
        @csrf
        <div class="flex flex-wrap -mx-3 mb-6">
            <div class="w-full">
                <label class="block uppercase text-gray-700 text-xs font-bold mb-2" for="amount">
                    Amount (in Rs.)
                </label>
                <input class="block w-full bg-gray-200 text-gray-700 rounded py-3 px-4 mb-3" id="amount" value="{{ old('amount') ?? $salary->amount }}" name="amount" type="number" step="0.01" min="0" required>
                <p class="text-right text-gray-600 text-xs italic">You can add upto 2 decimal places.</p>
            </div>

            <div class="w-full">
                <label class="block uppercase text-gray-700 text-xs font-bold mb-2" for="description">
                    Description
                </label>
                <textarea name="description" id="description" cols="30" rows="5" class="block w-full bg-gray-200 text-gray-700 rounded py-3 px-4 mb-3">{{ old('description') ?? $salary->description }}</textarea>
                <p class="text-right text-gray-600 text-xs italic">Description is optional.</p>
            </div>

            <div class="w-full">
                <label class="block uppercase text-gray-700 text-xs font-bold mb-2" for="credited_at">
                    Credited At (Date)
                </label>
                <input class="block w-full bg-gray-200 text-gray-700 rounded py-3 px-4 mb-3" id="credited_at" name="credited_at" type="date" value="{{ old('credited_at') ?? $salary->credited_at }}" required>
            </div>

            <div class="w-full">
                <div class="flex justify-center">
                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" type="submit">
                        Edit Salary
                    </button>
                </div>
                @if($errors)
                <p class="text-center text-red-500 text-xs mt-4">{{ $errors->first() }}</p>
                @endif
            </div>
        </div>
    </form>
</x-layout>
