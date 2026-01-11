<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row items-center justify-between bg-white shadow-md rounded-lg p-4 gap-4">
            <h2 class="text-2xl font-bold text-gray-900 tracking-wide">
                {{ __('Yangi ish yaratish') }}
            </h2>
            <a href="{{ route('works.index') }}" class="w-full md:w-auto">
                <button
                    class="w-full md:w-auto px-6 py-2 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold rounded-lg shadow-md transition">
                    Orqaga
                </button>
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6">
                    <form action="{{ route('works.update', $work->id) }}" method="POST" class="space-y-6"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Ish nomi -->
                            <div class="md:col-span-2">
                                <label for="name" class="block text-sm font-medium text-gray-700">Ish nomi <span
                                        class="text-red-500">*</span></label>
                                <input id="name" name="name" type="text" required value="{{ $work->name }}"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                @error('name')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Rasmlar yuklash -->
                            <div class="md:col-span-2">
                                <label for="images" class="block text-sm font-medium text-gray-700 mb-2">Ishga oid
                                    rasmlar</label>
                                <div
                                    class="relative border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-indigo-500 transition cursor-pointer group">
                                    <input id="images" name="images[]" type="file" multiple accept="image/*"
                                        class="absolute inset-0 w-full h-full opacity-0 cursor-pointer"
                                        onchange="updateFileNames(this)">
                                    <svg class="mx-auto h-12 w-12 text-gray-400 group-hover:text-indigo-500 transition"
                                        stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                        <path
                                            d="M28 8H12a4 4 0 00-4 4v20a4 4 0 004 4h24a4 4 0 004-4V20m-14-8l-4-4m0 0l-4 4m4-4v16"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    <p class="mt-2 text-sm text-gray-600">
                                        <span class="font-semibold text-indigo-600">Rasmni tanlang</span> yoki suring
                                    </p>
                                    <p class="text-xs text-gray-500 mt-1">PNG, JPG, GIF maksimal hajmi 10MB</p>
                                </div>
                                <div id="fileNames" class="mt-2 text-sm text-gray-600"></div>
                                @error('images[]')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Turi -->
                            <div>
                                <label for="type" class="block text-sm font-medium text-gray-700">Ish turi <span
                                        class="text-red-500">*</span></label>
                                <input id="type" name="type" type="text" required value="{{ $work->type }}"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                    placeholder="Masalan: Qurilish, Tadbir, Xizmat">
                                @error('type')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Narxi -->
                            <div>
                                <label for="price" class="block text-sm font-medium text-gray-700">Narxi (so'm) <span
                                        class="text-red-500">*</span></label>
                                <input id="price" name="price" type="number" step="0.01" min="0"
                                    required value="{{ $work->price }}"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                @error('price')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Nechta odam -->
                            <div>
                                <label for="how_much_people" class="block text-sm font-medium text-gray-700">Kerakli
                                    odamlar soni <span class="text-red-500">*</span></label>
                                <input id="how_much_people" name="how_much_people" type="number" min="1"
                                    required value="{{ $work->how_much_people }}"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                @error('how_much_people')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Jinsi -->
                            <div>
                                <label for="gender" class="block text-sm font-medium text-gray-700">Jinsi
                                    talabi</label>
                                <select id="gender" name="gender"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                    <option value="" {{ $work->gender == '' ? 'selected' : '' }}>Farqi yo'q
                                    </option>
                                    <option value="male" {{ $work->gender == 'male' ? 'selected' : '' }}>Erkak
                                    </option>
                                    <option value="female" {{ $work->gender == 'female' ? 'selected' : '' }}>Ayol
                                    </option>
                                </select>
                                @error('gender')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Yosh -->
                            <div>
                                <label for="age" class="block text-sm font-medium text-gray-700">Yosh
                                    talabi</label>
                                <input id="age" name="age" type="number" min="0"
                                    value="{{ $work->age }}"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                    placeholder="Masalan: 18">
                                @error('age')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Tavsif -->
                            <div class="md:col-span-2">
                                <label for="description" class="block text-sm font-medium text-gray-700">Ish
                                    tavsifi</label>
                                <textarea id="description" name="description" rows="4"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                    placeholder="Ish haqida batafsil yozing...">{{ $work->description }}</textarea>
                                @error('description')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Tushlik checkbox -->
                            <div class="md:col-span-2">
                                <label class="inline-flex items-center cursor-pointer">
                                    <input type="checkbox" name="lunch" value="1"
                                        {{ $work->lunch == false ? 'checked' : '' }}
                                        class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                                    <span class="ml-2 text-sm text-gray-700">Tushlik ta'minlanadi</span>
                                </label>
                                @error('lunch')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Joylashuv bo'limi -->
                            <div class="md:col-span-2">
                                <h3 class="text-lg font-medium text-gray-900 mb-4 border-b pb-2">📍 Joylashuv
                                    ma'lumotlari</h3>
                            </div>

                            <!-- Davlat -->
                            <div>
                                <label for="country" class="block text-sm font-medium text-gray-700">Davlat</label>
                                <select id="country" name="country"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                    <option value="Uzbekiston" selected>Uzbekiston</option>
                                </select>
                                @error('country')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Viloyat --}}

                            <div>
                                <label class="block text-sm font-medium text-gray-700">Viloyat *</label>
                                <select name="region" id="region"
                                    class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                    <option value="">Viloyatni tanlang</option>
                                    @foreach ($regions as $region)
                                        @php
                                            $districtsData = $region->districts->map(function ($district) {
                                                return [
                                                    'id' => $district->id,
                                                    'name_uz' => $district->name_uz,
                                                    'villages' => $district->villages->map(function ($village) {
                                                        return [
                                                            'id' => $village->id,
                                                            'name_uz' => $village->name_uz,
                                                        ];
                                                    }),
                                                ];
                                            });
                                        @endphp

                                        <option value="{{ $region->id }}"
                                            data-districts='{{ json_encode($districtsData) }}'>
                                            {{ $region->name_uz }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Tuman -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Tuman/Shahar</label>
                                <select name="district" id="district"
                                    class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                    <option value="">Avval viloyatni tanlang</option>
                                </select>
                            </div>

                            <!-- Qishloq -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Qishloq/MFY</label>
                                <select name="village" id="village"
                                    class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                    <option value="">Avval tumanni tanlang</option>
                                </select>
                            </div>


                            <!-- Manzil -->
                            <div class="md:col-span-2">
                                <label for="address" class="block text-sm font-medium text-gray-700">To'liq
                                    manzil</label>
                                <input id="address" name="address" type="text" value="{{ $work->address }}"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                    placeholder="Ko'cha, uy raqami va boshqa ma'lumotlar">
                                @error('address')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Hidden koordinatalar -->
                            <input type="hidden" id="latitude" name="latitude"
                                value="{{ $work->latitude == '41.2995' ? '41.2995' : '' }}">
                            <input type="hidden" id="longitude" name="longitude"
                                value="{{ $work->longitude == '69.2401' ? '69.2401' : '' }}">

                            <!-- Vaqt bo'limi -->
                            <div class="md:col-span-2">
                                <h3 class="text-lg font-medium text-gray-900 mb-4 border-b pb-2">🕐 Vaqt ma'lumotlari
                                </h3>
                            </div>

                            <!-- Sana -->
                            <div>
                                <label for="when" class="block text-sm font-medium text-gray-700">Ish sanasi <span
                                        class="text-red-500">*</span></label>
                                <input id="when" name="when" type="date" required
                                    value="{{ $work->when }}"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                @error('when')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Davomiylik -->
                            <div>
                                <label for="duration" class="block text-sm font-medium text-gray-700">Davomiyligi
                                    (kun)</label>
                                <select id="duration" name="duration"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                    @for ($i = 1; $i <= 30; $i++)
                                        <option value="{{ $i }}"
                                            {{ $work->duration == $i ? 'selected' : '' }}>
                                            {{ $i }} kun
                                        </option>
                                    @endfor
                                </select>
                                @error('duration')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Boshlanish vaqti -->
                            <div>
                                <label for="start_time" class="block text-sm font-medium text-gray-700">Boshlanish
                                    vaqti <span class="text-red-500">*</span></label>
                                <input id="start_time" name="start_time" type="time" required
                                    value="{{ $work->start_time }}"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                @error('start_time')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Tugash vaqti -->
                            <div>
                                <label for="finish_time" class="block text-sm font-medium text-gray-700">Tugash vaqti
                                    <span class="text-red-500">*</span></label>
                                <input id="finish_time" name="finish_time" type="time" required
                                    value="{{ $work->finish_time }}"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                @error('finish_time')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="md:col-span-2">
                                <h3 class="text-lg font-medium text-gray-900 mb-4 border-b pb-2">Bu ish bilan
                                    bog'lanish
                                </h3>
                            </div>

                            <!-- Phone -->
                            <div>
                                <label for="phone" class="block text-sm font-medium text-gray-700">Telefon <span
                                        class="text-red-500">*</span></label>
                                <input id="phone" name="phone" type="text" required
                                    value="{{ $work->userContact->phone ?? '' }}"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                @error('phone')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Telegram -->
                            <div>
                                <label for="telegram" class="block text-sm font-medium text-gray-700">Telegram</label>
                                <input id="telegram" name="telegram" type="text"
                                    value="{{ $work->userContact->telegram ?? '' }}"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                @error('telegram')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Instagram -->
                            <div>
                                <label for="instagram" class="block text-sm font-medium text-gray-700">Instagram<span
                                        class="text-red-500">*</span></label>
                                <input id="instagram" name="instagram" type="text"
                                    value="{{ $work->userContact->instagram ?? '' }}"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                @error('instagram')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Facebook --}}
                            <div>
                                <label for="facebook" class="block text-sm font-medium text-gray-700">Facebook
                                    <span class="text-red-500">*</span></label>
                                <input id="facebook" name="facebook" type="text"
                                    value="{{ $work->userContact->facebook ?? '' }}"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                @error('facebook')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Tugmalar -->
                        <div class="flex items-center justify-end gap-3 pt-4 border-t">
                            <button type="reset"
                                class="px-6 py-2 rounded-md bg-gray-100 text-gray-700 hover:bg-gray-200 font-medium transition">
                                Tozalash
                            </button>
                            <button type="submit"
                                class="px-6 py-2 rounded-md bg-indigo-600 text-white hover:bg-indigo-700 font-semibold shadow-sm transition">
                                Ish yangilash
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script>
        // Fayllar nomini ko'rsatish
        function updateFileNames(input) {
            const fileNames = document.getElementById('fileNames');
            if (input.files.length > 0) {
                fileNames.innerHTML = '<div class="space-y-1">' +
                    Array.from(input.files).map(f =>
                        `<p class="text-indigo-600 flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            ${f.name}
                        </p>`
                    ).join('') + '</div>';
            } else {
                fileNames.innerHTML = '';
            }
        }
    </script>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const regionSelect = document.getElementById('region');
            const districtSelect = document.getElementById('district');
            const villageSelect = document.getElementById('village');

            // Viloyat o'zgarganda
            regionSelect.addEventListener('change', function() {
                // Tuman selectini tozalash
                districtSelect.innerHTML = '<option value="">Tumanni tanlang</option>';

                // Qishloq selectini tozalash
                villageSelect.innerHTML = '<option value="">Avval tumanni tanlang</option>';

                // Agar viloyat tanlanmagan bo'lsa
                if (!this.value) {
                    return;
                }

                // Tanlangan option elementini olish
                const selectedOption = this.options[this.selectedIndex];

                // dataset-dan ma'lumotlarni olish
                const districtsData = selectedOption.dataset.districts;

                // Agar ma'lumot bo'sh yoki undefined bo'lsa
                if (!districtsData || districtsData === 'null' || districtsData === '[]') {
                    console.warn('No districts data found for this region');
                    return;
                }

                try {
                    // JSON ma'lumotlarni parse qilish
                    const districts = JSON.parse(districtsData);

                    // Har bir tuman uchun option yaratish
                    districts.forEach(district => {
                        const option = document.createElement('option');
                        option.value = district.id;
                        option.textContent = district.name_uz;

                        // Tumanning qishloqlarini datasetga saqlash
                        if (district.villages && district.villages.length > 0) {
                            option.dataset.villages = JSON.stringify(district.villages);
                        } else {
                            option.dataset.villages = '[]'; // Bo'sh array
                        }

                        districtSelect.appendChild(option);
                    });
                } catch (error) {
                    console.error('Error parsing districts JSON:', error);
                    console.error('Raw data:', districtsData);
                }
            });

            // Tuman o'zgarganda
            districtSelect.addEventListener('change', function() {
                // Qishloq selectini tozalash
                villageSelect.innerHTML = '<option value="">Qishloqni tanlang</option>';

                // Agar tuman tanlanmagan bo'lsa
                if (!this.value) {
                    return;
                }

                // Tanlangan option elementini olish
                const selectedOption = this.options[this.selectedIndex];

                // dataset-dan qishloq ma'lumotlarini olish
                const villagesData = selectedOption.dataset.villages;

                // Agar ma'lumot bo'sh yoki undefined bo'lsa
                if (!villagesData || villagesData === 'null' || villagesData === '[]') {
                    console.warn('No villages data found for this district');
                    return;
                }

                try {
                    // JSON ma'lumotlarni parse qilish
                    const villages = JSON.parse(villagesData);

                    // Har bir qishloq uchun option yaratish
                    villages.forEach(village => {
                        const option = document.createElement('option');
                        option.value = village.id;
                        option.textContent = village.name_uz;
                        villageSelect.appendChild(option);
                    });
                } catch (error) {
                    console.error('Error parsing villages JSON:', error);
                    console.error('Raw data:', villagesData);
                }
            });

            // Form yuborilganda (ixtiyoriy)
            document.querySelector('form').addEventListener('submit', function(e) {
                const regionValue = regionSelect.value;
                const districtValue = districtSelect.value;

                // Agar viloyat tanlangan, lekin tuman tanlanmagan bo'lsa
                if (regionValue && !districtValue) {
                    e.preventDefault();
                    alert('Iltimos, tumanniyam tanlang!');
                    districtSelect.focus();
                }
            });
        });
    </script>

</x-app-layout>
