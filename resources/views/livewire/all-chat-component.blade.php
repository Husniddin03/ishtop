<ul wire:poll.1s class="space-y-3">

    @foreach ($users as $user)
        @php
            $unreadCount = $messages->where('sender_id', $user->id)->count();
            // $message = $messages->where('sender_id', $user->id)->last();
        @endphp
        <li>
            <a href="{{ route('chat', $user->id) }}"
                class="flex items-center justify-between p-3 rounded-lg hover:bg-indigo-50 transition">
                <div class="flex items-center content-center gap-4">
                    <div class="w-12 h-12 rounded-full mb-3">
                        <img src="{{ $user->avatar ? Storage::url($user->avatar) : 'https://ui-avatars.com/api/?name=' . urlencode($user->name) . '&background=6366f1&color=fff&size=128' }}"
                            alt="User avatar displayed as a circular image" class="w-full h-full rounded-full">
                    </div>
                    <div>
                        <p class="font-medium text-gray-800">{{ $user->name }}</p>
                        <p class="text-xs text-gray-500">
                            @if ($user->is_online)
                                <span class="text-green-600">Hozir onlayn</span>
                            @else
                                {{ $user->last_seen_at ? $user->last_seen_at->diffForHumans() : 'oflayn' }}
                            @endif
                        </p>
                    </div>
                </div>
                <div class="flex flex-col">
                    @if ($unreadCount > 0)
                        <span
                            class="inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-white bg-red-600 rounded-full">
                            {{ $unreadCount }}
                        </span>
                    @endif

                    <div class="flex items-center gap-2">
                        {{-- <p class="text-indigo-600 relative flex items-center mr-5">
                        <svg class="w-5 absolute" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="m4.5 12.75 6 6 9-13.5" />
                        </svg>
                        @if ($message->is_read)
                            <svg class="w-5 absolute ml-1" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="m4.5 12.75 6 6 9-13.5" />
                            </svg>
                        @endif
                    </p>
                    <p class="text-sm">{{ $message->created_at->format('H:i') }}</p> --}}
                        <p class="text-sm">19:09</p>
                    </div>
                </div>
            </a>
        </li>
    @endforeach
</ul>
