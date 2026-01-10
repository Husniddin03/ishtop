<div wire:poll.1s>
    @if ($count > 0)
        <span
            class="absolute -top-2 -right-2 bg-red-500 text-white text-xs rounded-full px-1.5 py-0.5">{{ $count }}</span>
    @else
        <span></span>
    @endif
</div>
