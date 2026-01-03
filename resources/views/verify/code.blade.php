<!-- resources/views/verify/code.blade.php -->
<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <div class="mb-4 text-sm text-gray-600">
            Email manzilingizga yuborilgan tasdiqlash kodini kiriting.
        </div>

        <x-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('verify.code') }}">
            @csrf

            <div>
                <x-label for="code" value="{{ __('Tasdiqlash kodi') }}" />
                <x-input id="code" class="block mt-1 w-full" type="text" name="code" required autofocus autocomplete="one-time-code" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-button>
                    {{ __('Tasdiqlash') }}
                </x-button>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>