<x-app-layout>
    <x-slot name="header">
        <div class="bg-gradient-to-r from-white via-gray-50 to-white shadow-lg rounded-2xl p-4 md:p-6">
            <!-- Header Content -->
            <div class="flex flex-col lg:flex-row items-start lg:items-center justify-between gap-6">
                <!-- Title and Stats -->
                <div class="flex-1">
                    <h1
                        class="text-3xl md:text-4xl font-bold bg-gradient-to-r from-gray-900 to-indigo-700 bg-clip-text text-transparent">
                        {{ __('Ishchilar') }}
                    </h1>
                    <p class="mt-2 text-gray-600 flex items-center gap-2">
                        <span
                            class="inline-flex items-center px-3 py-1 rounded-full bg-indigo-100 text-indigo-800 text-sm font-medium">
                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z" />
                            </svg>
                            {{ $workers->count() }} ta ishchi
                        </span>
                        <span class="text-sm">•</span>
                        <span class="text-gray-500">Sizga kerakli mutaxassisni toping</span>
                    </p>
                </div>

                <!-- Create Worker Button -->
                <a href="{{ route('workers.create') }}"
                    class="group relative inline-flex items-center gap-3 px-6 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-semibold rounded-xl hover:from-indigo-700 hover:to-purple-700 transition-all duration-300 shadow-lg hover:shadow-xl hover:-translate-y-0.5">
                    <div class="p-2 bg-white/20 rounded-lg backdrop-blur-sm">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                    </div>
                    <span>E'lon berish</span>
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Advanced Search Panel -->
            <div class="mb-8">
                <div class="bg-white rounded-2xl shadow-xl p-6 border border-gray-100">
                    <div class="flex items-center justify-between mb-6">
                        <div class="flex items-center gap-3">
                            <div class="p-2 bg-gradient-to-br from-blue-100 to-blue-200 rounded-xl">
                                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-xl font-bold text-gray-900">Ishchi qidiruv filtrlari</h3>
                                <p class="text-sm text-gray-500">Kerakli mezonlar bo'yicha mutaxassislarni toping</p>
                            </div>
                        </div>
                        <button id="resetFilters"
                            class="text-sm font-medium text-gray-500 hover:text-indigo-600 transition-colors">
                            Filtrlarni tozalash
                        </button>
                    </div>

                    <form id="searchForm" method="GET" class="space-y-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

                            <!-- Name Search -->
                            <div>
                                <label class="block">
                                    <span class="text-sm font-medium text-gray-700 mb-2 flex items-center gap-2">
                                        <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                        </svg>
                                        Ism bo'yicha qidirish
                                    </span>
                                    <input type="text" name="search" value="{{ request('search') }}"
                                        placeholder="Ishchi ismini kiriting..."
                                        class="mt-1 block w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 transition-all duration-200 hover:border-gray-400">
                                </label>
                            </div>

                            <!-- Location Filters -->
                            <div>
                                <label class="block">
                                    <span class="text-sm font-medium text-gray-700 mb-2 flex items-center gap-2">
                                        <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                        Manzil
                                    </span>
                                    <select name="region" id="region"
                                        class="location-select mt-1 block w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 transition-all duration-200 hover:border-gray-400">
                                        <option value="">Viloyatni tanlang</option>
                                        @foreach ($regions as $region)
                                            <option value="{{ $region->name_uz }}"
                                                data-districts='{{ $region->districts->map(function ($d) {
                                                        return ['id' => $d->id, 'name' => $d->name_uz, 'villages' => $d->villages->pluck('name_uz')];
                                                    })->toJson() }}'
                                                {{ request('region') == $region->name_uz ? 'selected' : '' }}>
                                                {{ $region->name_uz }}
                                            </option>
                                        @endforeach
                                    </select>
                                </label>
                            </div>

                            <div>
                                <label class="block">
                                    <span class="text-sm font-medium text-gray-700 mb-2">Tuman/Shahar</span>
                                    <select name="district" id="district"
                                        class="location-select mt-1 block w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 transition-all duration-200 hover:border-gray-400">
                                        <option value="">Tumanni tanlang</option>
                                        @if (request('district'))
                                            <option value="{{ request('district') }}" selected>{{ request('district') }}
                                            </option>
                                        @endif
                                    </select>
                                </label>
                            </div>

                            <div>
                                <label class="block">
                                    <span class="text-sm font-medium text-gray-700 mb-2">Qishloq/MFY</span>
                                    <select name="village" id="village"
                                        class="location-select mt-1 block w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 transition-all duration-200 hover:border-gray-400">
                                        <option value="">Qishloqni tanlang</option>
                                        @if (request('village'))
                                            <option value="{{ request('village') }}" selected>{{ request('village') }}
                                            </option>
                                        @endif
                                    </select>
                                </label>
                            </div>

                        </div>

                        <!-- Additional Filters -->
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 pt-4 border-t border-gray-200">
                            <!-- Gender Filter -->
                            <div>
                                <label class="block">
                                    <span class="text-sm font-medium text-gray-700 mb-2 flex items-center gap-2">
                                        <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5 3.5a5.5 5.5 0 01-9.5-4.5V2a5.5 5.5 0 015.5 5.5z" />
                                        </svg>
                                        Jins
                                    </span>
                                    <select name="gender"
                                        class="mt-1 block w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 transition-all duration-200 hover:border-gray-400">
                                        <option value="">Barcha jinslar</option>
                                        <option value="male" {{ request('gender') == 'male' ? 'selected' : '' }}>
                                            Erkak</option>
                                        <option value="female" {{ request('gender') == 'female' ? 'selected' : '' }}>
                                            Ayol</option>
                                    </select>
                                </label>
                            </div>

                            <!-- Age Range -->
                            <div>
                                <label class="block">
                                    <span class="text-sm font-medium text-gray-700 mb-2">Yosh oralig'i</span>
                                    <div class="grid grid-cols-2 gap-3">
                                        <input type="number" name="min_age" placeholder="Min yosh"
                                            value="{{ request('min_age') }}"
                                            class="block w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 transition-all duration-200 hover:border-gray-400">
                                        <input type="number" name="max_age" placeholder="Max yosh"
                                            value="{{ request('max_age') }}"
                                            class="block w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 transition-all duration-200 hover:border-gray-400">
                                    </div>
                                </label>
                            </div>

                            <!-- Height Range -->
                            <div>
                                <label class="block">
                                    <span class="text-sm font-medium text-gray-700 mb-2">Bo'y oralig'i (sm)</span>
                                    <div class="grid grid-cols-2 gap-3">
                                        <input type="number" name="min_height" placeholder="Min bo'y"
                                            value="{{ request('min_height') }}"
                                            class="block w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 transition-all duration-200 hover:border-gray-400">
                                        <input type="number" name="max_height" placeholder="Max bo'y"
                                            value="{{ request('max_height') }}"
                                            class="block w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 transition-all duration-200 hover:border-gray-400">
                                    </div>
                                </label>
                            </div>

                            <!-- Weight Range -->
                            <div>
                                <label class="block">
                                    <span class="text-sm font-medium text-gray-700 mb-2">Vazn oralig'i (kg)</span>
                                    <div class="grid grid-cols-2 gap-3">
                                        <input type="number" name="min_weight" placeholder="Min vazn"
                                            value="{{ request('min_weight') }}"
                                            class="block w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 transition-all duration-200 hover:border-gray-400">
                                        <input type="number" name="max_weight" placeholder="Max vazn"
                                            value="{{ request('max_weight') }}"
                                            class="block w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 transition-all duration-200 hover:border-gray-400">
                                    </div>
                                </label>
                            </div>
                        </div>

                        <!-- Search Button -->
                        <div class="pt-4 border-t border-gray-200">
                            <div class="flex justify-end">
                                <button type="submit"
                                    class="group inline-flex items-center gap-3 px-8 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-semibold rounded-xl hover:from-indigo-700 hover:to-purple-700 transition-all duration-300 shadow-lg hover:shadow-xl hover:-translate-y-0.5">
                                    <svg class="w-5 h-5 group-hover:rotate-12 transition-transform" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                    </svg>
                                    <span>Ishchilarni qidirish</span>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Active Filters -->
            @if (request()->anyFilled([
                    'search',
                    'region',
                    'gender',
                    'district',
                    'village',
                    'min_age',
                    'max_age',
                    'min_height',
                    'max_height',
                    'min_weight',
                    'max_weight',
                ]))
                <div class="mb-6">
                    <div class="flex flex-wrap gap-2">
                        @if (request('search'))
                            <span
                                class="inline-flex items-center gap-1 px-3 py-2 rounded-full bg-blue-100 text-blue-800 text-sm font-medium">
                                "{{ request('search') }}"
                                <button type="button" onclick="removeFilter('search')"
                                    class="ml-1 hover:text-blue-900">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            </span>
                        @endif

                        @if (request('region'))
                            <span
                                class="inline-flex items-center gap-1 px-3 py-2 rounded-full bg-purple-100 text-purple-800 text-sm font-medium">
                                {{ request('region') }}
                                <button type="button" onclick="removeFilter('region')"
                                    class="ml-1 hover:text-purple-900">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            </span>
                        @endif

                        @if (request('gender'))
                            <span
                                class="inline-flex items-center gap-1 px-3 py-2 rounded-full bg-pink-100 text-pink-800 text-sm font-medium">
                                {{ request('gender') == 'male' ? 'Erkak' : 'Ayol' }}
                                <button type="button" onclick="removeFilter('gender')"
                                    class="ml-1 hover:text-pink-900">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            </span>
                        @endif

                        <!-- Show Clear All button if any filters active -->
                        @if (request()->anyFilled([
                                'search',
                                'region',
                                'gender',
                                'district',
                                'village',
                                'min_age',
                                'max_age',
                                'min_height',
                                'max_height',
                                'min_weight',
                                'max_weight',
                            ]))
                            <a href="{{ route('workers.index') }}"
                                class="inline-flex items-center gap-1 px-3 py-2 rounded-full bg-gray-100 text-gray-800 text-sm font-medium hover:bg-gray-200 transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12" />
                                </svg>
                                Barcha filtrlarni tozalash
                            </a>
                        @endif
                    </div>
                </div>
            @endif

            <!-- Results Section -->
            <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
                <!-- Results Header -->
                <div class="px-6 py-4 bg-gradient-to-r from-gray-50 to-gray-100 border-b border-gray-200">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                        <div>
                            <h2 class="text-xl font-bold text-gray-900">Topilgan ishchilar</h2>
                            <p class="text-sm text-gray-600 mt-1">
                                @if ($workers->count() > 0)
                                    <span class="font-medium text-indigo-600">{{ $workers->count() }}</span> ta ishchi
                                    topildi
                                @else
                                    Hech qanday ishchi topilmadi
                                @endif
                            </p>
                        </div>
                        <div class="mt-3 sm:mt-0">
                            <select id="sortSelect"
                                class="block w-full sm:w-auto rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm">
                                <option value="newest">Yangi qo'shilgan</option>
                                <option value="oldest">Avval qo'shilgan</option>
                                <option value="age_young">Yosh bo'yicha (yosh)</option>
                                <option value="age_old">Yosh bo'yicha (katta)</option>
                                <option value="name_asc">Ism bo'yicha (A-Z)</option>
                                <option value="name_desc">Ism bo'yicha (Z-A)</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Workers Grid -->
                @if ($workers->count() > 0)
                    <div class="p-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach ($workers as $worker)
                                <div
                                    class="group relative bg-white rounded-2xl border border-gray-200 hover:border-indigo-300 hover:shadow-2xl transition-all duration-300 hover:-translate-y-2 overflow-hidden">

                                    <!-- Premium Badge -->
                                    @if ($worker->is_verified)
                                        <div class="absolute top-3 right-3 z-10">
                                            <span
                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-gradient-to-r from-green-400 to-emerald-500 text-white">
                                                <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd"
                                                        d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                                Tasdiqlangan
                                            </span>
                                        </div>
                                    @endif

                                    <!-- Status Badge -->
                                    <div class="absolute top-3 left-3 z-10">
                                        @php
                                            $statusColor =
                                                $worker->status === 'available'
                                                    ? 'bg-emerald-500 text-white'
                                                    : ($worker->status === 'busy'
                                                        ? 'bg-amber-500 text-white'
                                                        : 'bg-gray-500 text-white');
                                            $statusText =
                                                $worker->status === 'available'
                                                    ? 'Bo\'sh'
                                                    : ($worker->status === 'busy'
                                                        ? 'Band'
                                                        : 'Noma\'lum');
                                        @endphp
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $statusColor }}">
                                            @if ($worker->status === 'available')
                                                <svg class="w-3 h-3 mr-1 animate-pulse" fill="currentColor"
                                                    viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd"
                                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                            @endif
                                            {{ $statusText }}
                                        </span>
                                    </div>

                                    <!-- Worker Image -->
                                    <div
                                        class="relative h-64 overflow-hidden bg-gradient-to-br from-gray-100 to-gray-200">
                                        @if ($worker->user->avatar)
                                            <img src="{{ Storage::url($worker->user->avatar) }}"
                                                alt="{{ $worker->user->userData->first_name ?? $worker->user->name }}"
                                                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                        @else
                                            <div
                                                class="w-full h-full flex items-center justify-center bg-gradient-to-br from-indigo-100 to-purple-100">
                                                <div class="text-center">
                                                    <div
                                                        class="w-24 h-24 rounded-full bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center text-white text-3xl font-bold mx-auto mb-4">
                                                        {{ strtoupper(substr($worker->user->userData->first_name ?? $worker->user->name, 0, 1)) }}{{ strtoupper(substr($worker->user->userData->last_name ?? '', 0, 1)) }}
                                                    </div>
                                                    <span
                                                        class="text-sm font-medium text-indigo-700">{{ $worker->user->userData->first_name ?? $worker->user->name }}</span>
                                                </div>
                                            </div>
                                        @endif
                                    </div>

                                    <!-- Worker Content -->
                                    <div class="p-5">
                                        <!-- Name -->
                                        <h3
                                            class="text-xl font-bold text-gray-900 mb-1 group-hover:text-indigo-600 transition-colors">
                                            {{ $worker->user->userData->first_name ?? $worker->user->name }}
                                            {{ $worker->user->userData->last_name ?? '' }}
                                        </h3>

                                        <!-- Location -->
                                        <div class="flex items-center text-sm text-gray-500 mb-4">
                                            <svg class="w-4 h-4 mr-2 flex-shrink-0" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                            </svg>
                                            <span class="truncate">
                                                {{ $worker->user->userData->district ?? '' }},
                                                {{ $worker->user->userData->region ?? '' }}
                                            </span>
                                        </div>

                                        <!-- Short Bio -->
                                        @if ($worker->user->userData->bio)
                                            <p class="text-gray-600 mb-4 text-sm line-clamp-2">
                                                {{ Str::limit($worker->user->userData->bio, 100) }}
                                            </p>
                                        @endif

                                        <!-- Personal Stats -->
                                        <div class="grid grid-cols-2 gap-3 mb-4">
                                            <!-- Age -->
                                            @if ($worker->user->userData->birthday)
                                                <div class="flex items-center text-sm">
                                                    <div
                                                        class="w-8 h-8 rounded-lg bg-blue-50 flex items-center justify-center mr-2">
                                                        <span class="text-blue-600">🎂</span>
                                                    </div>
                                                    <div>
                                                        <p class="font-medium text-gray-900">
                                                            {{ \Carbon\Carbon::parse($worker->user->userData->birthday)->age }}
                                                            yosh</p>
                                                    </div>
                                                </div>
                                            @endif

                                            <!-- Gender -->
                                            @if ($worker->user->userData->gender)
                                                <div class="flex items-center text-sm">
                                                    <div
                                                        class="w-8 h-8 rounded-lg bg-purple-50 flex items-center justify-center mr-2">
                                                        <span
                                                            class="text-purple-600">{{ $worker->user->userData->gender === 'male' ? '👨' : '👩' }}</span>
                                                    </div>
                                                    <div>
                                                        <p class="font-medium text-gray-900">
                                                            {{ $worker->user->userData->gender === 'male' ? 'Erkak' : 'Ayol' }}
                                                        </p>
                                                    </div>
                                                </div>
                                            @endif

                                            <!-- Height -->
                                            @if ($worker->user->userData->height)
                                                <div class="flex items-center text-sm">
                                                    <div
                                                        class="w-8 h-8 rounded-lg bg-green-50 flex items-center justify-center mr-2">
                                                        <span class="text-green-600">📏</span>
                                                    </div>
                                                    <div>
                                                        <p class="font-medium text-gray-900">
                                                            {{ $worker->user->userData->height }} sm</p>
                                                    </div>
                                                </div>
                                            @endif

                                            <!-- Weight -->
                                            @if ($worker->user->userData->weight)
                                                <div class="flex items-center text-sm">
                                                    <div
                                                        class="w-8 h-8 rounded-lg bg-orange-50 flex items-center justify-center mr-2">
                                                        <span class="text-orange-600">⚖️</span>
                                                    </div>
                                                    <div>
                                                        <p class="font-medium text-gray-900">
                                                            {{ $worker->user->userData->weight }} kg</p>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>

                                        <!-- Skills (if available) -->
                                        @if ($worker->skills && count($worker->skills) > 0)
                                            <div class="mb-4">
                                                <div class="flex flex-wrap gap-1">
                                                    @foreach ($worker->skills as $skill)
                                                        @if ($loop->index < 3)
                                                            <span
                                                                class="inline-flex items-center px-2 py-1 rounded-full text-xs bg-gray-100 text-gray-700">
                                                                {{ $skill }}
                                                            </span>
                                                        @endif
                                                    @endforeach
                                                    @if (count($worker->skills) > 3)
                                                        <span
                                                            class="inline-flex items-center px-2 py-1 rounded-full text-xs bg-gray-100 text-gray-500">
                                                            +{{ count($worker->skills) - 3 }}
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        @endif

                                        <!-- Footer - Contact & Actions -->
                                        <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                                            <!-- Contact Info -->
                                            @if ($worker->user->userContact)
                                                <div class="flex items-center">
                                                    <a href="tel:{{ $worker->user->userContact->phone }}"
                                                        class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-indigo-100 text-indigo-600 hover:bg-indigo-200 transition-colors">
                                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                                            <path
                                                                d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z" />
                                                        </svg>
                                                    </a>
                                                    @if ($worker->user->userContact->telegram)
                                                        <a href="https://t.me/{{ ltrim($worker->user->userContact->telegram, '@') }}"
                                                            target="_blank"
                                                            class="ml-2 inline-flex items-center justify-center w-8 h-8 rounded-lg bg-blue-100 text-blue-600 hover:bg-blue-200 transition-colors">
                                                            <svg class="w-4 h-4" viewBox="0 0 24 24"
                                                                fill="currentColor">
                                                                <path
                                                                    d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm5.562 8.158l-1.592 7.524c-.119.563-.43.7-.871.437l-2.403-1.773-1.159 1.116c-.129.129-.236.236-.483.236l.171-2.413 4.642-4.194c.203-.182-.044-.283-.313-.104l-5.74 3.618-2.476-.77c-.537-.163-.548-.537.112-.796l9.598-3.699c.448-.161.84.105.683.793z" />
                                                            </svg>
                                                        </a>
                                                    @endif
                                                </div>
                                            @endif

                                            <!-- View Profile Button -->
                                            <a href="{{ route('workers.show', $worker->id) }}"
                                                class="inline-flex items-center justify-center px-4 py-2 bg-gradient-to-r from-indigo-600 to-purple-600 text-white text-sm font-medium rounded-lg hover:from-indigo-700 hover:to-purple-700 transition-all duration-300 shadow-sm hover:shadow">
                                                Profilni ko'rish
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Pagination -->
                        @if ($workers->hasPages())
                            <div class="mt-8 border-t border-gray-200 pt-6">
                                <div class="flex justify-center">
                                    {{ $workers->links() }}
                                </div>
                            </div>
                        @endif

                    </div>
                @else
                    <!-- Empty State -->
                    <div class="text-center py-16">
                        <div
                            class="w-24 h-24 bg-gradient-to-br from-gray-100 to-gray-200 rounded-full flex items-center justify-center mx-auto mb-6">
                            <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Ishchilar topilmadi</h3>
                        <p class="text-gray-600 mb-6 max-w-md mx-auto">
                            Kechirasiz, sizning qidiruv mezonlaringizga mos keladigan ishchilar hozircha mavjud emas.
                        </p>
                        <a href="{{ route('workers.index') }}"
                            class="inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-medium rounded-xl hover:from-indigo-700 hover:to-purple-700 transition-all duration-300 shadow-lg hover:shadow-xl">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                            Barcha filtrlarni tozalash
                        </a>
                    </div>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>

