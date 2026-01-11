<x-app-layout>
    <x-slot name="header">
        <div
            class="flex flex-col md:flex-row items-center justify-between bg-gradient-to-r from-white to-gray-50 shadow-lg rounded-2xl p-4 md:p-6 gap-4">
            <!-- Breadcrumb Navigation -->
            <div class="flex-1">
                <nav class="flex mb-2" aria-label="Breadcrumb">
                    <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
                        <li class="inline-flex items-center">
                            <a href="{{ route('dashboard') }}"
                                class="inline-flex items-center text-sm font-medium text-gray-500 hover:text-indigo-600">
                                <svg class="w-3 h-3 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z" />
                                </svg>
                                Bosh sahifa
                            </a>
                        </li>
                        <li>
                            <div class="flex items-center">
                                <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m1 9 4-4-4-4" />
                                </svg>
                                <a href="{{ route('workers.index') }}"
                                    class="ms-1 text-sm font-medium text-gray-500 hover:text-indigo-600">
                                    Ishcilar</a>
                            </div>
                        </li>
                        <li>
                            <div class="flex items-center">
                                <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m1 9 4-4-4-4" />
                                </svg>
                                <p class="ms-1 text-sm font-medium text-gray-500 hover:text-indigo-600">
                                    {{ $worker->user->name }}</p>
                            </div>
                        </li>
                    </ol>
                </nav>
            </div>

            <!-- Actions -->
            <div class="flex items-center gap-3">
                <a href="{{ route('workers.index') }}"
                    class="group inline-flex items-center gap-2 px-4 py-2.5 bg-white border border-gray-200 text-gray-700 font-medium rounded-xl hover:bg-gray-50 hover:border-gray-300 transition-all duration-200 shadow-sm hover:shadow">
                    <svg class="w-5 h-5 group-hover:-translate-x-0.5 transition-transform" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Orqaga
                </a>
                <button
                    class="group inline-flex items-center gap-2 px-5 py-2.5 bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-semibold rounded-xl hover:from-indigo-700 hover:to-purple-700 transition-all duration-200 shadow-md hover:shadow-lg">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                    </svg>
                    Taklif yuborish
                </button>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Profile Header -->
            <div class="mb-8">
                <div
                    class="relative bg-gradient-to-br from-blue-600 via-indigo-600 to-violet-700 rounded-3xl shadow-2xl overflow-hidden">
                    <!-- Animated Background -->
                    <div class="absolute inset-0 opacity-10">
                        <div
                            class="absolute inset-0 bg-[radial-gradient(circle_at_30%_20%,rgba(255,255,255,0.1),transparent_50%)]">
                        </div>
                        <div class="absolute inset-0 bg-gradient-to-b from-transparent via-transparent to-black/20">
                        </div>
                    </div>

                    <!-- Status Badge -->
                    <div class="absolute top-6 right-6 z-10">

                        <span
                            class="inline-flex items-center px-4 py-2 rounded-full backdrop-blur-md border bg-white text-sm font-bold uppercase tracking-wider">
                            @livewire('is-online-component', ['id' => $worker->user->id])
                        </span>
                    </div>

                    <div class="relative px-6 md:px-10 pb-10 md:pt-24">
                        <!-- Profile Content -->
                        <div class="flex flex-col md:flex-row items-center md:items-end gap-8">
                            <!-- Avatar -->
                            <div class="relative mt-20 md:-mt-32">
                                <div class="relative">
                                    <div
                                        class="h-52 w-52 md:mt-16 mt-0 md:h-64 md:w-64 rounded-[2.5rem] border-8 border-white/90 shadow-2xl overflow-hidden bg-gradient-to-br from-gray-100 to-gray-200">
                                        @if ($worker->user->avatar)
                                            <img class="h-full w-full object-cover transition-transform duration-500 hover:scale-110"
                                                src="{{ Storage::url($worker->user->avatar) }}"
                                                alt="{{ $worker->user->name }}">
                                        @else
                                            <div
                                                class="h-full w-full flex items-center justify-center bg-gradient-to-br from-indigo-500 to-purple-600">
                                                <span class="text-5xl font-bold text-white">
                                                    {{ substr($worker->user->userData->first_name, 0, 1) }}{{ substr($worker->user->userData->last_name, 0, 1) }}
                                                </span>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <!-- User Info -->
                            <div class="flex-1 text-center md:text-left">
                                <h1 class="text-4xl md:text-5xl font-black text-white mb-3 tracking-tight">
                                    {{ $worker->user->userData->first_name }} {{ $worker->user->userData->last_name }}
                                </h1>

                                <div class="flex flex-wrap justify-center md:justify-start gap-3 mb-6">
                                    <span
                                        class="inline-flex items-center px-4 py-2 bg-white/10 backdrop-blur-sm rounded-xl text-white/90 text-sm font-medium">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                        </svg>
                                        {{ $worker->user->userData->region }}, {{ $worker->user->userData->district }}
                                    </span>

                                    <span
                                        class="inline-flex items-center px-4 py-2 bg-white/20 backdrop-blur-sm rounded-xl text-white text-sm font-bold">
                                        @ {{ $worker->user->name }}
                                    </span>
                                </div>

                                <!-- Rating -->
                                @if ($worker->rating)
                                    <div class="flex items-center justify-center md:justify-start space-x-1">
                                        @for ($i = 1; $i <= 5; $i++)
                                            @if ($i <= floor($worker->rating))
                                                <svg class="w-6 h-6 text-yellow-400 fill-current" viewBox="0 0 20 20">
                                                    <path
                                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                                </svg>
                                            @elseif($i == ceil($worker->rating) && $worker->rating != floor($worker->rating))
                                                <svg class="w-6 h-6 text-yellow-400 fill-current" viewBox="0 0 20 20">
                                                    <defs>
                                                        <linearGradient id="half-star-{{ $worker->id }}"
                                                            x1="0%" y1="0%" x2="100%"
                                                            y2="0%">
                                                            <stop offset="50%" stop-color="#FBBF24" />
                                                            <stop offset="50%" stop-color="#D1D5DB" />
                                                        </linearGradient>
                                                    </defs>
                                                    <path fill="url(#half-star-{{ $worker->id }})"
                                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                                </svg>
                                            @else
                                                <svg class="w-6 h-6 text-gray-300 fill-current" viewBox="0 0 20 20">
                                                    <path
                                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                                </svg>
                                            @endif
                                        @endfor
                                        <span
                                            class="ml-2 text-white font-bold">{{ number_format($worker->rating, 1) }}</span>
                                        <span class="text-white/70 text-sm">({{ $worker->reviews_count ?? 0 }}
                                            sharh)</span>
                                    </div>
                                @endif
                            </div>

                            <!-- Contact Button -->
                            <div class="pb-4">
                                <a href="tel:{{ $worker->user->userContact->phone }}"
                                    class="group flex items-center justify-center gap-3 px-8 py-4 bg-white text-gray-900 rounded-2xl font-bold shadow-2xl hover:shadow-3xl transition-all duration-300 hover:-translate-y-1 active:scale-95">
                                    <div class="relative">
                                        <svg class="w-6 h-6 text-indigo-600 group-hover:scale-110 transition-transform"
                                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 01.502-1.21l4.493-1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                        </svg>
                                    </div>
                                    <span>Aloqaga chiqish</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Content Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                <!-- Left Column - Main Content -->
                <div class="lg:col-span-2 space-y-8">

                    <!-- About Card -->
                    <div class="bg-white rounded-3xl shadow-xl p-8 border border-gray-100">
                        <div class="flex items-center justify-between mb-6">
                            <h3 class="text-2xl font-bold text-gray-900 flex items-center gap-3">
                                <div class="p-2 bg-gradient-to-br from-blue-100 to-blue-200 rounded-xl">
                                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                Mutaxassis haqida
                            </h3>
                            <span class="text-sm font-medium text-gray-500 bg-gray-100 px-3 py-1 rounded-full">
                                {{ Str::length($worker->user->userData->bio ?? '') }} belgi
                            </span>
                        </div>

                        <div class="prose max-w-none">
                            @if ($worker->user->userData->bio)
                                <p
                                    class="text-gray-700 leading-relaxed text-lg bg-gradient-to-br from-gray-50 to-blue-50 p-6 rounded-2xl border border-gray-100">
                                    {{ $worker->user->userData->bio }}
                                </p>
                            @else
                                <div class="text-center py-12">
                                    <div
                                        class="w-24 h-24 bg-gradient-to-br from-gray-100 to-gray-200 rounded-2xl flex items-center justify-center mx-auto mb-4">
                                        <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                                        </svg>
                                    </div>
                                    <p class="text-gray-500 text-lg">Ushbu mutaxassis o'zi haqida batafsil ma'lumot
                                        qoldirmagan</p>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Skills & Specialties -->
                    @if ($worker->skills && count($worker->skills) > 0)
                        <div class="bg-white rounded-3xl shadow-xl p-8 border border-gray-100">
                            <h3 class="text-2xl font-bold text-gray-900 mb-6 flex items-center gap-3">
                                <div class="p-2 bg-gradient-to-br from-green-100 to-green-200 rounded-xl">
                                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                    </svg>
                                </div>
                                Ko'nikmalar va ixtisosliklar
                            </h3>

                            <div class="flex flex-wrap gap-3">
                                @foreach ($worker->skills as $skill)
                                    <span
                                        class="inline-flex items-center px-4 py-2 rounded-xl bg-gradient-to-r from-green-50 to-emerald-50 text-green-700 font-medium border border-green-200 hover:border-green-300 transition-colors">
                                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        {{ $skill }}
                                    </span>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- Social Media Links -->
                    <div class="bg-white rounded-3xl shadow-xl p-8 border border-gray-100">
                        <h3 class="text-2xl font-bold text-gray-900 mb-6 flex items-center gap-3">
                            <div class="p-2 bg-gradient-to-br from-purple-100 to-pink-100 rounded-xl">
                                <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9" />
                                </svg>
                            </div>
                            Ijtimoiy tarmoqlar
                        </h3>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <!-- Telegram -->
                            @if ($worker->user->userContact->telegram)
                                <a href="https://t.me/{{ ltrim($worker->user->userContact->telegram, '@') }}"
                                    target="_blank"
                                    class="group relative p-6 bg-gradient-to-r from-sky-500 to-blue-600 rounded-2xl text-white flex items-center justify-between overflow-hidden shadow-lg hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
                                    <div
                                        class="absolute inset-0 bg-gradient-to-r from-sky-600 to-blue-700 opacity-0 group-hover:opacity-100 transition-opacity">
                                    </div>
                                    <div class="relative flex items-center space-x-4">
                                        <div
                                            class="p-3 bg-white/20 rounded-xl backdrop-blur-sm group-hover:scale-110 transition-transform">
                                            <svg class="w-8 h-8" viewBox="0 0 24 24" fill="currentColor">
                                                <path
                                                    d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm5.562 8.158l-1.592 7.524c-.119.563-.43.7-.871.437l-2.403-1.773-1.159 1.116c-.129.129-.236.236-.483.236l.171-2.413 4.642-4.194c.203-.182-.044-.283-.313-.104l-5.74 3.618-2.476-.77c-.537-.163-.548-.537.112-.796l9.598-3.699c.448-.161.84.105.683.793z" />
                                            </svg>
                                        </div>
                                        <div>
                                            <span class="text-lg font-bold block">Telegram</span>
                                            <span
                                                class="text-sm opacity-90">{{ $worker->user->userContact->telegram }}</span>
                                        </div>
                                    </div>
                                    <svg class="w-5 h-5 opacity-50 group-hover:translate-x-1 transition-transform"
                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                            d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                    </svg>
                                </a>
                            @endif

                            <!-- Instagram -->
                            @if ($worker->user->userContact->instagram)
                                <a href="https://instagram.com/{{ ltrim($worker->user->userContact->instagram, '@') }}"
                                    target="_blank"
                                    class="group relative p-6 bg-gradient-to-r from-pink-500 via-red-500 to-orange-500 rounded-2xl text-white flex items-center justify-between overflow-hidden shadow-lg hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
                                    <div
                                        class="absolute inset-0 bg-gradient-to-r from-pink-600 via-red-600 to-orange-600 opacity-0 group-hover:opacity-100 transition-opacity">
                                    </div>
                                    <div class="relative flex items-center space-x-4">
                                        <div
                                            class="p-3 bg-white/20 rounded-xl backdrop-blur-sm group-hover:scale-110 transition-transform">
                                            <svg class="w-8 h-8" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <rect x="2" y="2" width="20" height="20" rx="5"
                                                    ry="5" stroke-width="2" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M16 11.37A4 4 0 1112.63 8 4 4 0 0116 11.37z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M17.5 6.5h.01" />
                                            </svg>
                                        </div>
                                        <div>
                                            <span class="text-lg font-bold block">Instagram</span>
                                            <span
                                                class="text-sm opacity-90">{{ $worker->user->userContact->instagram }}</span>
                                        </div>
                                    </div>
                                    <svg class="w-5 h-5 opacity-50 group-hover:translate-x-1 transition-transform"
                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                            d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                    </svg>
                                </a>
                            @endif

                            <!-- Facebook -->
                            @if ($worker->user->userContact->facebook)
                                <a href="https://facebook.com/{{ ltrim($worker->user->userContact->facebook, '@') }}"
                                    target="_blank"
                                    class="group relative p-6 bg-gradient-to-r from-blue-600 to-blue-800 rounded-2xl text-white flex items-center justify-between overflow-hidden shadow-lg hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
                                    <div
                                        class="absolute inset-0 bg-gradient-to-r from-blue-700 to-blue-900 opacity-0 group-hover:opacity-100 transition-opacity">
                                    </div>
                                    <div class="relative flex items-center space-x-4">
                                        <div
                                            class="p-3 bg-white/20 rounded-xl backdrop-blur-sm group-hover:scale-110 transition-transform">
                                            <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24">
                                                <path
                                                    d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" />
                                            </svg>
                                        </div>
                                        <div>
                                            <span class="text-lg font-bold block">Facebook</span>
                                            <span
                                                class="text-sm opacity-90">{{ $worker->user->userContact->facebook }}</span>
                                        </div>
                                    </div>
                                    <svg class="w-5 h-5 opacity-50 group-hover:translate-x-1 transition-transform"
                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                            d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                    </svg>
                                </a>
                            @endif
                        </div>
                    </div>

                    <!-- Location Card -->
                    <div class="bg-white rounded-3xl shadow-xl p-8 border border-gray-100">
                        <h3 class="text-2xl font-bold text-gray-900 mb-6 flex items-center gap-3">
                            <div class="p-2 bg-gradient-to-br from-amber-100 to-orange-100 rounded-xl">
                                <svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </div>
                            Manzil
                        </h3>

                        <div class="p-6 bg-gradient-to-br from-gray-50 to-blue-50 rounded-2xl border border-gray-100">
                            <div class="flex items-start space-x-4">
                                <div class="p-3 bg-white rounded-xl shadow-sm">
                                    <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <div class="space-y-2">
                                        <div class="flex items-center space-x-2">
                                            <span class="text-sm font-medium text-gray-500">Viloyat:</span>
                                            <span
                                                class="text-lg font-bold text-gray-900">{{ $worker->user->userData->region }}</span>
                                        </div>
                                        <div class="flex items-center space-x-2">
                                            <span class="text-sm font-medium text-gray-500">Tuman:</span>
                                            <span
                                                class="text-lg font-bold text-gray-900">{{ $worker->user->userData->district }}</span>
                                        </div>
                                        @if ($worker->user->userData->village)
                                            <div class="flex items-center space-x-2">
                                                <span class="text-sm font-medium text-gray-500">Mahalla:</span>
                                                <span
                                                    class="text-lg font-medium text-gray-800">{{ $worker->user->userData->village }}</span>
                                            </div>
                                        @endif
                                        @if ($worker->user->userData->address)
                                            <div class="flex items-center space-x-2 mt-3">
                                                <span class="text-sm font-medium text-gray-500">To'liq manzil:</span>
                                                <span
                                                    class="text-lg font-medium text-gray-800">{{ $worker->user->userData->address }}</span>
                                            </div>
                                        @endif
                                    </div>

                                    @if ($worker->user->userData->latitude && $worker->user->userData->longitude)
                                        <a href="https://www.google.com/maps?q={{ $worker->user->userData->latitude }},{{ $worker->user->userData->longitude }}"
                                            target="_blank"
                                            class="inline-flex items-center gap-2 mt-6 px-4 py-2 bg-white border border-gray-300 rounded-xl text-gray-700 font-medium hover:bg-gray-50 hover:border-gray-400 transition-colors">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7" />
                                            </svg>
                                            Xaritada ko'rish
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- Right Column - Sidebar -->
                <div class="space-y-8">

                    <!-- Personal Stats Card -->
                    <div class="bg-white rounded-3xl shadow-xl p-8 border border-gray-100">
                        <h3 class="text-2xl font-bold text-gray-900 mb-6 flex items-center gap-3">
                            <div class="p-2 bg-gradient-to-br from-indigo-100 to-purple-100 rounded-xl">
                                <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            </div>
                            Shaxsiy ma'lumotlar
                        </h3>

                        <div class="space-y-6">
                            <!-- Age -->
                            <div
                                class="flex items-center justify-between p-4 bg-gradient-to-r from-blue-50 to-indigo-50 rounded-2xl border border-blue-100">
                                <div class="flex items-center space-x-3">
                                    <div class="p-2 bg-white rounded-xl shadow-sm border border-blue-200">
                                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M21 15.546c-.523 0-1.046.151-1.5.454a2.704 2.704 0 01-3 0 2.704 2.704 0 00-3 0 2.704 2.704 0 01-3 0 2.704 2.704 0 00-3 0 2.704 2.704 0 01-3 0 2.701 2.701 0 00-1.5-.454M9 6v2m3-2v2m3-2v2M9 3h.01M12 3h.01M15 3h.01M21 21v-7a2 2 0 00-2-2H5a2 2 0 00-2 2v7h18zm-3-9v-2a2 2 0 00-2-2H8a2 2 0 00-2 2v2h12z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-gray-600">Yosh</p>
                                        <p class="text-lg font-bold text-gray-900">
                                            {{ $worker->user->userData->birthday ? \Carbon\Carbon::parse($worker->user->userData->birthday)->age . ' yosh' : '—' }}
                                        </p>
                                    </div>
                                </div>
                                <div class="text-xs font-medium px-3 py-1 bg-blue-100 text-blue-700 rounded-full">
                                    {{ $worker->user->userData->birthday ? \Carbon\Carbon::parse($worker->user->userData->birthday)->format('d.m.Y') : '—' }}
                                </div>
                            </div>

                            <!-- Gender -->
                            <div
                                class="flex items-center justify-between p-4 bg-gradient-to-r from-purple-50 to-pink-50 rounded-2xl border border-purple-100">
                                <div class="flex items-center space-x-3">
                                    <div class="p-2 bg-white rounded-xl shadow-sm border border-purple-200">
                                        @if ($worker->user->userData->gender === 'male')
                                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                            </svg>
                                        @else
                                            <svg class="w-5 h-5 text-pink-600" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5 3.5a5.5 5.5 0 01-9.5-4.5V2a5.5 5.5 0 015.5 5.5z" />
                                            </svg>
                                        @endif
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-gray-600">Jins</p>
                                        <p class="text-lg font-bold text-gray-900">
                                            {{ $worker->user->userData->gender === 'male' ? 'Erkak' : 'Ayol' }}
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <!-- Height -->
                            <div
                                class="flex items-center justify-between p-4 bg-gradient-to-r from-emerald-50 to-green-50 rounded-2xl border border-emerald-100">
                                <div class="flex items-center space-x-3">
                                    <div class="p-2 bg-white rounded-xl shadow-sm border border-emerald-200">
                                        <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-gray-600">Bo'y</p>
                                        <p class="text-lg font-bold text-gray-900">
                                            {{ $worker->user->userData->height }} cm
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <!-- Weight -->
                            <div
                                class="flex items-center justify-between p-4 bg-gradient-to-r from-amber-50 to-orange-50 rounded-2xl border border-amber-100">
                                <div class="flex items-center space-x-3">
                                    <div class="p-2 bg-white rounded-xl shadow-sm border border-amber-200">
                                        <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3" />
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-gray-600">Vazn</p>
                                        <p class="text-lg font-bold text-gray-900">
                                            {{ $worker->user->userData->weight }} kg
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Quick Contact Card -->
                    <div class="relative rounded-3xl shadow-2xl overflow-hidden">
                        <!-- Background Gradient -->
                        <div class="absolute inset-0 bg-gradient-to-br from-indigo-900 via-purple-900 to-violet-900">
                        </div>

                        <!-- Pattern Overlay -->
                        <div class="absolute inset-0 opacity-10">
                            <div
                                class="absolute inset-0 bg-[radial-gradient(circle_at_20%_80%,rgba(255,255,255,0.1),transparent_40%)]">
                            </div>
                        </div>

                        <!-- Content -->
                        <div class="relative p-8 text-white">
                            <div class="mb-6">
                                <span class="text-xs font-bold uppercase tracking-wider text-indigo-300 opacity-70">
                                    To'g'ridan-to'g'ri bog'lanish
                                </span>
                                <h4 class="text-2xl font-black mt-1">Telefon raqami</h4>
                            </div>

                            <a href="tel:{{ $worker->user->userContact->phone }}"
                                class="block p-6 bg-white/10 backdrop-blur-sm rounded-2xl border border-white/20 hover:bg-white/15 transition-colors mb-6">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <div class="flex items-center space-x-3">
                                            <div
                                                class="p-2 bg-gradient-to-br from-indigo-500 to-purple-500 rounded-lg">
                                                <svg class="w-6 h-6" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 01.502-1.21l4.493-1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                                </svg>
                                            </div>
                                            <span class="text-3xl font-black tracking-tight">
                                                {{ $worker->user->userContact->phone }}
                                            </span>
                                        </div>
                                    </div>
                                    <svg class="w-6 h-6 text-indigo-300" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                    </svg>
                                </div>
                            </a>

                            <div class="mt-8">
                                <p class="text-sm text-indigo-300 leading-relaxed">
                                    <span class="font-bold text-white">Eslatma:</span>
                                    Qo'ng'iroq qilganda ushbu platformadan raqamni olganingizni aytishni unutmang.
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Additional Info -->
                    <div class="bg-white rounded-3xl shadow-xl p-8 border border-gray-100">
                        <h3 class="text-xl font-bold text-gray-900 mb-6">Qo'shimcha ma'lumotlar</h3>

                        <div class="space-y-4">
                            <!-- Experience -->
                            @if ($worker->experience)
                                <div class="flex items-center justify-between p-4 bg-gray-50 rounded-xl">
                                    <span class="text-sm font-medium text-gray-600">Tajriba</span>
                                    <span class="text-lg font-bold text-gray-900">{{ $worker->experience }} yil</span>
                                </div>
                            @endif

                            <!-- Created At -->
                            <div class="flex items-center justify-between p-4 bg-gray-50 rounded-xl">
                                <span class="text-sm font-medium text-gray-600">Platformaga qo'shilgan</span>
                                <span
                                    class="text-sm font-medium text-gray-900">{{ $worker->created_at->format('d.m.Y') }}</span>
                            </div>

                            <!-- Profile Views -->
                            <div class="flex items-center justify-between p-4 bg-gray-50 rounded-xl">
                                <span class="text-sm font-medium text-gray-600">Profil ko'rishlar</span>
                                <span
                                    class="text-sm font-medium text-gray-900">{{ $worker->user->userData->views_count ?? 0 }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Call to Action -->
                    <button
                        class="w-full py-4 bg-gradient-to-r from-emerald-500 to-teal-600 text-white font-bold text-lg rounded-2xl hover:from-emerald-600 hover:to-teal-700 transition-all duration-300 shadow-xl hover:shadow-2xl transform hover:-translate-y-0.5 active:scale-95">
                        Ish taklifini yuborish
                    </button>

                </div>
            </div>
        </div>
    </div>

    <style>
        .prose {
            color: #374151;
        }

        .prose p {
            margin-top: 0;
            margin-bottom: 1rem;
            line-height: 1.75;
        }

        .gradient-text {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-10px);
            }
        }

        .animate-float {
            animation: float 3s ease-in-out infinite;
        }

        .backdrop-blur-md {
            backdrop-filter: blur(12px);
        }

        .backdrop-blur-sm {
            backdrop-filter: blur(8px);
        }
    </style>

</x-app-layout>
