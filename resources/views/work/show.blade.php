<x-app-layout>

    <x-slot name="header">
        <div
            class="flex flex-col md:flex-row items-center justify-between bg-white shadow-sm rounded-xl p-4 md:p-6 gap-4">
            <!-- Breadcrumb and Title -->
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
                                <a href="{{ route('works.index') }}"
                                    class="ms-1 text-sm font-medium text-gray-500 hover:text-indigo-600">Ishlar</a>
                            </div>
                        </li>
                        <li aria-current="page">
                            <div class="flex items-center">
                                <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m1 9 4-4-4-4" />
                                </svg>
                                <span
                                    class="ms-1 text-sm font-medium text-gray-900">{{ Str::limit($work->name, 30) }}</span>
                            </div>
                        </li>
                    </ol>
                </nav>
                <h2 class="text-2xl md:text-3xl font-bold text-gray-900 tracking-tight">
                    {{ $work->name }}
                </h2>
            </div>

            <!-- Actions -->
            <div class="flex items-center gap-3">
                <a href="{{ route('works.index') }}"
                    class="inline-flex items-center gap-2 px-4 py-2.5 bg-white border border-gray-300 text-gray-700 font-medium rounded-lg hover:bg-gray-50 transition-all duration-200 shadow-sm hover:shadow">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Orqaga
                </a>
                @if (auth()->user()->id == $work->user->id)
                    <button
                        class="inline-flex items-center gap-2 px-5 py-2.5 bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-semibold rounded-lg hover:from-indigo-700 hover:to-purple-700 transition-all duration-200 shadow-md hover:shadow-lg">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Ariza holati faol
                    </button>
                @else
                    <button
                        class="inline-flex items-center gap-2 px-5 py-2.5 bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-semibold rounded-lg hover:from-indigo-700 hover:to-purple-700 transition-all duration-200 shadow-md hover:shadow-lg">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Ariza berish
                    </button>
                @endif


            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Main Content Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                <!-- Left Column - Main Content -->
                <div class="lg:col-span-2 space-y-8">

                    <!-- Image Gallery with Modern Carousel -->
                    <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                        @if ($work->images && $work->images->count() > 0)
                            <div class="relative">
                                <!-- Main Image -->
                                <div class="aspect-w-16 aspect-h-9">
                                    <img id="mainImage" src="{{ Storage::url($work->images->first()->image) }}"
                                        alt="{{ $work->name }}" class="w-full h-96 object-cover">
                                </div>

                                <!-- Image Navigation -->
                                <div class="absolute inset-x-0 bottom-4 flex justify-center">
                                    <div class="flex space-x-2">
                                        @foreach ($work->images as $index => $image)
                                            <button onclick="changeImage({{ $index }})"
                                                class="image-thumbnail w-16 h-12 rounded-lg overflow-hidden border-2 border-transparent hover:border-indigo-500 transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                                                <img src="{{ Storage::url($image->image) }}"
                                                    alt="Thumbnail {{ $index + 1 }}"
                                                    class="w-full h-full object-cover">
                                            </button>
                                        @endforeach
                                    </div>
                                </div>

                                <!-- Image Counter -->
                                <div
                                    class="absolute top-4 right-4 bg-black/50 text-white px-3 py-1 rounded-full text-sm">
                                    <span id="currentImage">1</span> / {{ $work->images->count() }}
                                </div>
                            </div>
                        @else
                            <div
                                class="aspect-w-16 aspect-h-9 bg-gradient-to-br from-gray-100 to-gray-200 flex items-center justify-center rounded-2xl">
                                <div class="text-center">
                                    <svg class="w-24 h-24 text-gray-400 mx-auto mb-4" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                            d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                                    </svg>
                                    <p class="text-gray-500 text-lg font-medium">Rasm mavjud emas</p>
                                </div>
                            </div>
                        @endif
                    </div>

                    <!-- Job Details Card -->
                    <div class="bg-white rounded-2xl shadow-lg p-6 md:p-8">

                        <!-- Price and Type Badge -->
                        <div
                            class="flex flex-col md:flex-row md:items-center justify-between mb-8 pb-8 border-b border-gray-100">
                            <div>
                                @if ($work->price)
                                    <div class="mb-2">
                                        <span
                                            class="text-4xl font-bold text-gray-900">{{ number_format($work->price, 0, '.', ' ') }}</span>
                                        <span class="text-lg text-gray-600">so'm</span>
                                    </div>
                                    <p class="text-sm text-gray-500">Ish uchun to'lov</p>
                                @endif
                            </div>
                            <div class="mt-4 md:mt-0">
                                <span
                                    class="inline-flex items-center px-4 py-2 rounded-full text-sm font-semibold bg-gradient-to-r from-indigo-100 to-purple-100 text-indigo-700 border border-indigo-200">
                                    {{ $work->type }}
                                </span>
                            </div>
                        </div>

                        <!-- Description -->
                        <div class="mb-8">
                            <h3 class="text-xl font-bold text-gray-900 mb-4 flex items-center gap-2">
                                <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                Ish haqida
                            </h3>
                            <div class="prose max-w-none">
                                <p class="text-gray-700 leading-relaxed whitespace-pre-line bg-gray-50 rounded-xl p-6">
                                    {{ $work->description }}</p>
                            </div>
                        </div>

                        <!-- Requirements Grid -->
                        <div class="mb-8">
                            <h3 class="text-xl font-bold text-gray-900 mb-6 flex items-center gap-2">
                                <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                </svg>
                                Talablar
                            </h3>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- People Required -->
                                <div
                                    class="flex items-center p-4 bg-gradient-to-r from-blue-50 to-indigo-50 rounded-xl border border-blue-100">
                                    <div
                                        class="flex-shrink-0 w-12 h-12 bg-white rounded-xl flex items-center justify-center shadow-sm border border-blue-200">
                                        <svg class="w-6 h-6 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                            <path
                                                d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z" />
                                        </svg>
                                    </div>
                                    <div class="ml-4">
                                        <p class="text-sm font-medium text-gray-600">Ishchilar soni</p>
                                        <p class="text-lg font-bold text-gray-900">{{ $work->how_much_people }} kishi
                                        </p>
                                    </div>
                                </div>

                                <!-- Gender -->
                                @if ($work->gender)
                                    <div
                                        class="flex items-center p-4 bg-gradient-to-r from-purple-50 to-pink-50 rounded-xl border border-purple-100">
                                        <div
                                            class="flex-shrink-0 w-12 h-12 bg-white rounded-xl flex items-center justify-center shadow-sm border border-purple-200">
                                            @if ($work->gender === 'male')
                                                <span class="text-2xl">👨</span>
                                            @elseif($work->gender === 'female')
                                                <span class="text-2xl">👩</span>
                                            @else
                                                <span class="text-2xl">👥</span>
                                            @endif
                                        </div>
                                        <div class="ml-4">
                                            <p class="text-sm font-medium text-gray-600">Jins</p>
                                            <p class="text-lg font-bold text-gray-900">
                                                {{ $work->gender === 'male' ? 'Erkak' : ($work->gender === 'female' ? 'Ayol' : 'Farqi yo\'q') }}
                                            </p>
                                        </div>
                                    </div>
                                @endif

                                <!-- Age -->
                                @if ($work->age)
                                    <div
                                        class="flex items-center p-4 bg-gradient-to-r from-green-50 to-emerald-50 rounded-xl border border-green-100">
                                        <div
                                            class="flex-shrink-0 w-12 h-12 bg-white rounded-xl flex items-center justify-center shadow-sm border border-green-200">
                                            <svg class="w-6 h-6 text-green-600" fill="currentColor"
                                                viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                        <div class="ml-4">
                                            <p class="text-sm font-medium text-gray-600">Yosh</p>
                                            <p class="text-lg font-bold text-gray-900">{{ $work->age }} yosh</p>
                                        </div>
                                    </div>
                                @endif

                                <!-- Lunch -->
                                <div
                                    class="flex items-center p-4 bg-gradient-to-r from-orange-50 to-amber-50 rounded-xl border border-orange-100">
                                    <div
                                        class="flex-shrink-0 w-12 h-12 bg-white rounded-xl flex items-center justify-center shadow-sm border border-orange-200">
                                        @if ($work->lunch)
                                            <svg class="w-6 h-6 text-orange-600" fill="currentColor"
                                                viewBox="0 0 20 20">
                                                <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z" />
                                                <path fill-rule="evenodd"
                                                    d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        @else
                                            <svg class="w-6 h-6 text-gray-400" fill="currentColor"
                                                viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        @endif
                                    </div>
                                    <div class="ml-4">
                                        <p class="text-sm font-medium text-gray-600">Ovqatlanish</p>
                                        <p
                                            class="text-lg font-bold {{ $work->lunch ? 'text-green-600' : 'text-gray-600' }}">
                                            {{ $work->lunch ? 'Tushlik beriladi' : 'Tushlik berilmaydi' }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Time Schedule -->
                        <div>
                            <h3 class="text-xl font-bold text-gray-900 mb-6 flex items-center gap-2">
                                <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                Ish vaqti
                            </h3>

                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                <!-- Start Date -->
                                <div
                                    class="text-center p-6 bg-gradient-to-br from-indigo-50 to-blue-50 rounded-2xl border border-indigo-100">
                                    <div
                                        class="w-12 h-12 bg-white rounded-full flex items-center justify-center mx-auto mb-4 shadow-sm border border-indigo-200">
                                        <svg class="w-6 h-6 text-indigo-600" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    <p class="text-sm font-medium text-gray-600 mb-2">Boshlanish sanasi</p>
                                    <p class="text-lg font-bold text-gray-900">{{ $work->when->format('d F Y') }}</p>
                                </div>

                                <!-- Work Hours -->
                                <div
                                    class="text-center p-6 bg-gradient-to-br from-purple-50 to-pink-50 rounded-2xl border border-purple-100">
                                    <div
                                        class="w-12 h-12 bg-white rounded-full flex items-center justify-center mx-auto mb-4 shadow-sm border border-purple-200">
                                        <svg class="w-6 h-6 text-purple-600" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    <p class="text-sm font-medium text-gray-600 mb-2">Ish vaqti</p>
                                    <p class="text-lg font-bold text-gray-900">
                                        {{ \Carbon\Carbon::parse($work->start_time)->format('H:i') }} -
                                        {{ \Carbon\Carbon::parse($work->finish_time)->format('H:i') }}
                                    </p>
                                </div>

                                <!-- Duration -->
                                <div
                                    class="text-center p-6 bg-gradient-to-br from-emerald-50 to-teal-50 rounded-2xl border border-emerald-100">
                                    <div
                                        class="w-12 h-12 bg-white rounded-full flex items-center justify-center mx-auto mb-4 shadow-sm border border-emerald-200">
                                        <svg class="w-6 h-6 text-emerald-600" fill="currentColor"
                                            viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    <p class="text-sm font-medium text-gray-600 mb-2">Davomiyligi</p>
                                    <p class="text-lg font-bold text-gray-900">{{ $work->duration }} kun</p>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- Right Column - Sidebar -->
                <div class="space-y-8">

                    <!-- Employer Card -->
                    <div class="bg-white rounded-2xl shadow-lg p-6">
                        <h3 class="text-lg font-bold text-gray-900 mb-6 flex items-center gap-2">
                            <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            Ish beruvchi
                        </h3>

                        <!-- User Info -->
                        <div class="flex items-center mb-6">
                            <div class="relative">
                                <img src="{{ $work->user->avatar ? Storage::url($work->user->avatar) : 'https://ui-avatars.com/api/?name=' . urlencode($work->user->name) . '&background=6366f1&color=fff&size=128' }}"
                                    alt="{{ $work->user->name }}"
                                    class="w-16 h-16 rounded-full object-cover border-4 border-white shadow-lg">
                                <div
                                    class="absolute bottom-0 right-0 w-5 h-5 bg-green-400 border-2 border-white rounded-full">
                                </div>
                            </div>
                            <div class="ml-4">
                                <h4 class="text-lg font-bold text-gray-900">{{ $work->user->name }}</h4>
                                <p class="text-sm text-gray-500">{{ $work->user->email }}</p>
                            </div>
                        </div>

                        <!-- Contact Methods -->
                        <div class="space-y-3">
                            <!-- Phone -->
                            @if ($work->user->userContact && $work->user->userContact->phone)
                                <a href="tel:{{ $work->user->userContact->phone }}"
                                    class="flex items-center justify-between p-3 bg-gradient-to-r from-green-50 to-emerald-50 rounded-xl border border-green-200 hover:border-green-300 transition-all duration-200 group">
                                    <div class="flex items-center">
                                        <div
                                            class="w-10 h-10 bg-white rounded-lg flex items-center justify-center shadow-sm border border-green-200 group-hover:border-green-300">
                                            <svg class="w-5 h-5 text-green-600" fill="currentColor"
                                                viewBox="0 0 20 20">
                                                <path
                                                    d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z" />
                                            </svg>
                                        </div>
                                        <div class="ml-3">
                                            <p class="text-sm font-medium text-gray-900">Telefon</p>
                                            <p class="text-sm text-gray-600">{{ $work->user->userContact->phone }}</p>
                                        </div>
                                    </div>
                                    <svg class="w-5 h-5 text-gray-400 group-hover:text-green-600" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5l7 7-7 7" />
                                    </svg>
                                </a>
                            @endif

                            <!-- Social Media Links -->
                            @if ($work->user->userContact)
                                <div class="grid grid-cols-3 gap-2">
                                    @if ($work->user->userContact->telegram)
                                        <a href="{{ $work->user->userContact->telegram }}" target="_blank"
                                            class="flex flex-col items-center justify-center p-3 bg-gradient-to-br from-blue-50 to-cyan-50 rounded-xl border border-blue-200 hover:border-blue-300 transition-all duration-200 group">
                                            <div
                                                class="w-8 h-8 bg-white rounded-lg flex items-center justify-center shadow-sm border border-blue-200 group-hover:border-blue-300 mb-2">
                                                <span class="text-xl">📱</span>
                                            </div>
                                            <span class="text-xs font-medium text-gray-700">Telegram</span>
                                        </a>
                                    @endif

                                    @if ($work->user->userContact->facebook)
                                        <a href="{{ $work->user->userContact->facebook }}" target="_blank"
                                            class="flex flex-col items-center justify-center p-3 bg-gradient-to-br from-blue-50 to-indigo-50 rounded-xl border border-blue-200 hover:border-blue-300 transition-all duration-200 group">
                                            <div
                                                class="w-8 h-8 bg-white rounded-lg flex items-center justify-center shadow-sm border border-blue-200 group-hover:border-blue-300 mb-2">
                                                <span class="text-xl">📘</span>
                                            </div>
                                            <span class="text-xs font-medium text-gray-700">Facebook</span>
                                        </a>
                                    @endif

                                    @if ($work->user->userContact->instagram)
                                        <a href="{{ $work->user->userContact->instagram }}" target="_blank"
                                            class="flex flex-col items-center justify-center p-3 bg-gradient-to-br from-pink-50 to-rose-50 rounded-xl border border-pink-200 hover:border-pink-300 transition-all duration-200 group">
                                            <div
                                                class="w-8 h-8 bg-white rounded-lg flex items-center justify-center shadow-sm border border-pink-200 group-hover:border-pink-300 mb-2">
                                                <span class="text-xl">📸</span>
                                            </div>
                                            <span class="text-xs font-medium text-gray-700">Instagram</span>
                                        </a>
                                    @endif
                                </div>
                            @endif

                            <!-- Send Message Button -->
                            <button
                                class="w-full flex items-center justify-center gap-2 px-4 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-medium rounded-xl hover:from-indigo-700 hover:to-purple-700 transition-all duration-200 shadow-md hover:shadow-lg mt-4">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                                </svg>
                                Xabar yuborish
                            </button>
                        </div>
                    </div>

                    <!-- Location Card -->
                    <div class="bg-white rounded-2xl shadow-lg p-6">
                        <h3 class="text-lg font-bold text-gray-900 mb-6 flex items-center gap-2">
                            <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            Manzil
                        </h3>

                        <div class="space-y-4">
                            <!-- Location Details -->
                            <div
                                class="p-4 bg-gradient-to-r from-gray-50 to-blue-50 rounded-xl border border-gray-200">
                                <div class="flex items-start">
                                    <svg class="w-5 h-5 text-gray-500 mt-0.5 mr-3 flex-shrink-0" fill="currentColor"
                                        viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    <div>
                                        <p class="font-medium text-gray-900">{{ $work->country }}</p>
                                        @if ($work->region)
                                            <p class="text-gray-700">{{ $work->region }}</p>
                                        @endif
                                        @if ($work->district)
                                            <p class="text-gray-700">{{ $work->district }}</p>
                                        @endif
                                        @if ($work->village)
                                            <p class="text-gray-700">{{ $work->village }}</p>
                                        @endif
                                        @if ($work->address)
                                            <p class="mt-2 text-gray-900 font-medium">{{ $work->address }}</p>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <!-- Map Link -->
                            @if ($work->latitude && $work->longitude)
                                <a href="https://www.google.com/maps?q={{ $work->latitude }},{{ $work->longitude }}"
                                    target="_blank"
                                    class="flex items-center justify-center gap-2 px-4 py-3 bg-white border-2 border-indigo-600 text-indigo-600 font-medium rounded-xl hover:bg-indigo-50 transition-all duration-200">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7" />
                                    </svg>
                                    Xaritada ko'rish
                                </a>
                            @endif
                        </div>
                    </div>

                    <!-- Job Stats -->
                    <div class="bg-white rounded-2xl shadow-lg p-6">
                        <h3 class="text-lg font-bold text-gray-900 mb-6">E'lon statistikasi</h3>

                        <div class="space-y-4">
                            <!-- Views -->
                            <div
                                class="flex items-center justify-between p-4 bg-gradient-to-r from-blue-50 to-indigo-50 rounded-xl border border-blue-100">
                                <div class="flex items-center">
                                    <div
                                        class="w-10 h-10 bg-white rounded-lg flex items-center justify-center shadow-sm border border-blue-200">
                                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-sm font-medium text-gray-600">Ko'rishlar</p>
                                        <p class="text-lg font-bold text-gray-900">{{ $work->read_count }}</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Dates -->
                            <div class="space-y-3">
                                <div class="flex justify-between items-center p-3 bg-gray-50 rounded-lg">
                                    <span class="text-sm font-medium text-gray-600">Joylangan:</span>
                                    <span
                                        class="text-sm font-medium text-gray-900">{{ $work->created_at->format('d.m.Y H:i') }}</span>
                                </div>
                                <div class="flex justify-between items-center p-3 bg-gray-50 rounded-lg">
                                    <span class="text-sm font-medium text-gray-600">Yangilangan:</span>
                                    <span
                                        class="text-sm font-medium text-gray-900">{{ $work->updated_at->diffForHumans() }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Apply Button -->
                    <button
                        class="w-full py-4 bg-gradient-to-r from-green-500 to-emerald-600 text-white font-bold text-lg rounded-2xl hover:from-green-600 hover:to-emerald-700 transition-all duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                        Ishga ariza berish
                    </button>
                    <button
                        class="w-full py-4 bg-gradient-to-r from-green-500 to-emerald-600 text-white font-bold text-lg rounded-2xl hover:from-green-600 hover:to-emerald-700 transition-all duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                        Tahrirlash
                    </button>
                    <button
                        class="w-full py-4 bg-gradient-to-r from-green-500 to-emerald-600 text-white font-bold text-lg rounded-2xl hover:from-green-600 hover:to-emerald-700 transition-all duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                        O'chirish
                    </button>

                </div>
            </div>
        </div>
    </div>

    @if ($work->images && $work->images->count() > 0)
        <script>
            const images = @json($work->images->map(fn($img) => Storage::url($img->image)));
            let currentImageIndex = 0;

            function changeImage(index) {
                currentImageIndex = index;
                document.getElementById('mainImage').src = images[index];
                document.getElementById('currentImage').textContent = index + 1;

                // Update active thumbnail
                document.querySelectorAll('.image-thumbnail').forEach((thumb, i) => {
                    thumb.classList.toggle('border-indigo-500', i === index);
                    thumb.classList.toggle('border-transparent', i !== index);
                });
            }

            // Initialize first thumbnail as active
            document.addEventListener('DOMContentLoaded', () => {
                changeImage(0);
            });
        </script>
    @endif

    <style>
        .image-thumbnail.active {
            border-color: #6366f1;
        }

        .aspect-w-16 {
            position: relative;
            padding-bottom: 56.25%;
        }

        .aspect-w-16>* {
            position: absolute;
            height: 100%;
            width: 100%;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
        }

        .prose {
            color: #374151;
        }

        .prose p {
            margin-top: 0;
            margin-bottom: 1rem;
        }

        .gradient-border {
            border: 2px solid transparent;
            background: linear-gradient(white, white) padding-box,
                linear-gradient(135deg, #6366f1, #8b5cf6) border-box;
        }
    </style>

</x-app-layout>
