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
                <div class="bg-slate-50 min-h-screen py-10 px-4 sm:px-6">
                    <div class="max-w-5xl mx-auto">

                        <div
                            class="bg-white rounded-[2.5rem] shadow-2xl overflow-hidden border border-gray-100 mb-8 relative">
                            <div class="h-56 bg-gradient-to-br from-blue-700 via-indigo-600 to-violet-700 relative">
                                <div
                                    class="absolute inset-0 opacity-10 bg-[url('https://www.transparenttextures.com/patterns/slanted-gradient.png')]">
                                </div>
                                <div class="absolute top-6 right-8">
                                    <span
                                        class="inline-flex items-center px-4 py-2 rounded-full bg-white/20 backdrop-blur-md text-white text-xs font-bold uppercase tracking-widest border border-white/30">
                                        <span class="h-2 w-2 rounded-full bg-green-400 mr-2 animate-pulse"></span>
                                        Bo'sh / Band emas
                                    </span>
                                </div>
                            </div>

                            <div class="px-8 pb-10">
                                <div
                                    class="relative flex flex-col md:flex-row items-center md:items-end -mt-24 md:-mt-28 space-y-6 md:space-y-0 md:space-x-10">
                                    <div class="relative">
                                        <div
                                            class="h-52 w-52 md:h-64 md:w-64 rounded-[3rem] border-[10px] border-white shadow-2xl overflow-hidden bg-gray-100">

                                            @if ($worker->user->avatar)
                                                <img class="h-full w-full object-cover transition-transform duration-500 hover:scale-110"
                                                    src="{{ Storage::url($worker->user->avatar) }}"
                                                    alt="{{ $worker->user->name }}">
                                            @else
                                                <img class="h-full w-full object-cover transition-transform duration-500 hover:scale-110"
                                                    src="https://ui-avatars.com/api/?size=512&background=6366f1&color=fff&name= . {{ urlencode($worker->user->name) }}"
                                                    alt="{{ $worker->user->name }}">
                                            @endif

                                        </div>
                                    </div>

                                    <div class="flex-1 text-center md:text-left pb-4">
                                        <h1 class="text-4xl md:text-5xl font-black text-gray-900 tracking-tight mb-2">
                                            {{ $worker->user->userData->first_name }}
                                            {{ $worker->user->userData->last_name }}
                                        </h1>
                                        <div class="flex flex-wrap justify-center md:justify-start gap-3">
                                            <span
                                                class="flex items-center text-gray-500 font-medium bg-gray-100 px-4 py-1.5 rounded-xl text-sm">
                                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                                    </path>
                                                </svg>
                                                {{ $worker->user->userData->region }},
                                                {{ $worker->user->userData->district }}
                                            </span>
                                            <span
                                                class="flex items-center text-indigo-600 font-bold bg-indigo-50 px-4 py-1.5 rounded-xl text-sm border border-indigo-100">
                                                @ {{ $worker->user->name }}
                                            </span>
                                        </div>
                                    </div>

                                    <div class="pb-4 w-full md:w-auto">
                                        <a href="tel:{{ $worker->user->userContact->phone }}"
                                            class="flex items-center justify-center space-x-3 px-8 py-4 bg-indigo-600 hover:bg-indigo-700 text-white rounded-[2rem] font-bold shadow-xl shadow-indigo-200 transition-all transform hover:-translate-y-1 active:scale-95">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1.01-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z">
                                                </path>
                                            </svg>
                                            <span>Aloqaga chiqish</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                            <div class="lg:col-span-2 space-y-8">

                                <div class="bg-white p-10 rounded-[2.5rem] shadow-sm border border-gray-100">
                                    <h3 class="text-2xl font-extrabold text-gray-800 mb-6 italic">Mutaxassis haqida</h3>
                                    <p class="text-gray-600 text-xl leading-relaxed font-light">
                                        {{ $worker->user->userData->bio ?? 'Ushbu mutaxassis o\'zi haqida batafsil ma\'lumot qoldirmagan.' }}
                                    </p>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    @if ($worker->user->userContact->telegram)
                                        <a href="https://t.me/{{ ltrim($worker->user->userContact->telegram, '@') }}"
                                            target="_blank"
                                            class="group p-6 bg-gradient-to-r from-sky-500 to-sky-600 rounded-[2rem] text-white flex items-center justify-between shadow-lg hover:shadow-sky-200 transition-all">
                                            <div class="flex items-center space-x-4">
                                                <div
                                                    class="bg-white/20 p-3 rounded-2xl group-hover:scale-110 transition-transform">
                                                    <svg class="w-8 h-8 fill-current" viewBox="0 0 24 24">
                                                        <path
                                                            d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm4.113 18.917c-.201.213-.674.373-1.025.373-.35 0-1.163-.133-2.45-.631l-2.868-1.066c-.958-.351-1.425-.56-2.025-1.013-1.066-.807-1.332-1.787-1.332-2.787 0-.58.151-1.127.42-1.611l.136-.213 1.074-1.625c.664-.997 1.701-1.89 2.924-2.456 1.414-.653 2.507-.807 3.535-.613.628.12 1.054.426 1.341.879.287.453.374 1.053.254 1.747l-.934 5.333c-.146.853-.453 1.353-.984 1.727z" />
                                                    </svg>
                                                </div>
                                                <span class="text-xl font-bold">Telegram</span>
                                            </div>
                                            <svg class="w-6 h-6 opacity-50 group-hover:translate-x-1 transition-transform"
                                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                                    d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                                            </svg>
                                        </a>
                                    @endif

                                    @if ($worker->user->userContact->instagram)
                                        <a href="https://instagram.com/{{ ltrim($worker->user->userContact->instagram, '@') }}"
                                            target="_blank"
                                            class="group p-6 bg-gradient-to-r from-pink-500 via-red-500 to-yellow-500 rounded-[2rem] text-white flex items-center justify-between shadow-lg hover:shadow-pink-200 transition-all">
                                            <div class="flex items-center space-x-4">
                                                <div
                                                    class="bg-white/20 p-3 rounded-2xl group-hover:scale-110 transition-transform">
                                                    <svg class="w-8 h-8" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z">
                                                        </path>
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z">
                                                        </path>
                                                    </svg>
                                                </div>
                                                <span class="text-xl font-bold">Instagram</span>
                                            </div>
                                            <svg class="w-6 h-6 opacity-50 group-hover:translate-x-1 transition-transform"
                                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                                    d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                                            </svg>
                                        </a>
                                    @endif

                                    @if ($worker->user->userContact->facebook)
                                        <a href="https://facebook.com/{{ ltrim($worker->user->userContact->facebook, '@') }}"
                                            target="_blank"
                                            class="group p-6 bg-gradient-to-r from-blue-600 via-blue-500 to-blue-400 rounded-[2rem] text-white flex items-center justify-between shadow-lg hover:shadow-blue-200 transition-all">
                                            <div class="flex items-center space-x-4">
                                                <div
                                                    class="bg-white/20 p-3 rounded-2xl group-hover:scale-110 transition-transform">
                                                    <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24">
                                                        <path
                                                            d="M22 12c0-5.52-4.48-10-10-10S2 6.48 2 12c0 5 3.66 9.13 8.44 9.88v-6.99H7.9v-2.89h2.54V9.41c0-2.5 1.49-3.89 3.77-3.89 1.09 0 2.23.2 2.23.2v2.45h-1.26c-1.24 0-1.63.77-1.63 1.56v1.87h2.78l-.44 2.89h-2.34v6.99C18.34 21.13 22 17 22 12z" />
                                                    </svg>
                                                </div>
                                                <span class="text-xl font-bold">Facebook</span>
                                            </div>
                                            <svg class="w-6 h-6 opacity-50 group-hover:translate-x-1 transition-transform"
                                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                                    d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                                            </svg>
                                        </a>
                                    @endif

                                </div>

                                <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-gray-100">
                                    <h3 class="text-xl font-extrabold text-gray-800 mb-6">Manzil</h3>
                                    <div
                                        class="flex items-center justify-between p-6 bg-slate-50 rounded-3xl border border-slate-100">
                                        <div class="flex items-center space-x-4">
                                            <div class="p-4 bg-white rounded-2xl shadow-sm text-indigo-600">
                                                <svg class="w-8 h-8" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                                    </path>
                                                </svg>
                                            </div>
                                            <div>
                                                <p class="text-lg font-bold text-gray-800">
                                                    {{ $worker->user->userData->region }},
                                                    {{ $worker->user->userData->district }}</p>
                                                <p class="text-gray-500">
                                                    {{ $worker->user->userData->village ?? 'Mahalla ma\'lumoti yo\'q' }}
                                                </p>
                                            </div>
                                        </div>
                                        <a href="https://www.google.com/maps?q={{ $worker->user->userData->latitude }},{{ $worker->user->userData->longitude }}"
                                            target="_blank"
                                            class="hidden md:block px-6 py-2 bg-white border border-gray-200 rounded-xl text-sm font-bold text-gray-700 hover:bg-gray-50 transition-colors">
                                            Xaritada ochish
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <div class="space-y-8">

                                <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-gray-100">
                                    <h3 class="text-xl font-extrabold text-gray-800 mb-6">Ko'rsatkichlar</h3>
                                    <div class="space-y-6">
                                        <div class="flex items-center justify-between">
                                            <div
                                                class="flex items-center space-x-3 text-gray-500 font-medium italic text-sm">
                                                <span class="w-1.5 h-1.5 bg-blue-500 rounded-full"></span>
                                                <span>Yoshi:</span>
                                            </div>
                                            <span class="text-gray-900 font-black text-lg">
                                                {{ $worker->user->userData->birthday ? \Carbon\Carbon::parse($worker->user->userData->birthday)->age . ' yosh' : '—' }}
                                            </span>
                                        </div>
                                        <div class="flex items-center justify-between border-t border-gray-50 pt-4">
                                            <div
                                                class="flex items-center space-x-3 text-gray-500 font-medium italic text-sm">
                                                <span class="w-1.5 h-1.5 bg-green-500 rounded-full"></span>
                                                <span>Vazni:</span>
                                            </div>
                                            <span
                                                class="text-gray-900 font-black text-lg">{{ $worker->user->userData->weight }}
                                                kg</span>
                                        </div>
                                        <div class="flex items-center justify-between border-t border-gray-50 pt-4">
                                            <div
                                                class="flex items-center space-x-3 text-gray-500 font-medium italic text-sm">
                                                <span class="w-1.5 h-1.5 bg-purple-500 rounded-full"></span>
                                                <span>Bo'yi:</span>
                                            </div>
                                            <span
                                                class="text-gray-900 font-black text-lg">{{ $worker->user->userData->height }}
                                                cm</span>
                                        </div>
                                        <div class="flex items-center justify-between border-t border-gray-50 pt-4">
                                            <div
                                                class="flex items-center space-x-3 text-gray-500 font-medium italic text-sm">
                                                <span class="w-1.5 h-1.5 bg-orange-500 rounded-full"></span>
                                                <span>Jinsi:</span>
                                            </div>
                                            <span
                                                class="text-gray-900 font-black text-lg">{{ $worker->user->userData->gender }}</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="bg-indigo-900 p-8 rounded-[2.5rem] shadow-2xl text-white">
                                    <p
                                        class="text-[10px] font-black uppercase tracking-[0.3em] mb-4 opacity-50 text-indigo-300 underline underline-offset-4">
                                        To'g'ridan-to'g'ri bog'lanish</p>
                                    <h4 class="text-2xl font-black mb-1 italic">Telefon:</h4>
                                    <a href="tel:{{ $worker->user->userContact->phone }}"
                                        class="text-3xl font-black text-indigo-400 hover:text-indigo-300 transition-colors tracking-tighter">
                                        {{ $worker->user->userContact->phone }}
                                    </a>
                                    <p class="mt-6 text-sm opacity-60 font-medium leading-relaxed">
                                        Qo'ng'iroq qilganda ushbu platformadan raqamni olganingizni ayting.
                                    </p>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
