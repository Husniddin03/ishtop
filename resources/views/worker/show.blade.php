<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row items-center justify-between bg-white shadow-md rounded-lg p-4 gap-4">
            <!-- Title -->
            <h2 class="text-2xl font-bold text-gray-900 tracking-wide">
                {{ __('Ishchi') }}
            </h2>

            <!-- Button -->
            <a href="{{ route('workers.index') }}" class="w-full md:w-auto">
                <button
                    class="w-full md:w-auto px-6 py-2 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold rounded-lg shadow-md transition">
                    Orqaga
                </button>
            </a>
        </div>


    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <x-worker-show :id={{ $id }} />
            </div>
        </div>
    </div>
</x-app-layout>
