<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Profile') }}
            </h2>
            <a href="#" class="btn">Elonlarim</a>
        </div>
    </x-slot>

    <div>
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            <!-- Foydalanuvchi avatarini yangilash -->
            <form action="{{ route('auth.avatar.update') }}" method="POST" class="flex flex-col items-center mb-8"
                enctype="multipart/form-data">
                @csrf
                <div class="relative">
                    @if (auth()->user()->avatar)
                        <img id="avatarPreview" src="{{ asset('storage/' . auth()->user()->avatar) }}"
                            class="w-32 h-32 rounded-full object-cover border-4 border-white shadow-lg">
                    @else
                        <div id="avatarPreview"
                            class="w-32 h-32 rounded-full bg-indigo-100 flex items-center justify-center border-4 border-white shadow-lg">
                            <span class="text-4xl text-indigo-600 font-bold">
                                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                            </span>
                        </div>
                    @endif
                    <label for="avatar"
                        class="absolute bottom-0 right-0 bg-indigo-600 text-white p-2 rounded-full cursor-pointer hover:bg-indigo-700 transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z">
                            </path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        <input type="file" id="avatar" name="avatar" class="hidden" accept="image/*"
                            onchange="previewAvatar(this)">
                    </label>
                </div>
                <p class="mt-2 text-sm text-gray-500">Rasmni o'zgartirish</p>
                <div class="w-full flex justify-end">
                    <div class="mx-5">
                        <x-button>
                            {{ __('Save') }}
                        </x-button>
                    </div>
                </div>
                @error('avatar')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </form>

            @if (Laravel\Fortify\Features::canUpdateProfileInformation())
                @livewire('profile.update-profile-information-form')

                <x-section-border />
            @endif

            @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::updatePasswords()))
                <div class="mt-10 sm:mt-0">
                    @livewire('profile.update-password-form')
                </div>

                <x-section-border />
            @endif

            @if (Laravel\Fortify\Features::canManageTwoFactorAuthentication())
                <div class="mt-10 sm:mt-0">
                    @livewire('profile.two-factor-authentication-form')
                </div>

                <x-section-border />
            @endif

            <div class="mt-10 sm:mt-0">
                @livewire('profile.logout-other-browser-sessions-form')
            </div>

            @if (Laravel\Jetstream\Jetstream::hasAccountDeletionFeatures())
                <x-section-border />

                <div class="mt-10 sm:mt-0">
                    @livewire('profile.delete-user-form')
                </div>
            @endif
        </div>
    </div>
</x-app-layout>

<!-- Scripts -->
<script>
    // Avatar preview
    function previewAvatar(input) {
        const preview = document.getElementById('avatarPreview');
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.innerHTML =
                    `<img src="${e.target.result}" class="w-32 h-32 rounded-full object-cover border-4 border-white shadow-lg">`;
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
