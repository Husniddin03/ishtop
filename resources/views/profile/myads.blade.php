<x-app-layout>
    <x-slot name="header">
        <div class="bg-gradient-to-r from-white via-gray-50 to-white shadow-lg rounded-2xl p-4 md:p-6">
            <!-- Header Content -->
            <div class="flex flex-col lg:flex-row items-start lg:items-center justify-between gap-6">
                <!-- Title and Stats -->
                <div class="flex-1">
                    <h1
                        class="text-3xl md:text-4xl font-bold bg-gradient-to-r from-gray-900 to-indigo-700 bg-clip-text text-transparent">
                        {{ __('Siz e\'lon bergan ishlar') }}
                    </h1>
                    <p class="mt-2 text-gray-600 flex items-center gap-2">
                        <span
                            class="inline-flex items-center px-3 py-1 rounded-full bg-indigo-100 text-indigo-800 text-sm font-medium">
                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z" />
                            </svg>
                            {{ $works->count() }} ta ish
                        </span>
                        <span class="text-sm">•</span>
                        <span class="text-gray-500">e'lon bergansiz</span>
                    </p>
                </div>

                <!-- Create Job Button -->
                <a href="{{ route('works.create') }}"
                    class="group relative inline-flex items-center gap-3 px-6 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-semibold rounded-xl hover:from-indigo-700 hover:to-purple-700 transition-all duration-300 shadow-lg hover:shadow-xl hover:-translate-y-0.5">
                    <div class="p-2 bg-white/20 rounded-lg backdrop-blur-sm">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                    </div>
                    <span>E'lon berish</span>
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Results Section -->
            <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">

                <!-- Jobs Grid -->
                @if ($works->count() > 0)
                    <div class="p-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach ($works as $work)
                                <a href="{{ route('works.show', $work->id) }}"
                                    class="group relative bg-white rounded-2xl border border-gray-200 hover:border-indigo-300 hover:shadow-2xl transition-all duration-300 hover:-translate-y-2 overflow-hidden">

                                    <!-- Premium Badge -->
                                    @if ($work->is_featured)
                                        <div class="absolute top-3 right-3 z-10">
                                            <span
                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-gradient-to-r from-yellow-400 to-orange-500 text-white">
                                                <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                    <path
                                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                                </svg>
                                                Premium
                                            </span>
                                        </div>
                                    @endif

                                    <!-- Job Image -->
                                    <div
                                        class="relative h-48 overflow-hidden bg-gradient-to-br from-gray-100 to-gray-200">
                                        @if ($work->images && $work->images->count() > 0)
                                            <img src="{{ Storage::url($work->images->first()->image) }}"
                                                alt="{{ $work->name }}"
                                                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                        @else
                                            <div
                                                class="w-full h-full flex items-center justify-center bg-gradient-to-br from-indigo-100 to-purple-100">
                                                <div class="text-center p-4">
                                                    <svg class="w-12 h-12 text-indigo-400 mx-auto mb-3" fill="none"
                                                        stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="1.5"
                                                            d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                                    </svg>
                                                    <span
                                                        class="text-sm font-medium text-indigo-700">{{ $work->type }}</span>
                                                </div>
                                            </div>
                                        @endif

                                        <!-- Price Overlay -->
                                        @if ($work->price)
                                            <div class="absolute bottom-3 left-3">
                                                <span
                                                    class="inline-flex items-center px-3 py-1.5 rounded-lg bg-black/80 backdrop-blur-sm text-white text-sm font-bold">
                                                    {{ number_format($work->price, 0, '.', ' ') }} so'm
                                                </span>
                                            </div>
                                        @endif
                                    </div>

                                    <!-- Job Content -->
                                    <div class="p-5">
                                        <!-- Job Type -->
                                        <div class="mb-3">
                                            <span
                                                class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-gradient-to-r from-indigo-100 to-purple-100 text-indigo-700">
                                                {{ $work->type }}
                                            </span>
                                        </div>

                                        <!-- Job Title -->
                                        <h3
                                            class="text-lg font-bold text-gray-900 mb-2 group-hover:text-indigo-600 transition-colors line-clamp-2">
                                            {{ $work->name }}
                                        </h3>

                                        <!-- Short Description -->
                                        <p class="text-gray-600 mb-4 text-sm line-clamp-2">
                                            {{ Str::limit($work->description, 100) }}
                                        </p>

                                        <!-- Job Details -->
                                        <div class="space-y-3 mb-4">
                                            <!-- Location -->
                                            <div class="flex items-center text-sm text-gray-500">
                                                <svg class="w-4 h-4 mr-2 flex-shrink-0" fill="none"
                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                                </svg>
                                                <span class="truncate">
                                                    {{ collect([$work->district, $work->region])->filter()->implode(', ') }}
                                                </span>
                                            </div>

                                            <!-- Date & Time -->
                                            <div class="flex items-center text-sm text-gray-500">
                                                <svg class="w-4 h-4 mr-2 flex-shrink-0" fill="none"
                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                                <span>
                                                    {{ $work->when->format('d.m.Y') }} • {{ $work->duration }} kun
                                                </span>
                                            </div>

                                            <!-- Requirements -->
                                            <div class="flex flex-wrap gap-2">
                                                @if ($work->how_much_people)
                                                    <span
                                                        class="inline-flex items-center text-xs px-2 py-1 rounded bg-blue-50 text-blue-700">
                                                        <svg class="w-3 h-3 mr-1" fill="currentColor"
                                                            viewBox="0 0 20 20">
                                                            <path
                                                                d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z" />
                                                        </svg>
                                                        {{ $work->how_much_people }} kishi
                                                    </span>
                                                @endif

                                                @if ($work->gender)
                                                    <span
                                                        class="inline-flex items-center text-xs px-2 py-1 rounded bg-purple-50 text-purple-700">
                                                        @if ($work->gender === 'male')
                                                            👨
                                                        @elseif($work->gender === 'female')
                                                            👩
                                                        @else
                                                            👥
                                                        @endif
                                                        {{ $work->gender === 'male' ? 'Erkak' : ($work->gender === 'female' ? 'Ayol' : 'Har qanday') }}
                                                    </span>
                                                @endif

                                                @if ($work->lunch)
                                                    <span
                                                        class="inline-flex items-center text-xs px-2 py-1 rounded bg-green-50 text-green-700">
                                                        🍽️ Tushlik
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                        <!-- Footer - Author & Stats -->
                                        <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                                            <div class="flex items-center">
                                                <img src="{{ $work->user->avatar ? Storage::url($work->user->avatar) : 'https://ui-avatars.com/api/?name=' . urlencode($work->user->name) . '&background=6366f1&color=fff&size=128' }}"
                                                    alt="{{ $work->user->name }}"
                                                    class="w-8 h-8 rounded-full border-2 border-white shadow-sm">
                                                <div class="ml-3">
                                                    <p class="text-sm font-medium text-gray-900">
                                                        {{ $work->user->name }}</p>
                                                    <p class="text-xs text-gray-500">
                                                        {{ $work->created_at->diffForHumans() }}</p>
                                                </div>
                                            </div>
                                            <div class="flex items-center gap-3 text-sm text-gray-500">
                                                @if ($work->read_count > 0)
                                                    <span class="flex items-center">
                                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                        </svg>
                                                        {{ $work->read_count }}
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        </div>

                        <!-- Pagination -->
                        @if ($works->hasPages())
                            <div class="mt-8 border-t border-gray-200 pt-6">
                                <div class="flex justify-center">
                                    {{ $works->links() }}
                                </div>
                            </div>
                        @endif

                    </div>
                @else
                    <!-- Empty State -->
                    <div class="text-center py-16">
                        <div
                            class="w-24 h-24 bg-gradient-to-br from-gray-100 to-gray-200 rounded-full flex items-center justify-center mx-auto mb-6">
                            <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Ishlar topilmadi</h3>
                        <p class="text-gray-600 mb-6 max-w-md mx-auto">
                            Kechirasiz, sizda ish elonlari mavjud emas.
                        </p>
                        <a href="{{ route('works.create') }}"
                            class="inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-medium rounded-xl hover:from-indigo-700 hover:to-purple-700 transition-all duration-300 shadow-lg hover:shadow-xl">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                            </svg>
                            Yangi ish eloni
                        </a>
                    </div>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>

