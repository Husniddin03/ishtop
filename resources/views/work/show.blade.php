<x-app-layout>

    <x-slot name="header">
        <div class="flex flex-col md:flex-row items-center justify-between bg-white shadow-md rounded-lg p-4 gap-4">
            <!-- Title -->
            <h2 class="text-2xl font-bold text-gray-900 tracking-wide">
                {{ __('Ish') }}
            </h2>

            <!-- Button -->
            <a href="{{ route('works.index') }}" class="w-full md:w-auto">
                <button
                    class="w-full md:w-auto px-6 py-2 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold rounded-lg shadow-md transition">
                    Orqaga
                </button>
            </a>
        </div>


    </x-slot>

    <x-work-show :id="$id" />

</x-app-layout>
