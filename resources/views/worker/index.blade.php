<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row items-center justify-between bg-white shadow-md rounded-lg p-4 gap-4">
            <!-- Title -->
            <h2 class="text-2xl font-bold text-gray-900 tracking-wide">
                {{ __('Ishchilar') }}
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
            <a href="{{ route('workers.create') }}" class="w-full md:w-auto">
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
                <section class="bg-gray-50">
                    <div class="mx-auto w-full max-w-7xl px-5 py-10 md:px-6 md:py-16">
                        @if ($workers->isEmpty())
                            <div class="text-center py-12">
                                <div
                                    class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-gray-200 mb-4">
                                    <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                    </svg>
                                </div>
                                <p class="text-gray-500 text-lg font-medium">Hozircha ishchilar mavjud emas</p>
                            </div>
                        @else
                            <div class="space-y-16">
                                @foreach ($workers as $worker)
                                    <div
                                        class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-2xl transition-shadow duration-300">
                                        <div class="grid md:grid-cols-5 gap-0">

                                            <!-- Rasm qismi - Chap tomon -->
                                            <div
                                                class="md:col-span-2 relative bg-gradient-to-br from-indigo-600 to-purple-700 min-h-[400px] md:min-h-[600px]">
                                                @if ($worker->user->avatar)
                                                    <img src="{{ Storage::url($worker->user->avatar) }}"
                                                        alt="{{ $worker->user->userData->first_name ?? $worker->user->name }}"
                                                        class="w-full h-full object-cover">
                                                @else
                                                    <div class="w-full h-full flex items-center justify-center p-8">
                                                        <div class="text-center">
                                                            <div
                                                                class="w-40 h-40 mx-auto rounded-full bg-white/20 backdrop-blur-sm flex items-center justify-center text-white text-6xl font-bold mb-6 ring-4 ring-white/30">
                                                                {{ strtoupper(substr($worker->user->userData->first_name ?? $worker->user->name, 0, 1)) }}{{ strtoupper(substr($worker->user->userData->last_name ?? '', 0, 1)) }}
                                                            </div>
                                                            <h3 class="text-2xl font-bold text-white">
                                                                {{ $worker->user->userData->first_name ?? $worker->user->name }}
                                                                {{ $worker->user->userData->last_name ?? '' }}
                                                            </h3>
                                                        </div>
                                                    </div>
                                                @endif

                                                <!-- Status badge -->
                                                <div class="absolute top-6 left-6">
                                                    <div
                                                        class="flex items-center rounded-full bg-green-500 px-4 py-2 shadow-lg">
                                                        <div
                                                            class="mr-2 h-2.5 w-2.5 rounded-full bg-white animate-pulse">
                                                        </div>
                                                        <p class="text-sm font-semibold text-white">Ishga tayyor</p>
                                                    </div>
                                                </div>

                                                <!-- Location badge -->
                                                @if ($worker->user->userData->country || $worker->user->userData->region)
                                                    <div class="absolute bottom-6 left-6 right-6">
                                                        <div
                                                            class="bg-white/90 backdrop-blur-sm rounded-lg px-4 py-3 shadow-lg">
                                                            <div class="flex items-start">
                                                                <svg class="w-5 h-5 text-indigo-600 mr-2 mt-0.5 flex-shrink-0"
                                                                    fill="currentColor" viewBox="0 0 20 20">
                                                                    <path fill-rule="evenodd"
                                                                        d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z"
                                                                        clip-rule="evenodd" />
                                                                </svg>
                                                                <div class="text-sm text-gray-700">
                                                                    <p class="font-semibold">
                                                                        {{ $worker->user->userData->country ?? 'O\'zbekiston' }}
                                                                    </p>
                                                                    @if ($worker->user->userData->region)
                                                                        <p class="text-gray-600">
                                                                            {{ $worker->user->userData->region }}
                                                                        </p>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>

                                            <!-- Ma'lumotlar qismi - O'ng tomon -->
                                            <div class="md:col-span-3 p-8 md:p-12 flex flex-col justify-between">

                                                <!-- Ism va Bio -->
                                                <div class="flex-grow">
                                                    <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-3">
                                                        {{ $worker->user->userData->first_name ?? $worker->user->name }}
                                                        @if ($worker->user->userData->last_name)
                                                            <span
                                                                class="text-indigo-600">{{ $worker->user->userData->last_name }}</span>
                                                        @endif
                                                    </h1>

                                                    @if ($worker->user->userData->bio)
                                                        <p class="text-xl text-gray-600 mb-8 leading-relaxed">
                                                            {{ $worker->user->userData->bio }}
                                                        </p>
                                                    @endif

                                                    <!-- Shaxsiy ma'lumotlar -->
                                                    <div class="grid grid-cols-2 gap-6 mb-8">

                                                        @if ($worker->user->userData->gender)
                                                            <div class="flex items-center space-x-3">
                                                                <div
                                                                    class="flex-shrink-0 w-12 h-12 rounded-full bg-purple-100 flex items-center justify-center">
                                                                    <span
                                                                        class="text-2xl">{{ $worker->user->userData->gender === 'male' ? '👨' : '👩' }}</span>
                                                                </div>
                                                                <div>
                                                                    <p
                                                                        class="text-xs text-gray-500 uppercase tracking-wide">
                                                                        Jins</p>
                                                                    <p class="text-sm font-semibold text-gray-900">
                                                                        {{ $worker->user->userData->gender === 'male' ? 'Erkak' : 'Ayol' }}
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        @endif

                                                        @if ($worker->user->userData->birthday)
                                                            <div class="flex items-center space-x-3">
                                                                <div
                                                                    class="flex-shrink-0 w-12 h-12 rounded-full bg-blue-100 flex items-center justify-center">
                                                                    <span class="text-2xl">🎂</span>
                                                                </div>
                                                                <div>
                                                                    <p
                                                                        class="text-xs text-gray-500 uppercase tracking-wide">
                                                                        Yosh</p>
                                                                    <p class="text-sm font-semibold text-gray-900">
                                                                        {{ \Carbon\Carbon::parse($worker->user->userData->birthday)->age }}
                                                                        yosh
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        @endif

                                                        @if ($worker->user->userData->height)
                                                            <div class="flex items-center space-x-3">
                                                                <div
                                                                    class="flex-shrink-0 w-12 h-12 rounded-full bg-green-100 flex items-center justify-center">
                                                                    <span class="text-2xl">📏</span>
                                                                </div>
                                                                <div>
                                                                    <p
                                                                        class="text-xs text-gray-500 uppercase tracking-wide">
                                                                        Bo'y</p>
                                                                    <p class="text-sm font-semibold text-gray-900">
                                                                        {{ $worker->user->userData->height }} sm</p>
                                                                </div>
                                                            </div>
                                                        @endif

                                                        @if ($worker->user->userData->weight)
                                                            <div class="flex items-center space-x-3">
                                                                <div
                                                                    class="flex-shrink-0 w-12 h-12 rounded-full bg-orange-100 flex items-center justify-center">
                                                                    <span class="text-2xl">⚖️</span>
                                                                </div>
                                                                <div>
                                                                    <p
                                                                        class="text-xs text-gray-500 uppercase tracking-wide">
                                                                        Vazn</p>
                                                                    <p class="text-sm font-semibold text-gray-900">
                                                                        {{ $worker->user->userData->weight }} kg</p>
                                                                </div>
                                                            </div>
                                                        @endif

                                                    </div>

                                                    <!-- Manzil ma'lumotlari -->
                                                    @if ($worker->user->userData->address || $worker->user->userData->province)
                                                        <div class="bg-gray-50 rounded-xl p-6 mb-8">
                                                            <h3
                                                                class="text-lg font-bold text-gray-900 mb-3 flex items-center">
                                                                <svg class="w-5 h-5 mr-2 text-indigo-600"
                                                                    fill="currentColor" viewBox="0 0 20 20">
                                                                    <path fill-rule="evenodd"
                                                                        d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z"
                                                                        clip-rule="evenodd" />
                                                                </svg>
                                                                To'liq manzil
                                                            </h3>
                                                            <div class="space-y-2 text-gray-700">
                                                                @if ($worker->user->userData->country)
                                                                    <p class="flex items-center">
                                                                        <span
                                                                            class="w-24 text-sm text-gray-500">Mamlakat:</span>
                                                                        <span
                                                                            class="font-medium">{{ $worker->user->userData->country }}</span>
                                                                    </p>
                                                                @endif
                                                                @if ($worker->user->userData->province)
                                                                    <p class="flex items-center">
                                                                        <span
                                                                            class="w-24 text-sm text-gray-500">Viloyat:</span>
                                                                        <span
                                                                            class="font-medium">{{ $worker->user->userData->province }}</span>
                                                                    </p>
                                                                @endif
                                                                @if ($worker->user->userData->region)
                                                                    <p class="flex items-center">
                                                                        <span
                                                                            class="w-24 text-sm text-gray-500">Tuman:</span>
                                                                        <span
                                                                            class="font-medium">{{ $worker->user->userData->region }}</span>
                                                                    </p>
                                                                @endif
                                                                @if ($worker->user->userData->address)
                                                                    <p class="flex items-center">
                                                                        <span
                                                                            class="w-24 text-sm text-gray-500">Ko'cha:</span>
                                                                        <span
                                                                            class="font-medium">{{ $worker->user->userData->address }}</span>
                                                                    </p>
                                                                @endif
                                                            </div>

                                                            @if ($worker->user->userData->latitude && $worker->user->userData->longitude)
                                                                <a href="https://www.google.com/maps?q={{ $worker->user->userData->latitude }},{{ $worker->user->userData->longitude }}"
                                                                    target="_blank"
                                                                    class="inline-flex items-center mt-4 text-sm font-semibold text-indigo-600 hover:text-indigo-800 transition-colors">
                                                                    <svg class="w-4 h-4 mr-1" fill="none"
                                                                        stroke="currentColor" viewBox="0 0 24 24">
                                                                        <path stroke-linecap="round"
                                                                            stroke-linejoin="round" stroke-width="2"
                                                                            d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                                                    </svg>
                                                                    Xaritada ochish
                                                                </a>
                                                            @endif
                                                        </div>
                                                    @endif
                                                </div>

                                                <!-- Tugmalar -->
                                                <div class="flex flex-col sm:flex-row gap-4">
                                                    <a href="{{ route('workers.show', $worker->id) }}"
                                                        class="flex-1 flex items-center justify-center gap-3 rounded-xl bg-indigo-600 px-8 py-4 text-white font-semibold hover:bg-indigo-700 transition-all shadow-lg hover:shadow-xl hover:-translate-y-0.5">
                                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                                            <path fill-rule="evenodd"
                                                                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                                                clip-rule="evenodd" />
                                                        </svg>
                                                        <span>Batafsil ma'lumot</span>
                                                    </a>

                                                    @if ($worker->user->email)
                                                        <a href="mailto:{{ $worker->user->email }}"
                                                            class="flex-1 flex items-center justify-center gap-3 rounded-xl border-2 border-indigo-600 px-8 py-4 text-indigo-600 font-semibold hover:bg-indigo-50 transition-all">
                                                            <svg class="w-5 h-5" fill="currentColor"
                                                                viewBox="0 0 20 20">
                                                                <path
                                                                    d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                                                                <path
                                                                    d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                                                            </svg>
                                                            <span>Bog'lanish</span>
                                                        </a>
                                                    @endif
                                                </div>

                                            </div>

                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </section>

            </div>
        </div>
    </div>
</x-app-layout>