<style>
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .line-clamp-3 {
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .location-select {
        transition: all 0.2s ease;
    }

    .location-select:hover {
        border-color: #9ca3af;
    }

    .location-select:focus {
        border-color: #6366f1;
        box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
    }

    /* Custom scrollbar for selects */
    select {
        scrollbar-width: thin;
        scrollbar-color: #c7d2fe #f3f4f6;
    }

    select::-webkit-scrollbar {
        width: 6px;
    }

    select::-webkit-scrollbar-track {
        background: #f3f4f6;
        border-radius: 3px;
    }

    select::-webkit-scrollbar-thumb {
        background-color: #c7d2fe;
        border-radius: 3px;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const regionSelect = document.getElementById('region');
        const districtSelect = document.getElementById('district');
        const villageSelect = document.getElementById('village');
        const searchForm = document.getElementById('searchForm');
        const sortSelect = document.getElementById('sortSelect');
        const resetFiltersBtn = document.getElementById('resetFilters');

        // Get current URL parameters
        const urlParams = new URLSearchParams(window.location.search);
        const currentRegion = urlParams.get('region');
        const currentDistrict = urlParams.get('district');
        const currentVillage = urlParams.get('village');

        // Initialize region change handler
        regionSelect.addEventListener('change', function() {
            updateDistricts(this);
            submitSearch(); // Auto-submit on region change
        });

        // District change handler
        districtSelect.addEventListener('change', function() {
            updateVillages(this);
            if (this.value) {
                submitSearch(); // Auto-submit on district change
            }
        });

        // Village change handler
        villageSelect.addEventListener('change', function() {
            if (this.value) {
                submitSearch(); // Auto-submit on village change
            }
        });

        // Other filters change handlers
        document.querySelectorAll(
            'select[name="type"], select[name="gender"], select[name="lunch"], input[name="min_price"], input[name="max_price"], input[name="how_much_people"], input[name="min_age"], input[name="max_age"]'
        ).forEach(input => {
            // For selects, submit on change
            if (input.tagName === 'SELECT') {
                input.addEventListener('change', function() {
                    if (this.value) {
                        submitSearch();
                    }
                });
            }
            // For number inputs, submit on blur
            if (input.tagName === 'INPUT') {
                input.addEventListener('blur', function() {
                    if (this.value) {
                        submitSearch();
                    }
                });
            }
        });

        // Sort handler
        if (sortSelect) {
            sortSelect.value = urlParams.get('sort') || 'newest';
            sortSelect.addEventListener('change', function() {
                urlParams.set('sort', this.value);
                window.location.search = urlParams.toString();
            });
        }

        // Reset filters
        if (resetFiltersBtn) {
            resetFiltersBtn.addEventListener('click', function() {
                window.location.href = "{{ route('works.index') }}";
            });
        }

        // Function to update districts based on selected region
        function updateDistricts(regionSelect) {
            const selectedOption = regionSelect.options[regionSelect.selectedIndex];
            const districtsData = selectedOption.dataset.districts;

            districtSelect.innerHTML = '<option value="">Tumanni tanlang</option>';
            villageSelect.innerHTML = '<option value="">Avval tumanni tanlang</option>';

            if (!districtsData) return;

            try {
                const districts = JSON.parse(districtsData);
                districts.forEach(district => {
                    const option = document.createElement('option');
                    option.value = district.name;
                    option.textContent = district.name;
                    option.dataset.villages = JSON.stringify(district.villages);
                    districtSelect.appendChild(option);
                });

                // If there's a current district in URL, select it
                if (currentDistrict && districts.some(d => d.name === currentDistrict)) {
                    districtSelect.value = currentDistrict;
                    updateVillages(districtSelect);
                }
            } catch (error) {
                console.error('Error parsing districts:', error);
            }
        }

        // Function to update villages based on selected district
        function updateVillages(districtSelect) {
            const selectedOption = districtSelect.options[districtSelect.selectedIndex];
            const villagesData = selectedOption.dataset.villages;

            villageSelect.innerHTML = '<option value="">Qishloqni tanlang</option>';

            if (!villagesData) return;

            try {
                const villages = JSON.parse(villagesData);
                villages.forEach(village => {
                    const option = document.createElement('option');
                    option.value = village;
                    option.textContent = village;
                    villageSelect.appendChild(option);
                });

                // If there's a current village in URL, select it
                if (currentVillage && villages.includes(currentVillage)) {
                    villageSelect.value = currentVillage;
                }
            } catch (error) {
                console.error('Error parsing villages:', error);
            }
        }

        // Function to submit search form
        function submitSearch() {
            // Remove empty values from form data
            const formData = new FormData(searchForm);
            const params = new URLSearchParams();

            for (const [key, value] of formData.entries()) {
                if (value && value.trim() !== '') {
                    params.append(key, value);
                }
            }

            // Add sort parameter if exists
            if (sortSelect && sortSelect.value) {
                params.append('sort', sortSelect.value);
            }

            // Submit the form via GET request
            window.location.href = `{{ route('works.index') }}?${params.toString()}`;
        }

        // Initialize form with current values
        if (currentRegion) {
            updateDistricts(regionSelect);
        }

        // Filter removal functions
        window.removeFilter = function(filterName) {
            const url = new URL(window.location.href);
            url.searchParams.delete(filterName);
            window.location.href = url.toString();
        };

        window.removePriceFilter = function() {
            const url = new URL(window.location.href);
            url.searchParams.delete('min_price');
            url.searchParams.delete('max_price');
            window.location.href = url.toString();
        };

        // Debounce function for inputs
        function debounce(func, wait) {
            let timeout;
            return function executedFunction(...args) {
                const later = () => {
                    clearTimeout(timeout);
                    func(...args);
                };
                clearTimeout(timeout);
                timeout = setTimeout(later, wait);
            };
        }

        // Apply debounce to number inputs
        const debouncedSubmit = debounce(submitSearch, 1000);
        document.querySelectorAll('input[type="number"]').forEach(input => {
            input.addEventListener('input', debouncedSubmit);
        });
    });
</script>
