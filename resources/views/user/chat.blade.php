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
                <!-- Chat Window -->
                <div class="md:col-span-3 bg-white shadow rounded-xl flex flex-col h-[85vh]">
                    <!-- Chat Header -->
                    <div class="flex items-center justify-between border-b p-4">
                        <div class="flex items-center gap-4">
                            <div class="w-10 h-10 rounded-full">
                                <img src="{{ $user->avatar ? Storage::url($user->avatar) : 'https://ui-avatars.com/api/?name=' . urlencode($user->name) . '&background=6366f1&color=fff&size=128' }}"
                                    alt="User" class="w-full h-full rounded-full">
                            </div>
                            <div>
                                <p class="font-medium text-gray-800">{{ $user->name }}</p>
                                <p class="text-sm text-gray-500">
                                    @livewire('is-online-component', ['id' => $user->id])
                                </p>
                            </div>
                        </div>
                        <div class="ms-3 relative">
                            <x-dropdown align="right" width="48">
                                <x-slot name="trigger">
                                    <button class="text-gray-500 hover:text-indigo-600">⋮</button>
                                </x-slot>

                                <x-slot name="content">

                                    <x-dropdown-link href="{{ route('users.show', $user->id) }}">
                                        {{ __('Profilni ko\'rish') }}
                                    </x-dropdown-link>

                                    <div class="border-t border-gray-200"></div>

                                    <!-- Authentication -->
                                    <form method="POST" action="{{ route('chat.destroy', ['id' => $user->id]) }}"
                                        x-data
                                        onsubmit="return confirm('Chindan ham ushbu chatni o‘chirmoqchimisiz?');">
                                        @csrf
                                        @method('DELETE')
                                        <x-dropdown-link href="#" @click.prevent="$root.submit();">
                                            {{ __('Chatni o\'chirish') }}
                                        </x-dropdown-link>
                                    </form>
                                </x-slot>
                            </x-dropdown>
                        </div>
                    </div>


                    @livewire('chat-messages', ['id' => $user->id])

                    <form id="chat-form" action="{{ route('chat.send', ['id' => $user->id]) }}" method="POST">
                        @csrf
                        @if ($work)
                            <div id="redirect-work-user-message"
                                class="flex w-full items-center justify-between border-b p-4">
                                <a href="{{ route('works.show', $work->id) }}"
                                    class="text-indigo-600 text-sm flex items-center gap-2" id="redirect-message">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M13.5 6H5.25A2.25 2.25 0 0 0 3 8.25v10.5A2.25 2.25 0 0 0 5.25 21h10.5A2.25 2.25 0 0 0 18 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25" />
                                    </svg>
                                    <p>
                                        <span class="text-red-500">{{ $work->name }}</span> <span>ga ariza
                                            yuborish</span>
                                    </p>
                                </a>
                                <input type="hidden" name="redirect" value="work_{{ $work->id }}" id="">
                                <button type="button"
                                    onclick="document.getElementById('redirect-work-user-message').classList.add('hidden'); window.location.href = '/chat/{{ $user->id }}';"
                                    class="text-gray-500 hover:text-indigo-600 me-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            </div>
                        @endif
                        <div id="redirect-to-message"
                            class="flex w-full items-center justify-between border-b p-4 hidden">
                            <a href="#" class="text-indigo-600 text-sm flex items-center gap-2"
                                id="redirect-message">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M13.5 6H5.25A2.25 2.25 0 0 0 3 8.25v10.5A2.25 2.25 0 0 0 5.25 21h10.5A2.25 2.25 0 0 0 18 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25" />
                                </svg>
                                <p>
                                    <span class="text-red-500" id="show-message-text"></span> <span>ga javob
                                        yozish</span>
                                </p>
                            </a>
                            <input type="hidden" name="redirect" value="" id="message-redirect-input">
                            <button type="button"
                                onclick="document.getElementById('redirect-to-message').classList.add('hidden');"
                                class="text-gray-500 hover:text-indigo-600 me-2">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                        <div class="border-t p-4 flex items-center gap-3">
                            <input type="text" placeholder="Xabar yozing..." name="message" autofocus
                                class="flex-1 border rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500" />
                            <button type="submit"
                                class="bg-indigo-600 text-white p-2 rounded-lg hover:bg-indigo-700">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M6 12 3.269 3.125A59.769 59.769 0 0 1 21.485 12 59.768 59.768 0 0 1 3.27 20.875L5.999 12Zm0 0h7.5" />
                                </svg>
                            </button>
                        </div>
                    </form>

                    <form id="chat-form-update" class="hidden">
                        @csrf
                        <div class="flex w-full items-center justify-between border-b p-4">
                            <a href="#" class="text-indigo-600 text-sm flex items-center gap-2"
                                id="redirect-message">
                                <svg class="w-5" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                                </svg>
                                <p>
                                    Xabarni tahrirlash
                                </p>
                            </a>
                            <button type="button"
                                onclick="document.getElementById('chat-form-update').classList.add('hidden'); document.getElementById('chat-form').classList.remove('hidden');"
                                class="text-gray-500 hover:text-indigo-600 me-2">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                        <div class="border-t p-4 flex items-center gap-3">
                            <input type="text" placeholder="Xabar yozing..." name="message" autofocus
                                id="update-input"
                                class="flex-1 border rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500" />
                            <button type="submit"
                                class="bg-indigo-600 text-white p-2 rounded-lg hover:bg-indigo-700">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M6 12 3.269 3.125A59.769 59.769 0 0 1 21.485 12 59.768 59.768 0 0 1 3.27 20.875L5.999 12Zm0 0h7.5" />
                                </svg>
                            </button>
                        </div>
                    </form>

                    {{-- send --}}

                    <script>
                        document.getElementById('chat-form').addEventListener('submit', async function(e) {
                            e.preventDefault(); // sahifa yangilanishini to‘xtatadi

                            const form = e.target;
                            const formData = new FormData(form);

                            const response = await fetch(form.action, {
                                method: 'POST',
                                body: formData,
                                headers: {
                                    'X-CSRF-TOKEN': formData.get('_token')
                                }
                            });

                            if (response.ok) {
                                // inputni tozalash
                                form.message.value = '';
                                // scrollni pastga tushirish
                                const container = document.getElementById('chat-container');
                                if (container) {
                                    container.scrollTo({
                                        top: container.scrollHeight,
                                        behavior: 'smooth'
                                    });
                                }

                                // agar redirect hidden input mavjud bo‘lsa (ya'ni $work sharti bajarilgan bo‘lsa)
                                if (formData.get('redirect')) {
                                    window.history.pushState({}, '', '/chat/{{ $user->id }}');

                                    window.location.href = '/chat/{{ $user->id }}';
                                }
                            }
                        });
                    </script>


                    {{-- update --}}

                    <script>
                        function updateMessage(id, message) {
                            const chatForm = document.getElementById('chat-form');
                            const chatFormUpdate = document.getElementById('chat-form-update');
                            const updateInput = document.getElementById('update-input');

                            const redirectMessage = document.getElementById('redirect-message');

                            redirectMessage.addEventListener('click', function(e) {
                                e.preventDefault(); // default anchor harakatini to‘xtatamiz

                                document.querySelectorAll('.highlight').forEach(el => {
                                    el.classList.remove('highlight');
                                });

                                const messageElement = document.getElementById(`message_${id}`);
                                if (messageElement) {
                                    // Smooth scroll
                                    messageElement.scrollIntoView({
                                        behavior: 'smooth',
                                        block: 'center'
                                    });

                                    // Highlight class qo‘shamiz
                                    messageElement.classList.add('highlight');

                                    // Animatsiya tugagach classni olib tashlaymiz
                                    setTimeout(() => {
                                        messageElement.classList.remove('highlight');
                                    }, 1000);
                                }
                            });


                            const messageElement = document.getElementById(`message_${id}`);
                            const messagePosition = messageElement.offsetTop;

                            redirectMessage.href = `#message_${id}`;

                            // Tahrirlash formasini ko‘rsatish
                            chatForm.classList.add('hidden');
                            chatFormUpdate.classList.remove('hidden');

                            // Tahrirlash maydoniga eski xabar matnini o‘rnatish
                            updateInput.value = message;

                            // Formaning action atributini yangilash
                            chatFormUpdate.action = `/chat/update/${id}`;
                            chatFormUpdate.message.focus();


                        }
                    </script>

                    <script>
                        document.getElementById('chat-form-update').addEventListener('submit', async function(e) {
                            e.preventDefault(); // sahifa yangilanishini to‘xtatadi

                            const form = e.target;
                            const formData = new FormData(form);

                            const response = await fetch(form.action, {
                                method: 'POST',
                                body: formData,
                                headers: {
                                    'X-CSRF-TOKEN': formData.get('_token')
                                }
                            });

                            if (response.ok) {
                                const chatForm = document.getElementById('chat-form');
                                const chatFormUpdate = document.getElementById('chat-form-update');
                                // tahrirlash formasini yashirish va asosiy formani ko‘rsatish
                                form.classList.add('hidden');
                                chatForm.classList.remove('hidden');
                                const messageElement = document.getElementById(`message_${id}`);

                                // inputni tozalash
                                form.querySelector('[name="message"]').value = '';

                                // scrollni pastga tushirish
                                const container = document.getElementById('chat-container');
                                container.scrollTo({
                                    top: messageElement.offsetTop,
                                    behavior: 'smooth'
                                });
                            }
                        });
                    </script>


                    <script>
                        function redirectMessage(id, message) {
                            const redirectDiv = document.getElementById('redirect-to-message');
                            const showMessageText = document.getElementById('show-message-text');
                            const messageRedirectInput = document.getElementById('message-redirect-input');

                            showMessageText.textContent = message;
                            messageRedirectInput.value = `message_${id}`;
                            redirectDiv.classList.remove('hidden');

                        }

                        function redirectMessage(id) {
                            e.preventDefault(); // default anchor harakatini to‘xtatamiz

                            document.querySelectorAll('.highlight').forEach(el => {
                                el.classList.remove('highlight');
                            });

                            const messageElement = document.getElementById(`${id}`);
                            if (messageElement) {
                                // Smooth scroll
                                messageElement.scrollIntoView({
                                    behavior: 'smooth',
                                    block: 'center'
                                });

                                // Highlight class qo‘shamiz
                                messageElement.classList.add('highlight');

                                // Animatsiya tugagach classni olib tashlaymiz
                                setTimeout(() => {
                                    messageElement.classList.remove('highlight');
                                }, 1000);
                            }
                        }
                    </script>

                </div>

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
                        <a href="{{ route('users.show', $user->id) }}">
                            <button class="w-full bg-indigo-50 text-indigo-600 py-2 rounded-lg hover:bg-indigo-100">
                                Profilni ko‘rish
                            </button>
                        </a>
                        <form action="{{ route('chat.destroy', $user->id) }}" method="POST"
                            onsubmit="return confirm('Chindan ham ushbu chatni o‘chirmoqchimisiz?');">
                            @csrf
                            @method('DELETE')
                            <button class="w-full bg-red-50 text-red-600 py-2 rounded-lg hover:bg-red-100">
                                Chatni o‘chirish
                            </button>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>

</x-app-layout>



<style>
    .toast {
        position: fixed;
        bottom: 20px;
        right: 20px;
        background: #4caf50;
        color: white;
        padding: 10px 16px;
        border-radius: 6px;
        font-size: 14px;
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .toast.show {
        opacity: 1;
    }

    .highlight {
        animation: flash 1s ease;
    }

    @keyframes flash {
        0% {
            background-color: #fef08a;
        }

        /* sariq */
        50% {
            background-color: #fde047;
        }

        100% {
            background-color: transparent;
        }
    }
</style>