<style>
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .location-select {
        transition: all 0.2s ease;
    }

    .location-select:hover {
        border-color: #9ca3af;
    }

    .location-select:focus {
        border-color: #6366f1;
        box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
    }

    /* Custom scrollbar for selects */
    select {
        scrollbar-width: thin;
        scrollbar-color: #c7d2fe #f3f4f6;
    }

    select::-webkit-scrollbar {
        width: 6px;
    }

    select::-webkit-scrollbar-track {
        background: #f3f4f6;
        border-radius: 3px;
    }

    select::-webkit-scrollbar-thumb {
        background-color: #c7d2fe;
        border-radius: 3px;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const regionSelect = document.getElementById('region');
        const districtSelect = document.getElementById('district');
        const villageSelect = document.getElementById('village');
        const searchForm = document.getElementById('searchForm');
        const sortSelect = document.getElementById('sortSelect');
        const resetFiltersBtn = document.getElementById('resetFilters');

        // Get current URL parameters
        const urlParams = new URLSearchParams(window.location.search);
        const currentRegion = urlParams.get('region');
        const currentDistrict = urlParams.get('district');
        const currentVillage = urlParams.get('village');

        // Initialize region change handler
        regionSelect.addEventListener('change', function() {
            updateDistricts(this);
            submitSearch(); // Auto-submit on region change
        });

        // District change handler
        districtSelect.addEventListener('change', function() {
            updateVillages(this);
            if (this.value) {
                submitSearch(); // Auto-submit on district change
            }
        });

        // Village change handler
        villageSelect.addEventListener('change', function() {
            if (this.value) {
                submitSearch(); // Auto-submit on village change
            }
        });

        // Other filters change handlers
        document.querySelectorAll(
            'select[name="gender"], input[name="min_age"], input[name="max_age"], input[name="min_height"], input[name="max_height"], input[name="min_weight"], input[name="max_weight"]'
            ).forEach(input => {
            // For selects, submit on change
            if (input.tagName === 'SELECT') {
                input.addEventListener('change', function() {
                    if (this.value) {
                        submitSearch();
                    }
                });
            }
            // For number inputs, submit on blur
            if (input.tagName === 'INPUT') {
                input.addEventListener('blur', function() {
                    if (this.value) {
                        submitSearch();
                    }
                });
            }
        });

        // Search input with debounce
        const searchInput = document.querySelector('input[name="search"]');
        if (searchInput) {
            let searchTimeout;
            searchInput.addEventListener('input', function() {
                clearTimeout(searchTimeout);
                searchTimeout = setTimeout(() => {
                    if (this.value.length >= 2 || this.value.length === 0) {
                        submitSearch();
                    }
                }, 500);
            });
        }

        // Sort handler
        if (sortSelect) {
            sortSelect.value = urlParams.get('sort') || 'newest';
            sortSelect.addEventListener('change', function() {
                urlParams.set('sort', this.value);
                window.location.search = urlParams.toString();
            });
        }

        // Reset filters
        if (resetFiltersBtn) {
            resetFiltersBtn.addEventListener('click', function() {
                window.location.href = "{{ route('workers.index') }}";
            });
        }

        // Function to update districts based on selected region
        function updateDistricts(regionSelect) {
            const selectedOption = regionSelect.options[regionSelect.selectedIndex];
            const districtsData = selectedOption.dataset.districts;

            districtSelect.innerHTML = '<option value="">Tumanni tanlang</option>';
            villageSelect.innerHTML = '<option value="">Avval tumanni tanlang</option>';

            if (!districtsData) return;

            try {
                const districts = JSON.parse(districtsData);
                districts.forEach(district => {
                    const option = document.createElement('option');
                    option.value = district.name;
                    option.textContent = district.name;
                    option.dataset.villages = JSON.stringify(district.villages);
                    districtSelect.appendChild(option);
                });

                // If there's a current district in URL, select it
                if (currentDistrict && districts.some(d => d.name === currentDistrict)) {
                    districtSelect.value = currentDistrict;
                    updateVillages(districtSelect);
                }
            } catch (error) {
                console.error('Error parsing districts:', error);
            }
        }

        // Function to update villages based on selected district
        function updateVillages(districtSelect) {
            const selectedOption = districtSelect.options[districtSelect.selectedIndex];
            const villagesData = selectedOption.dataset.villages;

            villageSelect.innerHTML = '<option value="">Qishloqni tanlang</option>';

            if (!villagesData) return;

            try {
                const villages = JSON.parse(villagesData);
                villages.forEach(village => {
                    const option = document.createElement('option');
                    option.value = village;
                    option.textContent = village;
                    villageSelect.appendChild(option);
                });

                // If there's a current village in URL, select it
                if (currentVillage && villages.includes(currentVillage)) {
                    villageSelect.value = currentVillage;
                }
            } catch (error) {
                console.error('Error parsing villages:', error);
            }
        }

        // Function to submit search form
        function submitSearch() {
            // Remove empty values from form data
            const formData = new FormData(searchForm);
            const params = new URLSearchParams();

            for (const [key, value] of formData.entries()) {
                if (value && value.trim() !== '') {
                    params.append(key, value);
                }
            }

            // Add sort parameter if exists
            if (sortSelect && sortSelect.value) {
                params.append('sort', sortSelect.value);
            }

            // Submit the form via GET request
            window.location.href = `{{ route('workers.index') }}?${params.toString()}`;
        }

        // Initialize form with current values
        if (currentRegion) {
            updateDistricts(regionSelect);
        }

        // Filter removal functions
        window.removeFilter = function(filterName) {
            const url = new URL(window.location.href);
            url.searchParams.delete(filterName);
            window.location.href = url.toString();
        };

        // Debounce function for inputs
        function debounce(func, wait) {
            let timeout;
            return function executedFunction(...args) {
                const later = () => {
                    clearTimeout(timeout);
                    func(...args);
                };
                clearTimeout(timeout);
                timeout = setTimeout(later, wait);
            };
        }

        // Apply debounce to number inputs
        const debouncedSubmit = debounce(submitSearch, 1000);
        document.querySelectorAll('input[type="number"]').forEach(input => {
            input.addEventListener('input', debouncedSubmit);
        });
    });
</script>
