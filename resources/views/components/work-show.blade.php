<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">

            <!-- Rasm galereyasi -->
            <div class="relative">
                @if ($work->images && $work->images->count() > 0)
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 p-6">
                        <!-- Asosiy rasm -->
                        <div class="md:col-span-2">
                            <img src="{{ Storage::url($work->images->first()->image) }}" alt="{{ $work->name }}"
                                class="w-full h-96 object-cover rounded-lg shadow-lg">
                        </div>
                        <!-- Qo'shimcha rasmlar -->
                        @foreach ($work->images->skip(1) as $image)
                            <div>
                                <img src="{{ Storage::url($image->image) }}" alt="{{ $work->name }}"
                                    class="w-full h-64 object-cover rounded-lg shadow-md hover:shadow-xl transition-shadow">
                            </div>
                        @endforeach
                    </div>
                @else
                    <div
                        class="h-96 bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center">
                        <p class="text-white text-2xl font-bold">{{ $work->name }}</p>
                    </div>
                @endif
            </div>

            <div class="p-6 md:p-10">
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                    <!-- Chap tomon - Asosiy ma'lumot -->
                    <div class="lg:col-span-2 space-y-6">

                        <!-- Ish turi va narxi -->
                        <div class="flex justify-between items-start">
                            <span
                                class="inline-flex items-center px-4 py-2 rounded-full text-sm font-semibold bg-indigo-100 text-indigo-800">
                                {{ $work->type }}
                            </span>
                            @if ($work->price)
                                <div class="text-right">
                                    <p class="text-3xl font-bold text-gray-900">
                                        {{ number_format($work->price, 0, '.', ' ') }} so'm
                                    </p>
                                    <p class="text-sm text-gray-500">Ish uchun to'lov</p>
                                </div>
                            @endif
                        </div>

                        <!-- Tavsif -->
                        <div>
                            <h3 class="text-xl font-bold text-gray-900 mb-3">Ish haqida</h3>
                            <p class="text-gray-700 leading-relaxed whitespace-pre-line">{{ $work->description }}
                            </p>
                        </div>

                        <!-- Talablar -->
                        <div class="bg-gray-50 rounded-lg p-6">
                            <h3 class="text-lg font-bold text-gray-900 mb-4">Talablar</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                                @if ($work->how_much_people)
                                    <div class="flex items-center">
                                        <div
                                            class="flex-shrink-0 w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center">
                                            <svg class="w-5 h-5 text-blue-600" fill="currentColor"
                                                viewBox="0 0 20 20">
                                                <path
                                                    d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z" />
                                            </svg>
                                        </div>
                                        <div class="ml-3">
                                            <p class="text-sm font-medium text-gray-900">Ishchilar soni</p>
                                            <p class="text-sm text-gray-600">{{ $work->how_much_people }} kishi
                                                kerak</p>
                                        </div>
                                    </div>
                                @endif

                                @if ($work->gender)
                                    <div class="flex items-center">
                                        <div
                                            class="flex-shrink-0 w-10 h-10 bg-purple-100 rounded-full flex items-center justify-center">
                                            <span
                                                class="text-xl">{{ $work->gender === 'male' ? '👨' : ($work->gender === 'female' ? '👩' : '👥') }}</span>
                                        </div>
                                        <div class="ml-3">
                                            <p class="text-sm font-medium text-gray-900">Jins</p>
                                            <p class="text-sm text-gray-600">
                                                {{ $work->gender === 'male' ? 'Erkak' : ($work->gender === 'female' ? 'Ayol' : 'Farqi yo\'q') }}
                                            </p>
                                        </div>
                                    </div>
                                @endif

                                @if ($work->age)
                                    <div class="flex items-center">
                                        <div
                                            class="flex-shrink-0 w-10 h-10 bg-green-100 rounded-full flex items-center justify-center">
                                            <span class="text-xl">🎂</span>
                                        </div>
                                        <div class="ml-3">
                                            <p class="text-sm font-medium text-gray-900">Yosh</p>
                                            <p class="text-sm text-gray-600">{{ $work->age }} yosh atrofi</p>
                                        </div>
                                    </div>
                                @endif

                                @if ($work->lunch !== null)
                                    <div class="flex items-center">
                                        <div
                                            class="flex-shrink-0 w-10 h-10 bg-orange-100 rounded-full flex items-center justify-center">
                                            <span class="text-xl">🍽️</span>
                                        </div>
                                        <div class="ml-3">
                                            <p class="text-sm font-medium text-gray-900">Ovqatlanish</p>
                                            <p class="text-sm text-gray-600">
                                                {{ $work->lunch ? 'Tushlik beriladi' : 'Tushlik berilmaydi' }}
                                            </p>
                                        </div>
                                    </div>
                                @endif

                            </div>
                        </div>

                        <!-- Vaqt jadvali -->
                        @if ($work->when || $work->start_time || $work->duration)
                            <div class="bg-indigo-50 rounded-lg p-6">
                                <h3 class="text-lg font-bold text-gray-900 mb-4">Vaqt jadvali</h3>
                                <div class="space-y-3">

                                    @if ($work->when)
                                        <div class="flex items-center">
                                            <svg class="w-5 h-5 text-indigo-600 mr-3" fill="currentColor"
                                                viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                            <div>
                                                <p class="text-sm font-medium text-gray-900">Boshlanish sanasi</p>
                                                <p class="text-lg font-bold text-indigo-600">
                                                    {{ $work->when->format('d F Y') }}</p>
                                            </div>
                                        </div>
                                    @endif

                                    @if ($work->start_time && $work->finish_time)
                                        <div class="flex items-center">
                                            <svg class="w-5 h-5 text-indigo-600 mr-3" fill="currentColor"
                                                viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                            <div>
                                                <p class="text-sm font-medium text-gray-900">Ish vaqti</p>
                                                <p class="text-lg font-bold text-indigo-600">
                                                    {{ $work->start_time }} - {{ $work->finish_time }}</p>
                                            </div>
                                        </div>
                                    @endif

                                    @if ($work->duration)
                                        <div class="flex items-center">
                                            <svg class="w-5 h-5 text-indigo-600 mr-3" fill="currentColor"
                                                viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                            <div>
                                                <p class="text-sm font-medium text-gray-900">Davomiyligi</p>
                                                <p class="text-lg font-bold text-indigo-600">{{ $work->duration }} kun
                                                </p>
                                            </div>
                                        </div>
                                    @endif

                                </div>
                            </div>
                        @endif

                    </div>

                    <!-- O'ng tomon - Qo'shimcha ma'lumot -->
                    <div class="space-y-6">

                        <!-- Muallif kartochkasi -->
                        <div class="bg-white border-2 border-gray-200 rounded-lg p-6 shadow-sm">
                            <h3 class="text-lg font-bold text-gray-900 mb-4">Ish beruvchi</h3>
                            <div class="flex items-center mb-4">
                                <img src="{{ $work->user->avatar ? Storage::url($work->user->avatar) : 'https://ui-avatars.com/api/?name=' . urlencode($work->user->name) . '&background=6366f1&color=fff&size=128' }}"
                                    alt="{{ $work->user->name }}"
                                    class="w-16 h-16 rounded-full object-cover ring-4 ring-indigo-100">
                                <div class="ml-4">
                                    <h4 class="text-lg font-bold text-gray-900">{{ $work->user->name }}</h4>
                                    <p class="text-sm text-gray-500">{{ $work->user->email }}</p>
                                </div>
                            </div>

                            @if ($work->user->phone)
                                <a href="tel:{{ $work->user->phone }}"
                                    class="flex items-center justify-center w-full px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors mb-2">
                                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path
                                            d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z" />
                                    </svg>
                                    Qo'ng'iroq qilish
                                </a>
                            @endif

                            <button
                                class="flex items-center justify-center w-full px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition-colors">
                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                                    <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                                </svg>
                                Xabar yuborish
                            </button>
                        </div>

                        <!-- Manzil -->
                        @if ($work->country || $work->address)
                            <div class="bg-white border-2 border-gray-200 rounded-lg p-6 shadow-sm">
                                <h3 class="text-lg font-bold text-gray-900 mb-4">Manzil</h3>
                                <div class="space-y-2">
                                    @if ($work->country)
                                        <div class="flex items-start">
                                            <svg class="w-5 h-5 text-gray-500 mr-2 mt-0.5" fill="currentColor"
                                                viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                            <div class="text-sm text-gray-700">
                                                <p class="font-medium">{{ $work->country }}</p>
                                                @if ($work->region)
                                                    <p>{{ $work->region }}</p>
                                                @endif
                                                @if ($work->district)
                                                    <p>{{ $work->district }}</p>
                                                @endif
                                                @if ($work->village)
                                                    <p>{{ $work->village }}</p>
                                                @endif
                                                
                                                @if ($work->address)
                                                    <p class="mt-1">{{ $work->address }}</p>
                                                @endif
                                            </div>
                                        </div>
                                    @endif

                                    @if ($work->latitude && $work->longitude)
                                        <a href="https://www.google.com/maps?q={{ $work->latitude }},{{ $work->longitude }}"
                                            target="_blank"
                                            class="inline-flex items-center text-sm text-indigo-600 hover:text-indigo-800 mt-2">
                                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M12.586 4.586a2 2 0 112.828 2.828l-3 3a2 2 0 01-2.828 0 1 1 0 00-1.414 1.414 4 4 0 005.656 0l3-3a4 4 0 00-5.656-5.656l-1.5 1.5a1 1 0 101.414 1.414l1.5-1.5zm-5 5a2 2 0 012.828 0 1 1 0 101.414-1.414 4 4 0 00-5.656 0l-3 3a4 4 0 105.656 5.656l1.5-1.5a1 1 0 10-1.414-1.414l-1.5 1.5a2 2 0 11-2.828-2.828l3-3z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                            Xaritada ko'rish
                                        </a>
                                    @endif
                                </div>
                            </div>
                        @endif

                        <!-- Qo'shimcha ma'lumot -->
                        <div class="bg-gray-50 rounded-lg p-6">
                            <h3 class="text-sm font-semibold text-gray-900 mb-3">E'lon haqida</h3>
                            <div class="space-y-2 text-sm text-gray-600">
                                <div class="flex justify-between">
                                    <span>Joylangan:</span>
                                    <span class="font-medium">{{ $work->created_at->format('d.m.Y H:i') }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span>Yangilangan:</span>
                                    <span class="font-medium">{{ $work->updated_at->diffForHumans() }}</span>
                                </div>
                                @if ($work->read_count)
                                    <div class="flex justify-between">
                                        <span>Ko'rishlar soni:</span>
                                        <span class="font-medium">{{ $work->read_count }}</span>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Ariza berish tugmasi -->
                        <button
                            class="w-full py-4 bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-bold rounded-lg hover:from-indigo-700 hover:to-purple-700 transition-all shadow-lg hover:shadow-xl">
                            Ishga ariza berish
                        </button>

                    </div>

                </div>
            </div>

        </div>
    </div>
</div>
