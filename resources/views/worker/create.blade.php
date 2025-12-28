<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row items-center justify-between bg-white shadow-md rounded-lg p-4 gap-4">
            <!-- Title -->
            <h2 class="text-2xl font-bold text-gray-900 tracking-wide">
                {{ __('Yangi ish yaratish') }}
            </h2>

            <!-- Button -->
            <a href="{{ route('workers.index') }}" class="w-full md:w-auto">
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

                    {{-- Foydalanuvchi ma'lumotlari form (user_data) --}}
                    <div>
                        <form action="{{ route('user-data.store') }}" method="POST" class="space-y-6">
                            @csrf

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="first_name" class="block text-sm font-medium text-gray-700">Ism</label>
                                    <input id="first_name" name="first_name" type="text" required
                                        value="{{ old('first_name') }}"
                                        class="mt-1 block w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                                    @error('first_name')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="last_name"
                                        class="block text-sm font-medium text-gray-700">Familiya</label>
                                    <input id="last_name" name="last_name" type="text" required
                                        value="{{ old('last_name') }}"
                                        class="mt-1 block w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                                    @error('last_name')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="md:col-span-2">
                                    <label for="bio" class="block text-sm font-medium text-gray-700">Bio</label>
                                    <textarea id="bio" name="bio" rows="3"
                                        class="mt-1 block w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">{{ old('bio') }}</textarea>
                                    @error('bio')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="gender" class="block text-sm font-medium text-gray-700">Jinsi</label>
                                    <select id="gender" name="gender"
                                        class="mt-1 block w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                                        <option value="" {{ old('gender') === '' ? 'selected' : '' }}>—</option>
                                        <option value="male" {{ old('gender') === 'male' ? 'selected' : '' }}>Erkak
                                        </option>
                                        <option value="female" {{ old('gender') === 'female' ? 'selected' : '' }}>Ayol
                                        </option>
                                        <option value="other" {{ old('gender') === 'other' ? 'selected' : '' }}>Boshqa
                                        </option>
                                    </select>
                                    @error('gender')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="birthday" class="block text-sm font-medium text-gray-700">Tug'ilgan
                                        sana</label>
                                    <input id="birthday" name="birthday" type="date" value="{{ old('birthday') }}"
                                        class="mt-1 block w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                                    @error('birthday')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="height" class="block text-sm font-medium text-gray-700">Bo'yi
                                        (sm)</label>
                                    <input id="height" name="height" type="number" step="0.1" min="0"
                                        value="{{ old('height') }}"
                                        class="mt-1 block w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                                    @error('height')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="weight" class="block text-sm font-medium text-gray-700">Vazni
                                        (kg)</label>
                                    <input id="weight" name="weight" type="number" step="0.1" min="0"
                                        value="{{ old('weight') }}"
                                        class="mt-1 block w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                                    @error('weight')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="country" class="block text-sm font-medium text-gray-700">Davlat</label>
                                    <input id="country" name="country" type="text" value="{{ old('country') }}"
                                        class="mt-1 block w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                                    @error('country')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="province"
                                        class="block text-sm font-medium text-gray-700">Viloyat</label>
                                    <input id="province" name="province" type="text" value="{{ old('province') }}"
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
                            </div>

                            <div class="flex items-center justify-end gap-3">
                                <button type="reset"
                                    class="px-4 py-2 rounded-md bg-gray-100 text-gray-700 hover:bg-gray-200 transition">
                                    Tozalash
                                </button>
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
    </div>
</x-app-layout>
