<!DOCTYPE html>
<html lang="uz" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="KunbayIsh - O'zbekistonda ish topish va ishchilar yollash platformasi">
    <title>KunbayIsh - Ish Toping yoki Ishchi Yollang</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">

    <style>
        * {
            font-family: 'Inter', sans-serif;
        }

        .hero-gradient {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .stat-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        .feature-card {
            transition: all 0.3s ease;
        }

        .feature-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        }

        .testimonial-card {
            transition: transform 0.3s ease;
        }

        .testimonial-card:hover {
            transform: translateY(-5px);
        }

        .btn-glow {
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
        }

        .btn-glow:hover {
            box-shadow: 0 6px 20px rgba(102, 126, 234, 0.6);
        }

        .floating {
            animation: floating 3s ease-in-out infinite;
        }

        @keyframes floating {

            0%,
            100% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-10px);
            }
        }

        .pulse {
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.05);
            }

            100% {
                transform: scale(1);
            }
        }
    </style>
</head>

<body class="bg-gray-50">
    <!-- Header/Navbar -->
    <nav class="bg-white shadow-lg sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20">
                <div class="flex items-center">
                    <div class="flex-shrink-0 flex items-center">
                        <i class="fas fa-handshake text-3xl text-indigo-600 mr-3"></i>
                        <span class="text-2xl font-bold text-gray-900">Kunbay<span
                                class="text-indigo-600">Ish</span></span>
                    </div>
                    <div class="hidden md:ml-10 md:flex md:space-x-8">
                        <a href="#features"
                            class="text-gray-700 hover:text-indigo-600 px-3 py-2 text-sm font-medium transition">Imkoniyatlar</a>
                        <a href="#how-it-works"
                            class="text-gray-700 hover:text-indigo-600 px-3 py-2 text-sm font-medium transition">Qanday
                            Ishlasa</a>
                        <a href="#testimonials"
                            class="text-gray-700 hover:text-indigo-600 px-3 py-2 text-sm font-medium transition">Foydalanuvchilar</a>
                        <a href="#faq"
                            class="text-gray-700 hover:text-indigo-600 px-3 py-2 text-sm font-medium transition">Savol-Javob</a>
                    </div>
                </div>
                <div class="flex items-center">
                    @auth
                        <a href="{{ route('dashboard') }}" class="text-gray-700 hover:text-indigo-600 mr-6 font-medium">
                            <i class="fas fa-tachometer-alt mr-2"></i>Dashboard
                        </a>
                        <a href="{{ route('workers.create') }}"
                            class="bg-indigo-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-indigo-700 transition btn-glow">
                            <i class="fas fa-plus mr-2"></i>Ish Joylash
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="text-gray-700 hover:text-indigo-600 mr-6 font-medium">
                            <i class="fas fa-sign-in-alt mr-2"></i>Kirish
                        </a>
                        <a href="{{ route('register') }}"
                            class="bg-indigo-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-indigo-700 transition btn-glow">
                            <i class="fas fa-user-plus mr-2"></i>Ro'yxatdan o'tish
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-gradient pt-20 pb-32 overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col lg:flex-row items-center">
                <div class="lg:w-1/2 text-white mb-12 lg:mb-0">
                    <h1 class="text-4xl md:text-6xl font-bold mb-6 leading-tight">
                        <span class="block">Oson va Tez</span>
                        <span class="block">Ish Toping yoki</span>
                        <span class="block text-yellow-300">Ishchi Yollang</span>
                    </h1>
                    <p class="text-xl mb-8 opacity-90">
                        KunbayIsh - O'zbekistondagi eng yirik kunlik ish va ishchilar platformasi.
                        Har qanday turdagi ishlarni toping yoki o'zingizga kerakli ishchilarni yollang.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4">
                        @auth
                            <a href="{{ route('workers.index') }}"
                                class="bg-white text-indigo-600 px-8 py-4 rounded-lg font-bold text-lg hover:bg-gray-100 transition transform hover:scale-105 pulse">
                                <i class="fas fa-search mr-2"></i>Ishlarni Ko'rish
                            </a>
                        @else
                            <a href="{{ route('worker.create') }}"
                                class="bg-white text-indigo-600 px-8 py-4 rounded-lg font-bold text-lg hover:bg-gray-100 transition transform hover:scale-105">
                                <i class="fas fa-briefcase mr-2"></i>Ishchi Bo'ling
                            </a>
                            <a href="{{ route('work.create') }}"
                                class="bg-yellow-400 text-gray-900 px-8 py-4 rounded-lg font-bold text-lg hover:bg-yellow-500 transition transform hover:scale-105">
                                <i class="fas fa-user-tie mr-2"></i>Ish Beruvchi Bo'ling
                            </a>
                        @endauth
                    </div>
                    <div class="mt-10 flex items-center space-x-8">
                        <div class="flex items-center">
                            <div class="bg-white bg-opacity-20 rounded-full p-2 mr-3">
                                <i class="fas fa-check text-white"></i>
                            </div>
                            <span>Hech qanday komissiya</span>
                        </div>
                        <div class="flex items-center">
                            <div class="bg-white bg-opacity-20 rounded-full p-2 mr-3">
                                <i class="fas fa-check text-white"></i>
                            </div>
                            <span>100% xavfsiz</span>
                        </div>
                    </div>
                </div>
                <div class="lg:w-1/2 relative">
                    <div class="relative floating">
                        <div class="absolute -top-6 -left-6 w-64 h-64 bg-yellow-400 rounded-full opacity-20 blur-xl">
                        </div>
                        <div class="absolute -bottom-6 -right-6 w-64 h-64 bg-pink-500 rounded-full opacity-20 blur-xl">
                        </div>
                        <img src="https://images.unsplash.com/photo-1581094794329-c8112a89af12?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80"
                            alt="Ishchi va Ish beruvchi" class="relative rounded-2xl shadow-2xl border-8 border-white">
                    </div>

                    <!-- Stats Cards Floating -->
                    <div class="absolute -left-10 top-1/4 bg-white p-4 rounded-xl shadow-2xl">
                        <div class="flex items-center">
                            <div class="bg-indigo-100 p-3 rounded-lg mr-3">
                                <i class="fas fa-users text-indigo-600 text-xl"></i>
                            </div>
                            <div>
                                <p class="text-2xl font-bold text-gray-900">10,000+</p>
                                <p class="text-gray-600 text-sm">Faol foydalanuvchi</p>
                            </div>
                        </div>
                    </div>

                    <div class="absolute -right-10 bottom-1/4 bg-white p-4 rounded-xl shadow-2xl">
                        <div class="flex items-center">
                            <div class="bg-green-100 p-3 rounded-lg mr-3">
                                <i class="fas fa-tasks text-green-600 text-xl"></i>
                            </div>
                            <div>
                                <p class="text-2xl font-bold text-gray-900">5,000+</p>
                                <p class="text-gray-600 text-sm">Muvaffaqiyatli ish</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                <div class="stat-card bg-indigo-50 p-6 rounded-2xl text-center">
                    <div class="text-indigo-600 text-4xl mb-3">
                        <i class="fas fa-briefcase"></i>
                    </div>
                    <p class="text-3xl font-bold text-gray-900">2,500+</p>
                    <p class="text-gray-600">Faol ishlar</p>
                </div>
                <div class="stat-card bg-green-50 p-6 rounded-2xl text-center">
                    <div class="text-green-600 text-4xl mb-3">
                        <i class="fas fa-user-check"></i>
                    </div>
                    <p class="text-3xl font-bold text-gray-900">98%</p>
                    <p class="text-gray-600">Qoniqish darajasi</p>
                </div>
                <div class="stat-card bg-yellow-50 p-6 rounded-2xl text-center">
                    <div class="text-yellow-600 text-4xl mb-3">
                        <i class="fas fa-map-marker-alt"></i>
                    </div>
                    <p class="text-3xl font-bold text-gray-900">14</p>
                    <p class="text-gray-600">Viloyatlar</p>
                </div>
                <div class="stat-card bg-pink-50 p-6 rounded-2xl text-center">
                    <div class="text-pink-600 text-4xl mb-3">
                        <i class="fas fa-clock"></i>
                    </div>
                    <p class="text-3xl font-bold text-gray-900">24/7</p>
                    <p class="text-gray-600">Qo'llab-quvvatlash</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-6">Nega <span
                        class="text-indigo-600">KunbayIsh</span> Tanlashadi?</h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    Bizning platforma orqali ish topish va ishchi yollash jarayonini soddalashtirdik
                </p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Feature 1 -->
                <div class="feature-card bg-white p-8 rounded-2xl shadow-lg">
                    <div class="bg-indigo-100 w-16 h-16 rounded-xl flex items-center justify-center mb-6">
                        <i class="fas fa-bolt text-indigo-600 text-2xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Tez va Oson</h3>
                    <p class="text-gray-600 mb-4">
                        Bir necha daqiqa ichida ish joylashtiring yoki ish toping.
                        Oddiy interfeys va intuitiv boshqaruv.
                    </p>
                    <ul class="space-y-2">
                        <li class="flex items-center text-gray-600">
                            <i class="fas fa-check-circle text-green-500 mr-2"></i>
                            <span>5 daqiqada ro'yxatdan o'tish</span>
                        </li>
                        <li class="flex items-center text-gray-600">
                            <i class="fas fa-check-circle text-green-500 mr-2"></i>
                            <span>Bir marta bosishda ish joylash</span>
                        </li>
                    </ul>
                </div>

                <!-- Feature 2 -->
                <div class="feature-card bg-white p-8 rounded-2xl shadow-lg">
                    <div class="bg-green-100 w-16 h-16 rounded-xl flex items-center justify-center mb-6">
                        <i class="fas fa-shield-alt text-green-600 text-2xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Xavfsiz va Ishonchli</h3>
                    <p class="text-gray-600 mb-4">
                        Barcha foydalanuvchilar tekshiriladi. Pul to'lovlari xavfsiz.
                        Har bir ish uchun kafolat.
                    </p>
                    <ul class="space-y-2">
                        <li class="flex items-center text-gray-600">
                            <i class="fas fa-check-circle text-green-500 mr-2"></i>
                            <span>Foydalanuvchi tekshiruvi</span>
                        </li>
                        <li class="flex items-center text-gray-600">
                            <i class="fas fa-check-circle text-green-500 mr-2"></i>
                            <span>Xavfsiz to'lov tizimi</span>
                        </li>
                    </ul>
                </div>

                <!-- Feature 3 -->
                <div class="feature-card bg-white p-8 rounded-2xl shadow-lg">
                    <div class="bg-yellow-100 w-16 h-16 rounded-xl flex items-center justify-center mb-6">
                        <i class="fas fa-search-dollar text-yellow-600 text-2xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Hamyonbop Narxlar</h3>
                    <p class="text-gray-600 mb-4">
                        Hech qanday yashirin to'lovlar yo'q. Ish beruvchilar bepul e'lon beradi.
                        Ishchilar uchun bepul.
                    </p>
                    <ul class="space-y-2">
                        <li class="flex items-center text-gray-600">
                            <i class="fas fa-check-circle text-green-500 mr-2"></i>
                            <span>Ish joylash bepul</span>
                        </li>
                        <li class="flex items-center text-gray-600">
                            <i class="fas fa-check-circle text-green-500 mr-2"></i>
                            <span>Hech qanday komissiya</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- How It Works Section -->
    <section id="how-it-works" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-6">Qanday <span
                        class="text-indigo-600">Ishlaydi</span>?</h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    KunbayIsh orqali ish topish yoki ishchi yollash uchun faqat 3 oddiy qadam
                </p>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                <!-- Step 1 -->
                <div class="text-center relative">
                    <div class="relative">
                        <div class="bg-indigo-100 w-24 h-24 rounded-2xl flex items-center justify-center mx-auto mb-6">
                            <span class="text-4xl font-bold text-indigo-600">1</span>
                        </div>
                        <div class="hidden md:block absolute top-12 -right-4 w-8 h-0.5 bg-indigo-300"></div>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Ro'yxatdan O'ting</h3>
                    <p class="text-gray-600">
                        Tezkor ro'yxatdan o'ting. Faqat ism va telefon raqamingiz kifoya.
                    </p>
                    <div class="mt-6">
                        <div class="bg-gray-100 p-4 rounded-xl inline-block">
                            <i class="fas fa-user-plus text-3xl text-indigo-600"></i>
                        </div>
                    </div>
                </div>

                <!-- Step 2 -->
                <div class="text-center relative">
                    <div class="relative">
                        <div class="bg-indigo-100 w-24 h-24 rounded-2xl flex items-center justify-center mx-auto mb-6">
                            <span class="text-4xl font-bold text-indigo-600">2</span>
                        </div>
                        <div class="hidden md:block absolute top-12 -right-4 w-8 h-0.5 bg-indigo-300"></div>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Ish Joylashtiring yoki Toping</h3>
                    <p class="text-gray-600">
                        Ish beruvchi sifatida ish joylashtiring yoki ishchi sifatida ish qidiring.
                    </p>
                    <div class="mt-6">
                        <div class="bg-gray-100 p-4 rounded-xl inline-block">
                            <i class="fas fa-search text-3xl text-indigo-600"></i>
                        </div>
                    </div>
                </div>

                <!-- Step 3 -->
                <div class="text-center">
                    <div class="bg-indigo-100 w-24 h-24 rounded-2xl flex items-center justify-center mx-auto mb-6">
                        <span class="text-4xl font-bold text-indigo-600">3</span>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Ishni Boshlang</h3>
                    <p class="text-gray-600">
                        Kelishuvga erishing va ishni boshlang. Barchasi shu qadar oddiy!
                    </p>
                    <div class="mt-6">
                        <div class="bg-gray-100 p-4 rounded-xl inline-block">
                            <i class="fas fa-handshake text-3xl text-indigo-600"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- CTA Button -->
            <div class="text-center mt-16">
                @auth
                    <a href="{{ route('workers.create') }}"
                        class="bg-indigo-600 text-white px-10 py-4 rounded-xl font-bold text-lg hover:bg-indigo-700 transition transform hover:scale-105 inline-flex items-center btn-glow">
                        <i class="fas fa-rocket mr-3"></i>Ish Joylashni Boshlash
                    </a>
                @else
                    <a href="{{ route('register') }}"
                        class="bg-indigo-600 text-white px-10 py-4 rounded-xl font-bold text-lg hover:bg-indigo-700 transition transform hover:scale-105 inline-flex items-center btn-glow">
                        <i class="fas fa-play-circle mr-3"></i>Boshlash
                    </a>
                @endauth
            </div>
        </div>
    </section>

    <!-- Job Categories -->
    <section class="py-20 bg-gradient-to-b from-white to-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-6">Mashhur <span
                        class="text-indigo-600">Ish Turlari</span></h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    Har qanday sohada ish toping yoki ishchi yollang
                </p>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4">
                @php
                    $categories = [
                        ['icon' => 'fa-building', 'name' => 'Qurilish', 'color' => 'bg-blue-100 text-blue-600'],
                        [
                            'icon' => 'fa-truck-loading',
                            'name' => 'Yuk Tashish',
                            'color' => 'bg-orange-100 text-orange-600',
                        ],
                        [
                            'icon' => 'fa-paint-roller',
                            'name' => 'Ta\'mirlash',
                            'color' => 'bg-green-100 text-green-600',
                        ],
                        ['icon' => 'fa-users', 'name' => 'Tadbirlar', 'color' => 'bg-purple-100 text-purple-600'],
                        ['icon' => 'fa-leaf', 'name' => 'Bog\'bonlik', 'color' => 'bg-green-100 text-green-600'],
                        ['icon' => 'fa-tools', 'name' => 'Usta', 'color' => 'bg-red-100 text-red-600'],
                        ['icon' => 'fa-car', 'name' => 'Haydovchi', 'color' => 'bg-indigo-100 text-indigo-600'],
                        [
                            'icon' => 'fa-graduation-cap',
                            'name' => 'O\'qituvchi',
                            'color' => 'bg-yellow-100 text-yellow-600',
                        ],
                        ['icon' => 'fa-utensils', 'name' => 'Oshpaz', 'color' => 'bg-pink-100 text-pink-600'],
                        ['icon' => 'fa-laptop-house', 'name' => 'Uyda Ish', 'color' => 'bg-teal-100 text-teal-600'],
                        [
                            'icon' => 'fa-hand-holding-heart',
                            'name' => 'Parvarish',
                            'color' => 'bg-rose-100 text-rose-600',
                        ],
                        ['icon' => 'fa-store', 'name' => 'Sotuvchi', 'color' => 'bg-cyan-100 text-cyan-600'],
                    ];
                @endphp

                @foreach ($categories as $category)
                    <a href="{{ route('workers.index') }}?category={{ urlencode($category['name']) }}"
                        class="bg-white p-4 rounded-xl shadow-sm hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1 text-center group">
                        <div
                            class="{{ $category['color'] }} w-12 h-12 rounded-lg flex items-center justify-center mx-auto mb-3 group-hover:scale-110 transition">
                            <i class="fas {{ $category['icon'] }} text-lg"></i>
                        </div>
                        <p class="font-medium text-gray-900 group-hover:text-indigo-600 transition">
                            {{ $category['name'] }}</p>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section id="testimonials" class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-6">Foydalanuvchilar <span
                        class="text-indigo-600">Fikrlari</span></h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    Platformamiz foydalanuvchilarining haqiqiy sharhlari
                </p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Testimonial 1 -->
                <div class="testimonial-card bg-white p-8 rounded-2xl shadow-lg">
                    <div class="flex items-center mb-6">
                        <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Aziz"
                            class="w-14 h-14 rounded-full border-4 border-indigo-100">
                        <div class="ml-4">
                            <h4 class="font-bold text-gray-900">Aziz Xakimov</h4>
                            <p class="text-gray-600 text-sm">Qurilish ishchisi</p>
                        </div>
                    </div>
                    <p class="text-gray-600 mb-6 italic">
                        "KunbayIsh orqali har hafta yangi ish topaman.
                        Ish beruvchilar ishonchli va to'lovlar o'z vaqtida.
                        Oylik daromadim 2 baravar oshdi!"
                    </p>
                    <div class="flex text-yellow-400">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                </div>

                <!-- Testimonial 2 -->
                <div class="testimonial-card bg-white p-8 rounded-2xl shadow-lg">
                    <div class="flex items-center mb-6">
                        <img src="https://randomuser.me/api/portraits/women/44.jpg" alt="Dilnoza"
                            class="w-14 h-14 rounded-full border-4 border-indigo-100">
                        <div class="ml-4">
                            <h4 class="font-bold text-gray-900">Dilnoza Qodirova</h4>
                            <p class="text-gray-600 text-sm">Tadbirlar tashkilotchisi</p>
                        </div>
                    </div>
                    <p class="text-gray-600 mb-6 italic">
                        "To'y va tadbirlarimiz uchun ishchilarni tezda topishimiz mumkin.
                        Platforma juda qulay va ishonchli.
                        Endi har bir tadbir oldidan tashvishlanmaymiz."
                    </p>
                    <div class="flex text-yellow-400">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                </div>

                <!-- Testimonial 3 -->
                <div class="testimonial-card bg-white p-8 rounded-2xl shadow-lg">
                    <div class="flex items-center mb-6">
                        <img src="https://randomuser.me/api/portraits/men/67.jpg" alt="Shavkat"
                            class="w-14 h-14 rounded-full border-4 border-indigo-100">
                        <div class="ml-4">
                            <h4 class="font-bold text-gray-900">Shavkat Yusupov</h4>
                            <p class="text-gray-600 text-sm">Usta</p>
                        </div>
                    </div>
                    <p class="text-gray-600 mb-6 italic">
                        "30 yillik ustaman, lekin internet orqali ish topishni bilmasdim.
                        KunbayIsh yordamida endi kuniga 2-3 buyurtma olyapman.
                        Rahmat yaratuvchilarga!"
                    </p>
                    <div class="flex text-yellow-400">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section id="faq" class="py-20 bg-white">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-6">Ko'p Beriladigan <span
                        class="text-indigo-600">Savollar</span></h2>
                <p class="text-xl text-gray-600">Sizning savollaringizga javoblar</p>
            </div>

            <div class="space-y-6">
                <!-- FAQ 1 -->
                <div class="border border-gray-200 rounded-2xl p-6 hover:border-indigo-300 transition">
                    <button class="flex justify-between items-center w-full text-left" onclick="toggleFAQ(1)">
                        <h3 class="text-xl font-bold text-gray-900">KunbayIsh dan foydalanish uchun to'lov talab
                            qilinadimi?</h3>
                        <i class="fas fa-chevron-down text-indigo-600 transition" id="faq-icon-1"></i>
                    </button>
                    <div id="faq-content-1" class="mt-4 hidden">
                        <p class="text-gray-600">
                            Yo'q, KunbayIsh mutlaqo bepul platforma. Ish beruvchilar bepul e'lon berishadi,
                            ishchilar bepul ish qidirishadi. Biz hech qanday komissiya yoki yashirin to'lovlar olmaymiz.
                        </p>
                    </div>
                </div>

                <!-- FAQ 2 -->
                <div class="border border-gray-200 rounded-2xl p-6 hover:border-indigo-300 transition">
                    <button class="flex justify-between items-center w-full text-left" onclick="toggleFAQ(2)">
                        <h3 class="text-xl font-bold text-gray-900">Ishchilarni qanday tekshirasiz?</h3>
                        <i class="fas fa-chevron-down text-indigo-600 transition" id="faq-icon-2"></i>
                    </button>
                    <div id="faq-content-2" class="mt-4 hidden">
                        <p class="text-gray-600">
                            Barcha foydalanuvchilar telefon raqami orqali ro'yxatdan o'tadi va tasdiqlanadi.
                            Shuningdek, har bir ish uchun foydalanuvchilar bir-birlariga baho berishadi,
                            bu kelajakdagi ish beruvchilar uchun qaror qabul qilishda yordam beradi.
                        </p>
                    </div>
                </div>

                <!-- FAQ 3 -->
                <div class="border border-gray-200 rounded-2xl p-6 hover:border-indigo-300 transition">
                    <button class="flex justify-between items-center w-full text-left" onclick="toggleFAQ(3)">
                        <h3 class="text-xl font-bold text-gray-900">Agar ishchi ishni bajarmasa nima qilish kerak?</h3>
                        <i class="fas fa-chevron-down text-indigo-600 transition" id="faq-icon-3"></i>
                    </button>
                    <div id="faq-content-3" class="mt-4 hidden">
                        <p class="text-gray-600">
                            Bunday holatlarda bizning qo'llab-quvvatlash xizmatingizga murojaat qilishingiz mumkin.
                            Biz kelishuv buzilganligi aniqlansa, ishchiga tegishli cheklovlar qo'yamiz va
                            kelajakda bunday holatlarning oldini olish uchun choralar ko'ramiz.
                        </p>
                    </div>
                </div>

                <!-- FAQ 4 -->
                <div class="border border-gray-200 rounded-2xl p-6 hover:border-indigo-300 transition">
                    <button class="flex justify-between items-center w-full text-left" onclick="toggleFAQ(4)">
                        <h3 class="text-xl font-bold text-gray-900">Ish haqini qanday to'lash kerak?</h3>
                        <i class="fas fa-chevron-down text-indigo-600 transition" id="faq-icon-4"></i>
                    </button>
                    <div id="faq-content-4" class="mt-4 hidden">
                        <p class="text-gray-600">
                            Ish haqi to'lovi to'g'ridan-to'g'ri ish beruvchi va ishchi o'rtasida amalga oshiriladi.
                            Biz naqd pul, bank kartasi yoki mobil to'lov tizimlarini tavsiya qilamiz.
                            To'lovni qayd etish va kelishuvni yozma shaklda saqlashni tavsiya qilamiz.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Final CTA Section -->
    <section class="py-20 hero-gradient text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-4xl md:text-6xl font-bold mb-6">Hoziroq <span class="text-yellow-300">Boshlang</span></h2>
            <p class="text-xl md:text-2xl mb-10 max-w-3xl mx-auto opacity-90">
                Ishonchli ishchilarni toping yangi daromad manbalarini oching.
                Bugun qo'shiling va o'zgarishlarni sezing!
            </p>

            <div class="flex flex-col sm:flex-row justify-center gap-6">
                @auth
                    <a href="{{ route('workers.create') }}"
                        class="bg-white text-indigo-600 px-10 py-4 rounded-xl font-bold text-lg hover:bg-gray-100 transition transform hover:scale-105 inline-flex items-center justify-center btn-glow">
                        <i class="fas fa-plus-circle mr-3 text-xl"></i>Yangi Ish Joylash
                    </a>
                    <a href="{{ route('workers.index') }}"
                        class="bg-transparent border-2 border-white text-white px-10 py-4 rounded-xl font-bold text-lg hover:bg-white hover:text-indigo-600 transition transform hover:scale-105 inline-flex items-center justify-center">
                        <i class="fas fa-search mr-3"></i>Ishlarni Ko'rish
                    </a>
                @else
                    <a href="{{ route('register') }}"
                        class="bg-white text-indigo-600 px-10 py-4 rounded-xl font-bold text-lg hover:bg-gray-100 transition transform hover:scale-105 inline-flex items-center justify-center btn-glow">
                        <i class="fas fa-user-plus mr-3 text-xl"></i>Bepul Ro'yxatdan O'tish
                    </a>
                    <a href="{{ route('login') }}"
                        class="bg-transparent border-2 border-white text-white px-10 py-4 rounded-xl font-bold text-lg hover:bg-white hover:text-indigo-600 transition transform hover:scale-105 inline-flex items-center justify-center">
                        <i class="fas fa-sign-in-alt mr-3"></i>Kirish
                    </a>
                @endauth
            </div>

            <p class="mt-8 text-lg opacity-80">
                <i class="fas fa-check-circle text-green-300 mr-2"></i>
                10,000+ muvaffaqiyatli ish • 98% mijoz mamnuniyati
            </p>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-4 gap-8">
                <!-- Logo and About -->
                <div>
                    <div class="flex items-center mb-6">
                        <i class="fas fa-handshake text-3xl text-indigo-400 mr-3"></i>
                        <span class="text-2xl font-bold">Kunbay<span class="text-indigo-400">Ish</span></span>
                    </div>
                    <p class="text-gray-400 mb-6">
                        O'zbekistondagi eng yirik kunlik ish va ishchilar platformasi.
                        Biz ish topish va ishchi yollash jarayonini osonlashtiramiz.
                    </p>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-400 hover:text-white transition">
                            <i class="fab fa-telegram text-xl"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white transition">
                            <i class="fab fa-facebook text-xl"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white transition">
                            <i class="fab fa-instagram text-xl"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white transition">
                            <i class="fab fa-youtube text-xl"></i>
                        </a>
                    </div>
                </div>

                <!-- Quick Links -->
                <div>
                    <h3 class="text-xl font-bold mb-6">Tezkor Havolalar</h3>
                    <ul class="space-y-3">
                        <li><a href="#features" class="text-gray-400 hover:text-white transition">Imkoniyatlar</a>
                        </li>
                        <li><a href="#how-it-works" class="text-gray-400 hover:text-white transition">Qanday
                                Ishlasa</a></li>
                        <li><a href="#testimonials"
                                class="text-gray-400 hover:text-white transition">Foydalanuvchilar</a></li>
                        <li><a href="#faq" class="text-gray-400 hover:text-white transition">Savol-Javob</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition">Maxfiylik siyosati</a>
                        </li>
                    </ul>
                </div>

                <!-- Contact Info -->
                <div>
                    <h3 class="text-xl font-bold mb-6">Aloqa</h3>
                    <ul class="space-y-4">
                        <li class="flex items-center text-gray-400">
                            <i class="fas fa-map-marker-alt mr-3 text-indigo-400"></i>
                            <span>Toshkent shahri, Yunusobod tumani</span>
                        </li>
                        <li class="flex items-center text-gray-400">
                            <i class="fas fa-phone mr-3 text-indigo-400"></i>
                            <span>+998 71 123 45 67</span>
                        </li>
                        <li class="flex items-center text-gray-400">
                            <i class="fas fa-envelope mr-3 text-indigo-400"></i>
                            <span>info@KunbayIsh.uz</span>
                        </li>
                    </ul>
                </div>

                <!-- Newsletter -->
                <div>
                    <h3 class="text-xl font-bold mb-6">Yangiliklar</h3>
                    <p class="text-gray-400 mb-4">
                        Yangi ishlar va aksiyalar haqida xabardor bo'ling
                    </p>
                    <form class="flex">
                        <input type="email" placeholder="Email manzilingiz"
                            class="bg-gray-800 text-white px-4 py-3 rounded-l-lg w-full focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        <button type="submit"
                            class="bg-indigo-600 px-4 py-3 rounded-r-lg hover:bg-indigo-700 transition">
                            <i class="fas fa-paper-plane"></i>
                        </button>
                    </form>
                </div>
            </div>

            <div class="border-t border-gray-800 mt-12 pt-8 text-center text-gray-400">
                <p>&copy; 2024 KunbayIsh. Barcha huquqlar himoyalangan.</p>
                <p class="mt-2 text-sm">Platforma Toshkent shahrida ishlab chiqilgan</p>
            </div>
        </div>
    </footer>

    <!-- JavaScript -->
    <script>
        // FAQ Toggle Function
        function toggleFAQ(num) {
            const content = document.getElementById('faq-content-' + num);
            const icon = document.getElementById('faq-icon-' + num);

            if (content.classList.contains('hidden')) {
                content.classList.remove('hidden');
                icon.classList.remove('fa-chevron-down');
                icon.classList.add('fa-chevron-up');
            } else {
                content.classList.add('hidden');
                icon.classList.remove('fa-chevron-up');
                icon.classList.add('fa-chevron-down');
            }
        }

        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();

                const targetId = this.getAttribute('href');
                if (targetId === '#') return;

                const targetElement = document.querySelector(targetId);
                if (targetElement) {
                    window.scrollTo({
                        top: targetElement.offsetTop - 100,
                        behavior: 'smooth'
                    });
                }
            });
        });

        // Add animation on scroll
        function animateOnScroll() {
            const elements = document.querySelectorAll('.feature-card, .testimonial-card, .stat-card');

            elements.forEach(element => {
                const elementTop = element.getBoundingClientRect().top;
                const windowHeight = window.innerHeight;

                if (elementTop < windowHeight - 100) {
                    element.style.opacity = '1';
                    element.style.transform = 'translateY(0)';
                }
            });
        }

        // Set initial state for animation
        document.querySelectorAll('.feature-card, .testimonial-card, .stat-card').forEach(el => {
            el.style.opacity = '0';
            el.style.transform = 'translateY(20px)';
            el.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
        });

        // Listen for scroll events
        window.addEventListener('scroll', animateOnScroll);
        // Initial check
        animateOnScroll();
    </script>
</body>

</html>
