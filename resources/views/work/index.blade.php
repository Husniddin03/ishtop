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
                <section>
                    <!-- Container -->
                    <div class="mx-auto w-full max-w-7xl px-5 py-16 md:px-10 md:py-20">
                        <!-- Component -->
                        <div class="flex flex-col items-center">
                            <h2 class="text-center text-3xl font-bold md:text-5xl">
                                O'zingizga mos ishlarni toping
                            </h2>
                            <p class="mb-8 mt-4 text-center text-sm text-gray-500 sm:text-base md:mb-12 lg:mb-16">
                                Siz uchun eng yaxshi ish imkoniyatlarini kashf eting va orzuingizdagi ishga ega bo'ling!
                            </p>
                            <!-- Content -->
                            <div
                                class="mb-6 grid gap-4 sm:grid-cols-2 sm:justify-items-stretch md:mb-10 md:grid-cols-3 lg:mb-12 lg:gap-6">

                                @foreach ($works as $work)
                                    <a href="{{ route('works.show', $work->id) }}"
                                        class="flex flex-col gap-4 rounded-md border border-solid border-gray-300 px-4 py-8 md:p-0 hover:shadow-xl transition-all duration-300 hover:-translate-y-1">

                                        <!-- Rasm -->
                                        @if ($work->images && $work->images->count() > 0)
                                            <img src="{{ Storage::url($work->images->first()->image) }}"
                                                alt="{{ $work->name }}" class="h-60 object-cover rounded-t-md" />
                                        @else
                                            <img src="https://dummyimage.com/600x400/6366f1/ffffff&text={{ urlencode($work->name) }}"
                                                alt="{{ $work->name }}" class="h-60 object-cover rounded-t-md" />
                                        @endif

                                        <div class="px-6 py-4">
                                            <!-- Ish turi va narxi -->
                                            <div class="flex justify-between items-center mb-4">
                                                <p class="text-sm font-semibold uppercase text-indigo-600">
                                                    {{ $work->type }}
                                                </p>
                                                @if ($work->price)
                                                    <p class="text-lg font-bold text-gray-900">
                                                        {{ number_format($work->price, 0, '.', ' ') }} so'm
                                                    </p>
                                                @endif
                                            </div>

                                            <!-- Ish nomi -->
                                            <p class="mb-3 text-xl font-semibold text-gray-900 line-clamp-2">
                                                {{ $work->name }}
                                            </p>

                                            <!-- Tavsif -->
                                            <p class="mb-4 text-sm text-gray-600 sm:text-base line-clamp-3">
                                                {{ Str::limit($work->description, 120, '...') }}
                                            </p>

                                            <!-- Qo'shimcha ma'lumotlar -->
                                            <div class="mb-4 flex flex-wrap gap-2">
                                                @if ($work->how_much_people)
                                                    <span
                                                        class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                                        <svg class="w-4 h-4 mr-1" fill="currentColor"
                                                            viewBox="0 0 20 20">
                                                            <path
                                                                d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z" />
                                                        </svg>
                                                        {{ $work->how_much_people }} kishi
                                                    </span>
                                                @endif

                                                @if ($work->gender)
                                                    <span
                                                        class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-purple-100 text-purple-800">
                                                        {{ $work->gender === 'male' ? '👨 Erkak' : ($work->gender === 'female' ? '👩 Ayol' : '👥 Farqi yo\'q') }}
                                                    </span>
                                                @endif

                                                @if ($work->age)
                                                    <span
                                                        class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                        🎂 {{ $work->age }} yosh
                                                    </span>
                                                @endif

                                                @if ($work->lunch)
                                                    <span
                                                        class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-orange-100 text-orange-800">
                                                        🍽️ Tushlik bor
                                                    </span>
                                                @endif
                                            </div>

                                            <!-- Vaqt va davomiylik -->
                                            @if ($work->when || $work->duration)
                                                <div class="mb-4 p-3 bg-gray-50 rounded-lg">
                                                    <div class="flex flex-col space-y-1 text-sm text-gray-700">
                                                        @if ($work->when)
                                                            <div class="flex items-center">
                                                                <svg class="w-4 h-4 mr-2 text-gray-500"
                                                                    fill="currentColor" viewBox="0 0 20 20">
                                                                    <path fill-rule="evenodd"
                                                                        d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                                                        clip-rule="evenodd" />
                                                                </svg>
                                                                <span
                                                                    class="font-medium">{{ $work->when->format('d.m.Y') }}</span>
                                                            </div>
                                                        @endif
                                                        @if ($work->start_time && $work->finish_time)
                                                            <div class="flex items-center">
                                                                <svg class="w-4 h-4 mr-2 text-gray-500"
                                                                    fill="currentColor" viewBox="0 0 20 20">
                                                                    <path fill-rule="evenodd"
                                                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z"
                                                                        clip-rule="evenodd" />
                                                                </svg>
                                                                <span>{{ $work->start_time }} -
                                                                    {{ $work->finish_time }}</span>
                                                            </div>
                                                        @endif
                                                        @if ($work->duration)
                                                            <div class="flex items-center">
                                                                <svg class="w-4 h-4 mr-2 text-gray-500"
                                                                    fill="currentColor" viewBox="0 0 20 20">
                                                                    <path fill-rule="evenodd"
                                                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z"
                                                                        clip-rule="evenodd" />
                                                                </svg>
                                                                <span>{{ $work->duration }} kun</span>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            @endif

                                            <!-- Manzil -->
                                            @if ($work->country || $work->district || $work->region || $work->village || $work->address)
                                                <div class="mb-4 flex items-start text-sm text-gray-600">
                                                    <svg class="w-4 h-4 mr-2 mt-0.5 text-gray-500" fill="currentColor"
                                                        viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd"
                                                            d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                    <span>
                                                        {{ collect([$work->address, $work->village, $work->district, $work->region, $work->country])->filter()->implode(', ') }}
                                                    </span>
                                                </div>
                                            @endif

                                            <!-- Muallif ma'lumotlari -->
                                            <div class="flex items-center pt-4 border-t border-gray-200">
                                                <img src="{{ $work->user->avatar ? Storage::url($work->user->avatar) : 'https://ui-avatars.com/api/?name=' . urlencode($work->user->name) . '&background=6366f1&color=fff' }}"
                                                    alt="{{ $work->user->name }}"
                                                    class="mr-3 h-10 w-10 rounded-full object-cover ring-2 ring-gray-200" />
                                                <div class="flex flex-col flex-1">
                                                    <h6 class="text-sm font-bold text-gray-900">{{ $work->user->name }}
                                                    </h6>
                                                    <div
                                                        class="flex flex-wrap items-center gap-x-2 text-xs text-gray-500">
                                                        <span>{{ $work->created_at->format('d.m.Y') }}</span>
                                                        @if ($work->read_count)
                                                            <span>👁️</span> <span>{{ $work->read_count }}</span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                @endforeach

                            </div>
                            <!-- Button -->
                            <a href="javascript:void(0);"
                                class="rounded-md bg-black px-6 py-3 text-center font-semibold text-white">
                                View More
                            </a>
                        </div>
                    </div>
                </section>

            </div>
        </div>
    </div>
</x-app-layout>
