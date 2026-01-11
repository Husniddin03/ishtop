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

    @php
        $date = null;
    @endphp


    @foreach ($messages as $message)
        @if ($message->created_at->format('Y-m-d') !== $date)
            @php
                $date = $message->created_at->format('Y-m-d');
            @endphp
            <div class="flex justify-center my-4">
                <div class="bg-gray-300 text-gray-700 px-4 py-1 rounded-full text-sm shadow-sm">
                    {{ $message->created_at->locale('uz_Latn')->translatedFormat('j F Y') }}
                </div>
            </div>
        @endif
        @if ($message->sender_id === auth()->id())
            <div class="flex justify-end flex-col items-end">

                <div class="relative">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="text-gray-500 hover:text-indigo-600">
                                <div id="message_{{ $message->id }}"
                                    class="text-left bg-indigo-600 text-white p-3 rounded-2xl rounded-tr-none max-w-xs shadow-md">
                                    {{ $message->message }}
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">

                            <x-dropdown-button data-message="{{ $message->message }}"
                                onclick="updateMessage('{{ $message->id }}', this.dataset.message)">
                                {{ __('Tahrirlash') }}
                            </x-dropdown-button>

                            <x-dropdown-button data-message="{{ $message->message }}"
                                onclick="copyMessage(this.dataset.message)">
                                {{ __('Nusxa olish') }}
                            </x-dropdown-button>


                            <div class="border-t border-gray-200"></div>

                            <form id="delete-form-{{ $message->id }}" method="POST"
                                action="{{ route('chat.message.destroy', $message->id) }}">
                                @csrf
                                @method('DELETE')
                                <x-dropdown-link href="#" onclick="deleteMessage({{ $message->id }})">
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
                    <p class="text-sm">{{ $message->created_at->format('H:i A') }}</p>
                </div>
                @if ($message->created_at != $message->updated_at)
                    <p class="text-xs text-gray-400 italic mt-1">Tahrirlangan:
                        {{ $message->updated_at->locale('uz_Latn')->translatedFormat('j F Y H:i A') }}</p>
                @endif
            </div>
        @else
            <div class="flex justify-start flex-col items-start">
                <div class="relative">
                    <x-dropdown align="left" width="48">
                        <x-slot name="trigger">
                            <button class="text-gray-500 hover:text-indigo-600">
                                <div id="message_{{ $message->id }}"
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
                @if ($message->created_at != $message->updated_at)
                    <p class="text-xs text-gray-400 italic mt-1">Tahrirlangan:
                        {{ $message->updated_at->locale('uz_Latn')->translatedFormat('j F Y H:i A') }}</p>
                @endif
            </div>
        @endif
    @endforeach

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

<script>
    function deleteMessage(id) {
        const form = document.getElementById(`delete-form-${id}`);
        const formData = new FormData(form);

        fetch(form.action, {
            method: 'POST', // DELETE ni POST qilib yuboramiz, Laravel _method orqali DELETE sifatida ko‘radi
            body: formData,
            headers: {
                'X-CSRF-TOKEN': formData.get('_token')
            }
        }).then(res => {
            if (res.ok) {
                // DOMdan xabarni olib tashlash
                document.getElementById(`message_${id}`).remove();
            }
        });
    }
</script>
