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
                                <a href="{{ route('allchat') }}"
                                    class="ms-1 text-sm font-medium text-gray-500 hover:text-indigo-600">
                                    Chatlar</a>
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
                                    {{ $user->name }}</p>
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


                @livewire('chat-messages', ['id' => $user->id])


                <!-- User Info / Sidebar (faqat desktopda ko‘rinadi) -->
                <div class="hidden md:block md:col-span-1 bg-white shadow rounded-xl p-4 overflow-y-auto">
                    <h2 class="text-lg font-semibold mb-4">Foydalanuvchi ma’lumotlari</h2>
                    <div class="flex flex-col items-center text-center">
                        <div class="w-24 h-24 rounded-full mb-3">
                            <img src="{{ $user->avatar ? Storage::url($user->avatar) : 'https://ui-avatars.com/api/?name=' . urlencode($user->name) . '&background=6366f1&color=fff&size=128' }}"
                                alt="{{ $user->name }}" class="w-full h-full rounded-full">
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
