<div wire:poll.1s>
    @if ($isOnline)
        <span class="text-green-500 text-xs flex items-center">
            <span class="h-2 w-2 bg-green-500 rounded-full mr-1"></span> Onlayn
        </span>
    @else
        <span class="text-gray-400 text-xs">
            {{ $user->last_seen_at ? $user->last_seen_at->locale('uz_Latn')->diffForHumans() : 'Noma\'lum' }}
        </span>
    @endif
</div>
