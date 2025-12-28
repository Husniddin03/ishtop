<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row items-center justify-between bg-white shadow-md rounded-lg p-4 gap-4">
            <!-- Title -->
            <h2 class="text-2xl font-bold text-gray-900 tracking-wide">
                {{ __('Ishlar') }}
            </h2>

            <!-- Search -->
            <div class="relative w-full md:w-1/3">
                <input type="search" name="search" id="search" placeholder="Qidirish..."
                    class="w-full rounded-lg border border-gray-300 pl-10 pr-4 py-2 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition">
                <!-- Icon -->
                <span class="absolute left-3 top-2.5 text-gray-400">
                    🔍
                </span>
            </div>

            <!-- Button -->
            <a href="{{ route('works.create') }}" class="w-full md:w-auto">
                <button
                    class="w-full md:w-auto px-6 py-2 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold rounded-lg shadow-md transition">
                    Elon berish
                </button>
            </a>
        </div>


    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <x-works-list />
            </div>
        </div>
    </div>
</x-app-layout>
