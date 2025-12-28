<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row items-center justify-between bg-white shadow-md rounded-lg p-4 gap-4">
            <!-- Title -->
            <h2 class="text-2xl font-bold text-gray-900 tracking-wide">
                {{ __('Yangi ish yaratish') }}
            </h2>

            <!-- Button -->
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
                {{-- Tabs: Foydalanuvchi ma'lumotlari / Yangi ish --}}
                <div class="p-6">

                    {{-- Yangi ish form (works) --}}
                    <div>
                        <form action="{{ route('works.store') }}" method="POST" class="space-y-6">
                            @csrf

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="md:col-span-2">
                                    <label for="name" class="block text-sm font-medium text-gray-700">Ish
                                        nomi</label>
                                    <input id="name" name="name" type="text" required
                                        value="{{ old('name') }}"
                                        class="mt-1 block w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                                    @error('name')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="type" class="block text-sm font-medium text-gray-700">Turi</label>
                                    <input id="type" name="type" type="text" required
                                        value="{{ old('type') }}"
                                        class="mt-1 block w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                                        placeholder="Masalan: Qurilish, Tadbir, Xizmat">
                                    @error('type')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="price"
                                        class="block text-sm font-medium text-gray-700">Narxi</label>
                                    <input id="price" name="price" type="number" step="0.01"
                                        min="0" required value="{{ old('price') }}"
                                        class="mt-1 block w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                                    @error('price')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="how_much_people"
                                        class="block text-sm font-medium text-gray-700">Nechta odam</label>
                                    <input id="how_much_people" name="how_much_people" type="number" min="1"
                                        required value="{{ old('how_much_people') }}"
                                        class="mt-1 block w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                                    @error('how_much_people')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="gender" class="block text-sm font-medium text-gray-700">Jinsi
                                        (talab)</label>
                                    <select id="gender" name="gender"
                                        class="mt-1 block w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                                        <option value="" {{ old('gender') === '' ? 'selected' : '' }}>—</option>
                                        <option value="male" {{ old('gender') === 'male' ? 'selected' : '' }}>Erkak
                                        </option>
                                        <option value="female" {{ old('gender') === 'female' ? 'selected' : '' }}>Ayol
                                        </option>
                                        <option value="any" {{ old('gender') === 'any' ? 'selected' : '' }}>Farqi
                                            yo'q</option>
                                    </select>
                                    @error('gender')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="age" class="block text-sm font-medium text-gray-700">Yosh
                                        (talab)</label>
                                    <input id="age" name="age" type="number" min="0"
                                        value="{{ old('age') }}"
                                        class="mt-1 block w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                                    @error('age')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="md:col-span-2">
                                    <label for="description"
                                        class="block text-sm font-medium text-gray-700">Tavsif</label>
                                    <textarea id="description" name="description" rows="4"
                                        class="mt-1 block w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                                        placeholder="Ish haqida batafsil yozing...">{{ old('description') }}</textarea>
                                    @error('description')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="md:col-span-2">
                                    <label class="inline-flex items-center">
                                        <input type="checkbox" name="lunch" value="1"
                                            {{ old('lunch', false) ? 'checked' : '' }}
                                            class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                        <span class="ml-2 text-sm text-gray-700">Tushlik ta'minlanadi</span>
                                    </label>
                                    @error('lunch')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="country"
                                        class="block text-sm font-medium text-gray-700">Davlat</label>
                                    <input id="country" name="country" type="text"
                                        value="{{ old('country') }}"
                                        class="mt-1 block w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                                    @error('country')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="province"
                                        class="block text-sm font-medium text-gray-700">Viloyat</label>
                                    <input id="province" name="province" type="text"
                                        value="{{ old('province') }}"
                                        class="mt-1 block w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                                    @error('province')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="region"
                                        class="block text-sm font-medium text-gray-700">Tuman/Shahar</label>
                                    <input id="region" name="region" type="text" value="{{ old('region') }}"
                                        class="mt-1 block w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                                    @error('region')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="md:col-span-2">
                                    <label for="address"
                                        class="block text-sm font-medium text-gray-700">Manzil</label>
                                    <input id="address" name="address" type="text"
                                        value="{{ old('address') }}"
                                        class="mt-1 block w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                                    @error('address')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="latitude" class="block text-sm font-medium text-gray-700">Kenglik
                                        (lat)</label>
                                    <input id="latitude" name="latitude" type="number" step="0.000001"
                                        value="{{ old('latitude') }}"
                                        class="mt-1 block w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                                    @error('latitude')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="longitude" class="block text-sm font-medium text-gray-700">Uzunlik
                                        (lng)</label>
                                    <input id="longitude" name="longitude" type="number" step="0.000001"
                                        value="{{ old('longitude') }}"
                                        class="mt-1 block w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                                    @error('longitude')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="read_time" class="block text-sm font-medium text-gray-700">O'qishlar
                                        soni</label>
                                    <input id="read_time" name="read_time" type="number" min="0"
                                        value="{{ old('read_time', 0) }}"
                                        class="mt-1 block w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                                    @error('read_time')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="when" class="block text-sm font-medium text-gray-700">Sana</label>
                                    <input id="when" name="when" type="date" required
                                        value="{{ old('when') }}"
                                        class="mt-1 block w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                                    @error('when')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="start_time" class="block text-sm font-medium text-gray-700">Boshlanish
                                        vaqti</label>
                                    <input id="start_time" name="start_time" type="time" required
                                        value="{{ old('start_time') }}"
                                        class="mt-1 block w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                                    @error('start_time')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="finish_time" class="block text-sm font-medium text-gray-700">Tugash
                                        vaqti</label>
                                    <input id="finish_time" name="finish_time" type="time" required
                                        value="{{ old('finish_time') }}"
                                        class="mt-1 block w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                                    @error('finish_time')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="duration" class="block text-sm font-medium text-gray-700">Davomiylik
                                        (kun)</label>
                                    <input id="duration" name="duration" type="number" min="1" required
                                        value="{{ old('duration') }}"
                                        class="mt-1 block w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                                    <p class="mt-1 text-xs text-gray-500">Necha kun davom etadi (masalan: 3).</p>
                                    @error('duration')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="flex items-center justify-end gap-3">
                                <button type="reset"
                                    class="px-4 py-2 rounded-md bg-gray-100 text-gray-700 hover:bg-gray-200 transition">
                                    Tozalash
                                </button>
                                <button type="submit"
                                    class="px-6 py-2 rounded-md bg-indigo-600 text-white hover:bg-indigo-700 font-semibold shadow-sm transition">
                                    Yaratish
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
