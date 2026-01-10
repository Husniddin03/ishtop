<!-- Chat Window -->
<div wire:poll.1s class="md:col-span-3 bg-white shadow rounded-xl flex flex-col h-[85vh]">
    <!-- Chat Header -->
    <div class="flex items-center justify-between border-b p-4">
        <div class="flex items-center gap-4">
            <div class="w-10 h-10 rounded-full">
                <img src="{{ $user->avatar ? Storage::url($user->avatar) : 'https://ui-avatars.com/api/?name=' . urlencode($user->name) . '&background=6366f1&color=fff&size=128' }}"
                    alt="User avatar displayed as a circular image" class="w-full h-full rounded-full">
            </div>
            <div>
                <p class="font-medium text-gray-800">{{ $user->name }}</p>
                <p class="text-sm text-gray-500">
                    @if ($isOnline ?? false)
                        <span class="text-green-500 text-xs flex items-center">
                            <span class="h-2 w-2 bg-green-500 rounded-full mr-1"></span> Onlayn
                        </span>
                    @else
                        <span class="text-gray-400 text-xs">
                            Oflayn (oxirgi marta:
                            {{ $user->last_seen_at ? $user->last_seen_at->diffForHumans() : 'noma\'lum' }})
                        </span>
                    @endif
                </p>
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

    <div class="flex-1 overflow-y-auto p-4 space-y-6 relative bg-gray-50" id="chat-container">

        <script>
            function scrollToBottom() {
                const container = document.getElementById('chat-container');
                if (container) {
                    container.scrollTo({
                        top: container.scrollHeight,
                        behavior: "smooth"
                    });
                }
            }

            // Sahifa yuklanganda
            window.addEventListener("DOMContentLoaded", scrollToBottom);

            // Har safar Livewire DOM yangilangandan keyin
            document.addEventListener("livewire:load", () => {
                Livewire.hook('message.processed', (message, component) => {
                    scrollToBottom();
                });
            });
        </script>


        @foreach ($messages as $message)
            @if ($message->sender_id === auth()->id())
                <div class="flex justify-end flex-col items-end">

                    <div class="relative">
                        <x-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                <button class="text-gray-500 hover:text-indigo-600">
                                    <div
                                        class="bg-indigo-600 text-white p-3 rounded-2xl rounded-tr-none max-w-xs shadow-md">
                                        {{ $message->message }}
                                    </div>
                                </button>
                            </x-slot>

                            <x-slot name="content">

                                <x-dropdown-link href="#">
                                    {{ __('Tahrirlash') }}
                                </x-dropdown-link>

                                <div class="border-t border-gray-200"></div>

                                <!-- Authentication -->
                                <form method="POST" action="#" x-data>
                                    @csrf

                                    <x-dropdown-link href="#" @click.prevent="$root.submit();">
                                        {{ __('O\'chirish') }}
                                    </x-dropdown-link>
                                </form>
                            </x-slot>
                        </x-dropdown>
                    </div>
                    <div class="flex items-center gap-2">
                        <p class="text-indigo-600 relative flex items-center mr-5">
                            <svg class="w-5 absolute" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                            </svg>
                            @if ($message->is_read)
                                <svg class="w-5 absolute ml-1" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                                </svg>
                            @endif
                        </p>
                        <p class="text-sm">{{ $message->created_at->format('H:i') }}</p>
                    </div>
                </div>
            @else
                <div class="flex justify-start flex-col items-start">
                    <div class="relative">
                        <x-dropdown align="left" width="48">
                            <x-slot name="trigger">
                                <button class="text-gray-500 hover:text-indigo-600">
                                    <div
                                        class="bg-white border border-gray-200 text-gray-800 p-3 rounded-2xl rounded-bl-none max-w-xs shadow-sm">
                                        {{ $message->message }}
                                    </div>
                                </button>
                            </x-slot>

                            <x-slot name="content">

                                <x-dropdown-link href="#">
                                    {{ __('Ulashish') }}
                                </x-dropdown-link>

                                <div class="border-t border-gray-200"></div>

                                <!-- Authentication -->
                                <form method="POST" action="#" x-data>
                                    @csrf

                                    <x-dropdown-link href="#" @click.prevent="$root.submit();">
                                        {{ __('Atmetka') }}
                                    </x-dropdown-link>
                                </form>
                            </x-slot>
                        </x-dropdown>
                    </div>
                    <div class="flex items-center gap-2">
                        <p class="text-sm">{{ $message->created_at->format('H:i') }}</p>
                    </div>
                </div>
            @endif
        @endforeach

        {{-- <div class="flex justify-end">
        <div class="bg-indigo-600 p-2 rounded-2xl rounded-tr-none max-w-sm shadow-md">
            <img src="https://images.unsplash.com/photo-1498050108023-c5249f4df085?auto=format&fit=crop&w=300&q=80"
                alt="Design preview" class="rounded-lg mb-1 w-full object-cover">
            <p class="text-white text-sm px-1">Mana dizayn namunasi!</p>
        </div>
    </div>

    <div class="flex justify-start">
        <div
            class="bg-white border border-gray-200 p-2 rounded-2xl rounded-tl-none max-w-sm shadow-sm">
            <div
                class="relative rounded-lg overflow-hidden bg-black aspect-video flex items-center justify-center">
                <div class="absolute inset-0 bg-black/30 flex items-center justify-center">
                    <div
                        class="w-12 h-12 bg-white/20 backdrop-blur-md rounded-full flex items-center justify-center">
                        <svg class="w-6 h-6 text-white fill-current" viewBox="0 0 24 24">
                            <path d="M8 5v14l11-7z" />
                        </svg>
                    </div>
                </div>
                <img src="https://media-cldnry.s-nbcnews.com/image/upload/t_nbcnews-fp-1200-630,f_auto,q_auto:best/rockcms/2022-10/221019-Pillars-of-Creation-al-1237-ea8c4e.jpg"
                    class="w-full h-full object-cover">
            </div>
            <p class="text-gray-500 text-xs mt-2 px-1">Demo_video.mp4 • 12MB</p>
        </div>
    </div>

    <div class="flex justify-end">
        <div class="bg-indigo-600 p-3 rounded-2xl rounded-tr-none w-64 shadow-md text-white">
            <div class="flex items-center gap-3">
                <button class="hover:scale-110 transition">
                    <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M8 5v14l11-7z" />
                    </svg>
                </button>
                <div class="flex-1 h-1 bg-indigo-400 rounded-full relative">
                    <div class="absolute inset-y-0 left-0 w-1/3 bg-white rounded-full"></div>
                </div>
                <span class="text-xs font-mono">0:42</span>
            </div>
        </div>
    </div>

    <div class="flex justify-start">
        <div
            class="bg-white border border-gray-200 p-3 rounded-2xl rounded-tl-none flex items-center gap-3 shadow-sm hover:bg-gray-50 cursor-pointer">
            <div class="bg-red-100 p-2 rounded-lg">
                <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z">
                    </path>
                </svg>
            </div>
            <div>
                <p class="text-sm font-medium text-gray-800">Final_Project.pdf</p>
                <p class="text-xs text-gray-500">2.4 MB • PDF</p>
            </div>
        </div>
    </div> --}}

        {{-- <button
        class="p-3 rounded-full bg-indigo-600 text-white flex items-center justify-center  absolute
bottom-20 right-8 hover:bg-indigo-700 shadow-lg transition-all hover:scale-110 active:scale-95">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
            stroke-width="2" stroke="currentColor" class="size-5">
            <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
        </svg>
    </button> --}}

    </div>

    <form id="chat-form" action="{{ route('chat.send', ['id' => $user->id]) }}" method="POST"
        class="border-t p-4 flex items-center gap-3">
        @csrf
        <input type="text" placeholder="Xabar yozing..." name="message" autofocus
            class="flex-1 border rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500" />
        <button type="submit" class="bg-indigo-600 text-white p-2 rounded-lg hover:bg-indigo-700">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M6 12 3.269 3.125A59.769 59.769 0 0 1 21.485 12 59.768 59.768 0 0 1 3.27 20.875L5.999 12Zm0 0h7.5" />
            </svg>
        </button>
    </form>

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
                container.scrollTo({
                    top: container.scrollHeight,
                    behavior: 'smooth'
                });
            }
        });
    </script>

</div>
