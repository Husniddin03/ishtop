<div wire:poll.1s class="flex-1 overflow-y-auto p-4 space-y-6 relative bg-gray-50" id="chat-container">

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
                                    class="text-left bg-indigo-600 text-white p-3 rounded-2xl rounded-tr-none max-w-xs shadow-md">
                                    {{ $message->message }}
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">

                            <x-dropdown-link href="#">
                                {{ __('Tahrirlash') }}
                            </x-dropdown-link>

                            <x-dropdown-button data-message="{{ $message->message }}"
                                onclick="copyMessage(this.dataset.message)">
                                {{ __('Nusxa olish') }}
                            </x-dropdown-button>


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
                        <svg class="w-5 absolute" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor" class="size-6">
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
                                    class="bg-white text-left border border-gray-200 text-gray-800 p-3 rounded-2xl rounded-bl-none max-w-xs shadow-sm">
                                    {{ $message->message }}
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">

                            <x-dropdown-link href="#">
                                {{ __('Ulashish') }}
                            </x-dropdown-link>

                            <x-dropdown-button data-message="{{ $message->message }}"
                                onclick="copyMessage(this.dataset.message)">
                                {{ __('Nusxa olish') }}
                            </x-dropdown-button>

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

<script>
    function copyMessage(message) {
        navigator.clipboard.writeText(message).then(() => {
            // Toast element yaratamiz
            let toast = document.createElement("div");
            toast.className = "toast";
            toast.textContent = "✅ Matn nusxalandi!";
            document.body.appendChild(toast);

            // Ko‘rsatish
            setTimeout(() => toast.classList.add("show"), 100);

            // 2 soniyadan keyin yo‘q qilish
            setTimeout(() => {
                toast.classList.remove("show");
                setTimeout(() => toast.remove(), 300);
            }, 2000);
        });
    }
</script>
