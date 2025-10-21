<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landing Page</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    animation: {
                        'pulse-slow': 'pulse 3s cubic-bezier(0.4, 0, 0.6, 1) infinite',
                    }
                }
            }
        }
    </script>
    <style>
        .bg-grid-pattern {
            background: url('https://i.ibb.co/j9rtjjjC/unnamed.png') no-repeat center center fixed;
            background-size: cover;
            opacity: 0.3;
        }
        html { scroll-behavior: smooth; }
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(30px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-in-up { animation: fadeInUp 0.8s ease-out; }
    </style>
</head>
<body class="bg-white">
    <!-- Header -->
    <header class="fixed top-0 left-0 right-0 z-50 bg-white/80 backdrop-blur-md border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-4">
                <!-- Logo -->
                <div class="flex items-center">
                    <img src="https://i.ibb.co/fV4qjqG0/logo-ezgif-com-crop.gif" alt="WILYONARYO Logo" class="h-12">
                </div>

                <!-- Desktop Navigation -->
                <nav class="hidden md:flex items-center space-x-8">
                    <a href="#features" class="text-gray-700 hover:text-purple-900 transition-colors font-medium">Features</a>
                    <a href="#testimonials" class="text-gray-700 hover:text-purple-900 transition-colors font-medium">Testimonials</a>
                    <a href="#pricing" class="text-gray-700 hover:text-purple-900 transition-colors font-medium">Pricing</a>
                    <a href="#" class="text-gray-700 hover:text-purple-900 transition-colors font-medium">About</a>
                </nav>

                <!-- Desktop CTA -->
                <div class="hidden md:flex items-center space-x-4">
                    <button class="text-gray-700 hover:text-gray-900 px-4 py-2 rounded transition-colors">Sign In</button>
                    <button class="bg-gray-900 hover:bg-gray-800 text-white px-6 py-2 rounded transition-colors">Get Started</button>
                </div>

                <!-- Mobile menu button -->
                <button class="md:hidden p-2" onclick="toggleMobileMenu()">
                    <svg id="menu-icon" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                    <svg id="close-icon" class="h-6 w-6 hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <!-- Mobile Navigation -->
            <div id="mobile-menu" class="md:hidden py-4 border-t border-gray-200 hidden">
                <nav class="flex flex-col space-y-4">
                    <a href="#features" class="text-gray-700 hover:text-gray-900 transition-colors font-medium px-4 py-2">Features</a>
                    <a href="#testimonials" class="text-gray-700 hover:text-gray-900 transition-colors font-medium px-4 py-2">Testimonials</a>
                    <a href="#pricing" class="text-gray-700 hover:text-gray-900 transition-colors font-medium px-4 py-2">Pricing</a>
                    <a href="#" class="text-gray-700 hover:text-gray-900 transition-colors font-medium px-4 py-2">About</a>
                    <div class="flex flex-col space-y-2 px-4 pt-4">
                        <button class="text-left text-gray-700 hover:text-gray-900 py-2">Sign In</button>
                        <button class="text-left bg-gray-900 hover:bg-gray-800 text-white py-2 px-4 rounded">Get Started</button>
                    </div>
                </nav>
            </div>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="relative min-h-screen flex items-center justify-center overflow-hidden bg-gradient-to-br from-slate-50 via-white to-slate-100">
        <!-- Background decoration -->
        <div class="absolute inset-0 bg-grid-pattern"></div>
        <div class="absolute top-20 left-10 w-72 h-72 bg-blue-200 rounded-full mix-blend-multiply filter blur-xl opacity-30 animate-pulse"></div>
        <div class="absolute top-40 right-10 w-72 h-72 bg-orange-200 rounded-full mix-blend-multiply filter blur-xl opacity-30 animate-pulse"></div>
        <div class="absolute bottom-20 left-1/2 w-72 h-72 bg-pink-200 rounded-full mix-blend-multiply filter blur-xl opacity-30 animate-pulse"></div>

        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <!-- Main heading -->
            <h1 class="text-6xl md:text-8xl lg:text-9xl font-bold tracking-tight text-gray-900 mb-8">
                <span class="inline-block transform transition-all duration-1000 hover:scale-105">Play </span>
                <span class="inline-block transform transition-all duration-1000 hover:scale-105">to win </span>
                <span class="inline-block transform transition-all duration-1000 hover:scale-105 text-orange-600">1 MILLION OR MORE</span>
                <span class="inline-block transform transition-all duration-1000 hover:scale-105"></span>
            </h1>

            <!-- Subtitle -->
            <p class="text-xl md:text-2xl text-gray-600 mb-12 max-w-4xl mx-auto leading-relaxed">
                THE NUMBER ONE GAMESHOW IN THE PHILIPPINES!
            </p>

            <!-- CTA Buttons -->
            <div class="flex flex-col sm:flex-row gap-6 justify-center items-center mb-16">
                <button class="text-lg px-8 py-4 bg-indigo-600 hover:bg-gray-800 text-white rounded-full transition-all duration-300 transform hover:scale-105 hover:shadow-2xl group">
                    Get Started Free
                    <svg class="ml-2 h-5 w-5 inline group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                    </svg>
                </button>

                <button class="text-lg px-8 py-4 border-2 border-orange-300 hover:border-gray-900 text-gray-700 bg-orange-600 hover:text-gray-900 rounded-full transition-all duration-300 transform hover:scale-105 group">
                    <svg class="mr-2 h-5 w-5 inline group-hover:scale-110 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h1.01M15 10h1.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Play Demo
                </button>
            </div>

            <!-- Stats -->
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 max-w-4xl mx-auto">
                <div class="text-center group">
                    <div class="text-4xl md:text-5xl font-bold text-gray-900 mb-2 group-hover:text-blue-600 transition-colors duration-300">300,000+</div>
                    <div class="text-sm md:text-base text-gray-600 uppercase tracking-wider">Happy Customers</div>
                </div>
                <div class="text-center group">
                    <div class="text-4xl md:text-5xl font-bold text-gray-900 mb-2 group-hover:text-blue-600 transition-colors duration-300">99.9%</div>
                    <div class="text-sm md:text-base text-gray-600 uppercase tracking-wider">Uptime</div>
                </div>
                <div class="text-center group">
                    <div class="text-4xl md:text-5xl font-bold text-gray-900 mb-2 group-hover:text-blue-600 transition-colors duration-300">24/7</div>
                    <div class="text-sm md:text-base text-gray-600 uppercase tracking-wider">Support</div>
                </div>
                <div class="text-center group">
                    <div class="text-4xl md:text-5xl font-bold text-gray-900 mb-2 group-hover:text-blue-600 transition-colors duration-300">150+</div>
                    <div class="text-sm md:text-base text-gray-600 uppercase tracking-wider">Countries</div>
                </div>
            </div>
        </div>

        <!-- Scroll indicator -->
        <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 animate-bounce">
            <div class="w-6 h-10 border-2 border-gray-400 rounded-full flex justify-center">
                <div class="w-1 h-3 bg-gray-400 rounded-full mt-2 animate-pulse"></div>
            </div>
        </div>
    </section>

    <!-- Replaced Features Section: jackpot artwork only -->
    <section id="features" class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-center">
                <!-- CHANGE the src to your actual file path if different -->
                <img
                    src="https://i.ibb.co/mFJn11k2/super-jackpot.jpg"
                    alt="Jackpot Prize ₱6,000,000"
                    class="w-full max-w-4xl rounded-2xl shadow-2xl"
                    loading="lazy"
                />
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section id="testimonials" class="py-24 bg-gradient-to-b from-gray-50 to-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Section header -->
            <div class="text-center mb-20">
                <h2 class="text-4xl md:text-6xl font-bold text-gray-900 mb-6">
                    Loved by Filipinos
                    <span class="text-green-600 block">WORLDWIDE</span>
                </h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    Don't just take our word for it. Here's what real users have to say about their experience.
                </p>
            </div>

            <!-- Testimonials grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Testimonial 1 -->
                <div class="group border-0 shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 bg-white backdrop-blur-sm overflow-hidden rounded-lg p-8">
                    <!-- Stars -->
                    <div class="flex gap-1 mb-6">
                        <svg class="h-5 w-5 text-yellow-400 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                        <svg class="h-5 w-5 text-yellow-400 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                        <svg class="h-5 w-5 text-yellow-400 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                        <svg class="h-5 w-5 text-yellow-400 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                        <svg class="h-5 w-5 text-yellow-400 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                    </div>

                    <blockquote class="text-gray-700 text-lg mb-8 leading-relaxed italic">
                        "SOBRANG SAYA KOYA WEEELLLL!"
                    </blockquote>

                    <div class="flex items-center gap-4">
                        <div class="h-12 w-12 rounded-full bg-gradient-to-br from-blue-100 to-orange-100 flex items-center justify-center text-gray-700 font-semibold border-2 border-gray-100">
                            SJ
                        </div>
                        <div>
                            <div class="font-semibold text-gray-900 text-lg">Amok Sosa </div>
                            <div class="text-gray-600">Tambay</div>
                        </div>
                    </div>
                </div>

                <!-- Testimonial 2 -->
                <div class="group border-0 shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 bg-white backdrop-blur-sm overflow-hidden rounded-lg p-8 md:scale-105">
                    <div class="flex gap-1 mb-6">
                        <svg class="h-5 w-5 text-yellow-400 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                        <svg class="h-5 w-5 text-yellow-400 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                        <svg class="h-5 w-5 text-yellow-400 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                        <svg class="h-5 w-5 text-yellow-400 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                        <svg class="h-5 w-5 text-yellow-400 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                    </div>

                    <blockquote class="text-gray-700 text-lg mb-8 leading-relaxed italic">
                        "SANA MANALO PO AKO GUSION SKIN"
                    </blockquote>

                    <div class="flex items-center gap-4">
                        <div class="h-12 w-12 rounded-full bg-gradient-to-br from-blue-100 to-orange-100 flex items-center justify-center text-gray-700 font-semibold border-2 border-gray-100">
                            MC
                        </div>
                        <div>
                            <div class="font-semibold text-gray-900 text-lg">Patrick Lacanienta</div>
                            <div class="text-gray-600">CEO at KrustyKrab</div>
                        </div>
                    </div>
                </div>

                <!-- Testimonial 3 -->
                <div class="group border-0 shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 bg-white backdrop-blur-sm overflow-hidden rounded-lg p-8">
                    <div class="flex gap-1 mb-6">
                        <svg class="h-5 w-5 text-yellow-400 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                        <svg class="h-5 w-5 text-yellow-400 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                        <svg class="h-5 w-5 text-yellow-400 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                        <svg class="h-5 w-5 text-yellow-400 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                        <svg class="h-5 w-5 text-yellow-400 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                    </div>

                    <blockquote class="text-gray-700 text-lg mb-8 leading-relaxed italic">
                        "Ang sarap sana manood kaso brownout samin sana manalo ako hehehe"
                    </blockquote>

                    <div class="flex items-center gap-4">
                        <div class="h-12 w-12 rounded-full bg-gradient-to-br from-blue-100 to-orange-100 flex items-center justify-center text-gray-700 font-semibold border-2 border-gray-100">
                            ER
                        </div>
                        <div>
                            <div class="font-semibold text-gray-900 text-lg">Adriane Aquino</div>
                            <div class="text-gray-600">Working at Edi sa Puso Mo!</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Trust indicators -->
            <div class="mt-20 text-center">
                <p class="text-gray-500 mb-8 text-lg">Trusted by companies of all sizes</p>
                <div class="flex flex-wrap justify-center items-center gap-12 opacity-60">
                    <div class="text-2xl font-bold text-gray-400 hover:text-orange-600 transition-colors cursor-default">Shopee</div>
                    <div class="text-2xl font-bold text-gray-400 hover:text-orange-600 transition-colors cursor-default">Cignal</div>
                    <div class="text-2xl font-bold text-gray-400 hover:text-orange-600 transition-colors cursor-default">Technomarine</div>
                    <div class="text-2xl font-bold text-gray-400 hover:text-orange-600 transition-colors cursor-default">JGL Corp.</div>
                    <div class="text-2xl font-bold text-gray-400 hover:text-orange-600 transition-colors cursor-default">LiverAid</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Pricing Section -->
    <section id="pricing" class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Section header -->
            <div class="text-center mb-20">
                <h2 class="text-4xl md:text-6xl font-bold text-gray-900 mb-6">
                    WILYONARYO TICKET
                    <span class="text-orange-600 block">PRICING</span>
                </h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    Choose the perfect plan for your team. Scale up or down as needed.
                </p>
            </div>

            <!-- Pricing cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-6xl mx-auto">
                <!-- Starter Plan -->
                <div class="group relative border-2 border-gray-200 hover:border-gray-300 shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 bg-white rounded-lg p-8">
                    <div class="text-center pb-8">
                        <h3 class="text-2xl font-bold text-gray-900 mb-2">Starter</h3>
                        <p class="text-gray-600 mb-6">Perfect for small teams getting started</p>
                        <div class="mb-6">
                            <span class="text-5xl font-bold text-gray-900">₱120</span>
                            <span class="text-gray-600 ml-2">1 day</span>
                        </div>
                        <button class="w-full py-3 text-lg transition-all duration-300 transform hover:scale-105 bg-gray-900 hover:bg-gray-800 text-white rounded">
                            Get Started
                        </button>
                    </div>

                    <ul class="space-y-4">
                        <li class="flex items-start gap-3">
                            <svg class="h-5 w-5 text-orange-600 mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            <span class="text-gray-700">Good for 1 day</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <svg class="h-5 w-5 text-orange-600 mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            <span class="text-gray-700">6 total draws</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <svg class="h-5 w-5 text-orange-600 mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            <span class="text-gray-700">Solo winner</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <svg class="h-5 w-5 text-orange-600 mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            <span class="text-gray-700">More prizes!</span>
                        </li>
                    </ul>
                </div>

                <!-- Professional Plan - Most Popular -->
                <div class="group relative border-2 border-orange-500 shadow-2xl scale-105 bg-gradient-to-b from-orange-50 to-white transition-all duration-500 transform hover:-translate-y-2 rounded-lg p-8">
                    <div class="absolute -top-3 left-1/2 transform -translate-x-1/2 bg-orange-600 hover:bg-orange-700 text-white px-4 py-1 rounded text-sm font-medium">
                        Most Popular
                    </div>

                    <div class="text-center pb-8">
                        <h3 class="text-2xl font-bold text-gray-900 mb-2">Professional</h3>
                        <p class="text-gray-600 mb-6">For growing teams that need more power</p>
                        <div class="mb-6">
                            <span class="text-5xl font-bold text-orange-600">₱1200</span>
                            <span class="text-gray-600 ml-2">10 days</span>
                        </div>
                        <button class="w-full py-3 text-lg transition-all duration-300 transform hover:scale-105 bg-orange-600 hover:bg-orange-700 text-white shadow-lg hover:shadow-xl rounded">
                            Get Started
                        </button>
                    </div>

                    <ul class="space-y-4">
                        <li class="flex items-start gap-3">
                            <svg class="h-5 w-5 text-orange-600 mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            <span class="text-gray-700">Good for 10 days</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <svg class="h-5 w-5 text-orange-600 mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            <span class="text-gray-700">60 total draws</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <svg class="h-5 w-5 text-orange-600 mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            <span class="text-gray-700">Consolation prizes</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <svg class="h-5 w-5 text-orange-600 mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            <span class="text-gray-700">Solo winner for 10 days</span>
                        </li>
                    </ul>
                </div>

                <!-- Enterprise Plan -->
                <div class="group relative border-2 border-gray-200 hover:border-gray-300 shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 bg-white rounded-lg p-8">
                    <div class="text-center pb-8">
                        <h3 class="text-2xl font-bold text-gray-900 mb-2">Enterprise</h3>
                        <p class="text-gray-600 mb-6">For large organizations with custom needs</p>
                        <div class="mb-6">
                            <span class="text-5xl font-bold text-gray-900">₱3600</span>
                            <span class="text-gray-600 ml-2">30 days</span>
                        </div>
                        <button class="w-full py-3 text-lg transition-all duration-300 transform hover:scale-105 bg-gray-900 hover:bg-gray-800 text-white rounded">
                            Contact Sales
                        </button>
                    </div>

                    <ul class="space-y-4">
                        <li class="flex items-start gap-3">
                            <svg class="h-5 w-5 text-orange-600 mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            <span class="text-gray-700">Good for 1 whole month</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <svg class="h-5 w-5 text-orange-600 mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            <span class="text-gray-700">120 total draws</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <svg class="h-5 w-5 text-orange-600 mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            <span class="text-gray-700">More chances to win!</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <svg class="h-5 w-5 text-orange-600 mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            <span class="text-gray-700">More consolation prizes</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <svg class="h-5 w-5 text-orange-600 mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            <span class="text-gray-700">Can change the ticket every day after the draw</span>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- FAQ link -->
            <div class="text-center mt-16">
                <p class="text-gray-600 mb-4">Have questions about our pricing?</p>
                <button class="border-2 border-gray-300 hover:border-gray-900 text-gray-700 hover:text-gray-900 px-6 py-2 rounded transition-colors">
                    View FAQ
                </button>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white">
        <!-- Newsletter section -->
        <div class="border-b border-gray-800">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
                <div class="text-center">
                    <h3 class="text-3xl md:text-4xl font-bold mb-4">Want to stay in touch?</h3>
                    <p class="text-gray-400 text-lg mb-8 max-w-2xl mx-auto">
                        Get the latest updates, tips, and exclusive content delivered straight to your inbox.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4 max-w-md mx-auto">
                        <input 
                            type="email" 
                            placeholder="Enter your email" 
                            class="bg-gray-800 border-gray-700 text-white placeholder:text-gray-400 focus:border-blue-500 px-4 py-2 rounded flex-1 focus:outline-none"
                        />
                        <button class="bg-blue-600 hover:bg-blue-700 px-8 py-2 rounded transition-colors">
                            Subscribe
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main footer -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <!-- Company info -->
                <div class="col-span-1 md:col-span-1">
                    <h4 class="text-2xl font-bold mb-4">More about WILYONARYO</h4>
                    <p class="text-gray-400 mb-6">
                        Explore Willie Revillame's biography, discography, and artist credits.
                    </p>
                    <div class="flex space-x-4">
                        <button class="text-gray-400 hover:text-white hover:bg-gray-800 p-2 rounded transition-colors">
                            <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M6.29 18.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0020 3.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.073 4.073 0 01.8 7.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 010 16.407a11.616 11.616 0 006.29 1.84"/>
                            </svg>
                        </button>
                        <button class="text-gray-400 hover:text-white hover:bg-gray-800 p-2 rounded transition-colors">
                            <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 0C4.477 0 0 4.484 0 10.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0110 4.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.203 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.942.359.31.678.921.678 1.856 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0020 10.017C20 4.484 15.522 0 10 0z" clip-rule="evenodd"/>
                            </svg>
                        </button>
                        <button class="text-gray-400 hover:text-white hover:bg-gray-800 p-2 rounded transition-colors">
                            <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.338 16.338H13.67V12.16c0-.995-.017-2.277-1.387-2.277-1.39 0-1.601 1.086-1.601 2.207v4.248H8.014v-8.59h2.559v1.174h.037c.356-.675 1.227-1.387 2.526-1.387 2.703 0 3.203 1.778 3.203 4.092v4.711zM5.005 6.575a1.548 1.548 0 11-.003-3.096 1.548 1.548 0 01.003 3.096zm-1.337 9.763H6.34v-8.59H3.667v8.59zM17.668 1H2.328C1.595 1 1 1.581 1 2.298v15.403C1 18.418 1.595 19 2.328 19h15.34c.734 0 1.332-.582 1.332-1.299V2.298C19 1.581 18.402 1 17.668 1z" clip-rule="evenodd"/>
                            </svg>
                        </button>
                        <button class="text-gray-400 hover:text-white hover:bg-gray-800 p-2 rounded transition-colors">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Company links -->
                <div>
                    <h5 class="font-semibold text-lg mb-4">Company</h5>
                    <ul class="space-y-3">
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors">About</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Blog</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Careers</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors"></a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors"></a></li>
                    </ul>
                </div>

                <!-- Support links -->
                <div>
                    <h5 class="font-semibold text-lg mb-4">Support</h5>
                    <ul class="space-y-3">
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Help Center</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Contact</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Status</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Security</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Privacy</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Bottom bar -->
        <div class="border-t border-gray-800">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
                <div class="flex flex-col sm:flex-row justify-between items-center">
                    <p class="text-gray-400 text-sm">
                        © 2025 WILYONARYO. All rights reserved.
                    </p>
                    <div class="flex space-x-6 mt-4 sm:mt-0">
                        <a href="#" class="text-gray-400 hover:text-white text-sm transition-colors">Terms of Service</a>
                        <a href="#" class="text-gray-400 hover:text-white text-sm transition-colors">Privacy Policy</a>
                        <a href="#" class="text-gray-400 hover:text-white text-sm transition-colors">Cookie Policy</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script>
        // Mobile menu toggle
        function toggleMobileMenu() {
            const mobileMenu = document.getElementById('mobile-menu');
            const menuIcon = document.getElementById('menu-icon');
            const closeIcon = document.getElementById('close-icon');

            if (mobileMenu.classList.contains('hidden')) {
                mobileMenu.classList.remove('hidden');
                menuIcon.classList.add('hidden');
                closeIcon.classList.remove('hidden');
            } else {
                mobileMenu.classList.add('hidden');
                menuIcon.classList.remove('hidden');
                closeIcon.classList.add('hidden');
            }
        }

        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({ behavior: 'smooth', block: 'start' });
                }
            });
        });

        // Add scroll effect to header
        window.addEventListener('scroll', function() {
            const header = document.querySelector('header');
            if (window.scrollY > 100) {
                header.classList.add('bg-white/95');
                header.classList.remove('bg-white/80');
            } else {
                header.classList.add('bg-white/80');
                header.classList.remove('bg-white/95');
            }
        });
    </script>
</body>
</html>
