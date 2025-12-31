<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <div class="p-6">
                <form action="{{ route('workers.store') }}" method="POST" class="space-y-6" enctype="multipart/form-data">
                    @csrf

                    <!-- Foydalanuvchi avatarini yangilash -->
                    <div class="flex flex-col items-center mb-8">
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
                        @error('avatar')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Ism -->
                        <div>
                            <label for="first_name" class="block text-sm font-medium text-gray-700">Ism *</label>
                            <input id="first_name" name="first_name" type="text" required
                                value="{{ old('first_name', $userData->first_name ?? '') }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            @error('first_name')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Familiya -->
                        <div>
                            <label for="last_name" class="block text-sm font-medium text-gray-700">Familiya *</label>
                            <input id="last_name" name="last_name" type="text" required
                                value="{{ old('last_name', $userData->last_name ?? '') }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            @error('last_name')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Bio -->
                        <div class="md:col-span-2">
                            <label for="bio" class="block text-sm font-medium text-gray-700">Bio (qisqacha
                                ma'lumot)</label>
                            <textarea id="bio" name="bio" rows="3"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                placeholder="O'zingiz haqingizda qisqacha...">{{ old('bio', $userData->bio ?? '') }}</textarea>
                            @error('bio')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Jinsi -->
                        <div>
                            <label for="gender" class="block text-sm font-medium text-gray-700">Jinsi</label>
                            <select id="gender" name="gender"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                <option value="">Tanlang</option>
                                <option value="male"
                                    {{ old('gender', $userData->gender ?? '') == 'male' ? 'selected' : '' }}>Erkak
                                </option>
                                <option value="female"
                                    {{ old('gender', $userData->gender ?? '') == 'female' ? 'selected' : '' }}>Ayol
                                </option>
                            </select>
                            @error('gender')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Tug'ilgan sanasi -->
                        <div>
                            <label for="birthday" class="block text-sm font-medium text-gray-700">Tug'ilgan
                                sanasi</label>
                            <input id="birthday" name="birthday" type="date"
                                value="{{ old('birthday', $userData->birthday ?? '') }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            @error('birthday')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Bo'y -->
                        <div>
                            <label for="height" class="block text-sm font-medium text-gray-700">Bo'y (cm)</label>
                            <input id="height" name="height" type="number" step="0.1" min="0"
                                value="{{ old('height', $userData->height ?? '') }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            @error('height')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Vazn -->
                        <div>
                            <label for="weight" class="block text-sm font-medium text-gray-700">Vazn (kg)</label>
                            <input id="weight" name="weight" type="number" step="0.1" min="0"
                                value="{{ old('weight', $userData->weight ?? '') }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            @error('weight')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Aloqa ma'lumotlari bo'limi -->
                        <div class="md:col-span-2">
                            <h3 class="text-lg font-medium text-gray-900 mb-4 border-b pb-2">📞 Aloqa ma'lumotlari</h3>
                        </div>

                        <!-- Telefon -->
                        <div>
                            <label for="phone" class="block text-sm font-medium text-gray-700">Telefon
                                raqam</label>
                            <input id="phone" name="phone" type="tel"
                                value="{{ old('phone', $userContact->phone ?? '') }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                placeholder="+998 XX XXX XX XX">
                            @error('phone')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Telegram -->
                        <div>
                            <label for="telegram" class="block text-sm font-medium text-gray-700">Telegram</label>
                            <input id="telegram" name="telegram" type="text"
                                value="{{ old('telegram', $userContact->telegram ?? '') }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                placeholder="@username">
                            @error('telegram')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Facebook -->
                        <div>
                            <label for="facebook" class="block text-sm font-medium text-gray-700">Facebook</label>
                            <input id="facebook" name="facebook" type="text"
                                value="{{ old('facebook', $userContact->facebook ?? '') }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                placeholder="https://facebook.com/username">
                            @error('facebook')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Instagram -->
                        <div>
                            <label for="instagram" class="block text-sm font-medium text-gray-700">Instagram</label>
                            <input id="instagram" name="instagram" type="text"
                                value="{{ old('instagram', $userContact->instagram ?? '') }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                placeholder="https://instagram.com/username">
                            @error('instagram')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Joylashuv bo'limi -->
                        <div class="md:col-span-2">
                            <h3 class="text-lg font-medium text-gray-900 mb-4 border-b pb-2">📍 Joylashuv</h3>
                        </div>

                        <!-- Davlat -->
                        <div>
                            <label for="country" class="block text-sm font-medium text-gray-700">Davlat</label>
                            <select id="country" name="country"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                <option value="Uzbekiston" {{ old('country') == 'Uzbekiston' ? 'selected' : '' }}>
                                    O'zbekiston</option>
                                <!-- Boshqa davlatlar qo'shishingiz mumkin -->
                            </select>
                            @error('country')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- viloyat --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Viloyat *</label>
                            <select name="region" id="region" class="mt-1 w-full rounded-md border-gray-300">
                                <option value="">Viloyatni tanlang</option>
                                @foreach ($regions as $region)
                                    <option value="{{ $region->id }}"
                                        data-districts='@json($region->districts)'>
                                        {{ $region->name_uz }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Tuman -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Tuman/Shahar</label>
                            <select name="district" id="district" class="mt-1 w-full rounded-md border-gray-300">
                                <option value="">Avval viloyatni tanlang</option>
                            </select>
                        </div>

                        <!-- Qishloq -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Qishloq/MFY</label>
                            <select name="village" id="village" class="mt-1 w-full rounded-md border-gray-300">
                                <option value="">Avval tumanni tanlang</option>
                            </select>
                        </div>

                        <!-- To'liq manzil -->
                        <div class="md:col-span-2">
                            <label for="address" class="block text-sm font-medium text-gray-700">To'liq
                                manzil</label>
                            <input id="address" name="address" type="text"
                                value="{{ old('address', $userData->address ?? '') }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                placeholder="Ko'cha, uy raqami">
                            @error('address')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Tugmalar -->
                    <div class="flex items-center justify-end gap-3 pt-6 border-t">
                        <a href="{{ route('workers.index') }}"
                            class="px-6 py-2 rounded-md bg-gray-100 text-gray-700 hover:bg-gray-200 font-medium transition">
                            Bekor qilish
                        </a>
                        <button type="submit"
                            class="px-6 py-2 rounded-md bg-indigo-600 text-white hover:bg-indigo-700 font-semibold shadow-sm transition">
                            Saqlash
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

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


<script>
    const regionSelect = document.getElementById('region');
    const districtSelect = document.getElementById('district');
    const villageSelect = document.getElementById('village');

    regionSelect.addEventListener('change', function() {
        districtSelect.innerHTML = '<option value="">Tumanni tanlang</option>';
        villageSelect.innerHTML = '<option value="">Avval tumanni tanlang</option>';

        if (!this.value) return;

        const districts = JSON.parse(
            this.options[this.selectedIndex].dataset.districts
        );

        districts.forEach(district => {
            const option = document.createElement('option');
            option.value = district.id;
            option.textContent = district.name_uz;
            option.dataset.villages = JSON.stringify(district.villages);
            districtSelect.appendChild(option);
        });
    });

    districtSelect.addEventListener('change', function() {
        villageSelect.innerHTML = '<option value="">Qishloqni tanlang</option>';

        if (!this.value) return;

        const villages = JSON.parse(
            this.options[this.selectedIndex].dataset.villages
        );

        villages.forEach(village => {
            const option = document.createElement('option');
            option.value = village.id;
            option.textContent = village.name_uz;
            villageSelect.appendChild(option);
        });
    });
</script>
