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
                    <form action="{{ route('works.store') }}" method="POST" class="space-y-6"
                        enctype="multipart/form-data">
                        @csrf

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Ish nomi -->
                            <div class="md:col-span-2">
                                <label for="name" class="block text-sm font-medium text-gray-700">Ish nomi <span
                                        class="text-red-500">*</span></label>
                                <input id="name" name="name" type="text" required value="{{ old('name') }}"
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
                                <input id="type" name="type" type="text" required value="{{ old('type') }}"
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
                                    required value="{{ old('price') }}"
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
                                    required value="{{ old('how_much_people') }}"
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
                                    <option value="" {{ old('gender') === '' ? 'selected' : '' }}>Farqi yo'q
                                    </option>
                                    <option value="male" {{ old('gender') === 'male' ? 'selected' : '' }}>Erkak
                                    </option>
                                    <option value="female" {{ old('gender') === 'female' ? 'selected' : '' }}>Ayol
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
                                    value="{{ old('age') }}"
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
                                    placeholder="Ish haqida batafsil yozing...">{{ old('description') }}</textarea>
                                @error('description')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Tushlik checkbox -->
                            <div class="md:col-span-2">
                                <label class="inline-flex items-center cursor-pointer">
                                    <input type="checkbox" name="lunch" value="1"
                                        {{ old('lunch', false) ? 'checked' : '' }}
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

                            <!-- Viloyat -->
                            <div>
                                <label for="province" class="block text-sm font-medium text-gray-700">Viloyat <span
                                        class="text-red-500">*</span></label>
                                <select id="province" name="province" required
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                    <option value="">Viloyatni tanlang</option>
                                    @foreach ($regions as $region)
                                        <option value="{{ $region->id }}"
                                            data-districts='@json($region->districts)'
                                            {{ old('province') == $region->id ? 'selected' : '' }}>
                                            {{ $region->name_uz }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('province')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Tuman/Shahar -->
                            <div>
                                <label for="district"
                                    class="block text-sm font-medium text-gray-700">Tuman/Shahar</label>
                                <select id="district" name="district"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                    <option value="">Avval viloyatni tanlang</option>
                                </select>
                                @error('district')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Qishloq/MFY -->
                            <div>
                                <label for="region"
                                    class="block text-sm font-medium text-gray-700">Qishloq/MFY</label>
                                <input id="region" name="region" type="text" value="{{ old('region') }}"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                    placeholder="Qishloq yoki MFY nomini kiriting">
                                @error('region')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Manzil -->
                            <div class="md:col-span-2">
                                <label for="address" class="block text-sm font-medium text-gray-700">To'liq
                                    manzil</label>
                                <input id="address" name="address" type="text" value="{{ old('address') }}"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                    placeholder="Ko'cha, uy raqami va boshqa ma'lumotlar">
                                @error('address')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Harita -->
                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Haritadan joyni
                                    belgilang</label>
                                <div id="map" class="w-full h-96 rounded-lg border-2 border-gray-300 shadow-sm">
                                </div>
                                <p class="mt-2 text-xs text-gray-500">💡 Haritani bosing yoki markerini suring</p>
                            </div>

                            <!-- Hidden koordinatalar -->
                            <input type="hidden" id="latitude" name="latitude"
                                value="{{ old('latitude', '41.2995') }}">
                            <input type="hidden" id="longitude" name="longitude"
                                value="{{ old('longitude', '69.2401') }}">

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
                                    value="{{ old('when') }}"
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
                                            {{ old('duration') == $i ? 'selected' : '' }}>
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
                                    value="{{ old('start_time') }}"
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
                                    value="{{ old('finish_time') }}"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                @error('finish_time')
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
                                Ish yaratish
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

        // Viloyat o'zgarganda tumanlarni yuklash
        document.getElementById('province').addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            const districts = JSON.parse(selectedOption.getAttribute('data-districts') || '[]');
            const districtSelect = document.getElementById('district');

            districtSelect.innerHTML = '<option value="">Tumanni tanlang</option>';

            districts.forEach(district => {
                const option = document.createElement('option');
                option.value = district.id;
                option.textContent = district.name_uz;
                option.setAttribute('data-villages', JSON.stringify(district.villages || []));
                districtSelect.appendChild(option);
            });
        });

        // Google Maps
        let map, marker;

        function initMap() {
            const defaultLocation = {
                lat: parseFloat(document.getElementById('latitude').value) || 41.2995,
                lng: parseFloat(document.getElementById('longitude').value) || 69.2401
            };

            map = new google.maps.Map(document.getElementById('map'), {
                center: defaultLocation,
                zoom: 12,
                mapTypeControl: true,
                streetViewControl: false,
                fullscreenControl: true
            });

            marker = new google.maps.Marker({
                position: defaultLocation,
                map: map,
                draggable: true,
                animation: google.maps.Animation.DROP
            });

            // Haritani bosish
            map.addListener('click', function(event) {
                placeMarker(event.latLng);
            });

            // Markerni surish
            marker.addListener('dragend', function(event) {
                updateCoordinates(event.latLng);
            });

            function placeMarker(location) {
                marker.setPosition(location);
                updateCoordinates(location);
            }

            function updateCoordinates(location) {
                document.getElementById('latitude').value = location.lat().toFixed(6);
                document.getElementById('longitude').value = location.lng().toFixed(6);
            }
        }
    </script>

    <script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAM-lcwS2aMgdJd5AMxE8N_1Lu7M3aHJUw&callback=initMap&libraries=places">
    </script>
</x-app-layout>
