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
                    </ol>
                </nav>
            </div>

        </div>
    </x-slot>
    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- All Chat Container -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 h-full">

                <!-- Chat Window -->
                <div class="md:col-span-3 bg-white shadow rounded-xl flex flex-col h-full">
                    <!-- Chat Header -->
                    <div class="flex items-center justify-between border-b p-4">
                        <div class="flex items-center gap-4">
                            <div class="w-10 h-10 rounded-full">
                                <img src="{{ $user->avatar ? Storage::url($user->avatar) : 'https://ui-avatars.com/api/?name=' . urlencode($user->name) . '&background=6366f1&color=fff&size=128' }}"
                                    alt="User avatar displayed as a circular image" class="w-full h-full rounded-full">
                            </div>
                            <div>
                                <p class="font-medium text-gray-800">{{ $user->name }}</p>
                                <p class="text-sm text-gray-500">Online</p>
                            </div>
                        </div>
                        <div class="ms-3 relative">
                            <x-dropdown align="right" width="48">
                                <x-slot name="trigger">
                                    <button class="text-gray-500 hover:text-indigo-600">⋮</button>
                                </x-slot>

                                <x-slot name="content">

                                    <x-dropdown-link href="{{ route('users.profile', $user->id) }}">
                                        {{ __('Profilni ko\'rish') }}
                                    </x-dropdown-link>

                                    <div class="border-t border-gray-200"></div>

                                    <!-- Authentication -->
                                    <form method="POST" action="{{ route('logout') }}" x-data>
                                        @csrf

                                        <x-dropdown-link href="{{ route('logout') }}" @click.prevent="$root.submit();">
                                            {{ __('Chatni o\'chirish') }}
                                        </x-dropdown-link>
                                    </form>
                                </x-slot>
                            </x-dropdown>
                        </div>
                    </div>

                    <!-- Chat Messages -->
                    <div class="flex-1 overflow-y-auto p-4 space-y-4">
                        <!-- Sender -->
                        <div class="flex justify-start">
                            <div class="bg-gray-100 text-gray-800 p-3 rounded-lg max-w-xs">
                                Salom! Qalaysan?
                            </div>
                        </div>
                        <!-- Receiver -->
                        <div class="flex justify-end">
                            <div class="bg-indigo-600 text-white p-3 rounded-lg max-w-xs">
                                Yaxshi, rahmat! Sen-chi?
                            </div>
                        </div>
                    </div>

                    <!-- Chat Input (pastga yopishgan) -->
                    <div class="border-t p-4 flex items-center gap-3">
                        <input type="text" placeholder="Xabar yozing..."
                            class="flex-1 border rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500" />
                        <button class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700">
                            Yuborish
                        </button>
                    </div>
                </div>

                <!-- User Info / Sidebar (faqat desktopda ko‘rinadi) -->
                <div class="hidden md:block md:col-span-1 bg-white shadow rounded-xl p-4 overflow-y-auto">
                    <h2 class="text-lg font-semibold mb-4">Foydalanuvchi ma’lumotlari</h2>
                    <div class="flex flex-col items-center text-center">
                        <div class="w-24 h-24 rounded-full mb-3">
                            <img src="{{ $user->avatar ? Storage::url($user->avatar) : 'https://ui-avatars.com/api/?name=' . urlencode($user->name) . '&background=6366f1&color=fff&size=128' }}"
                                alt="User avatar displayed as a circular image" class="w-full h-full rounded-full">
                        </div>
                        <p class="font-medium text-gray-800">{{ $user->name }}</p>
                        <p class="text-sm text-gray-500"></p>
                    </div>
                    <div class="mt-6 space-y-2">
                        <a href="{{ route('users.profile', $user->id) }}">
                            <button class="w-full bg-indigo-50 text-indigo-600 py-2 rounded-lg hover:bg-indigo-100">
                                Profilni ko‘rish
                            </button>
                        </a>
                        <button class="w-full bg-red-50 text-red-600 py-2 rounded-lg hover:bg-red-100">
                            Chatni o‘chirish
                        </button>
                    </div>
                </div>
            </div>

        </div>
    </div>

</x-app-layout>
