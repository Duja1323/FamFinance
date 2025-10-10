<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'FamFinance') }}</title>

        <!-- Favicon -->
        <link rel="icon" href="{{ asset('images/logo.png') }}">
        
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />

        <!-- Scripts -->
            @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="antialiased">
        <div class="bg-gradient-to-b from-blue-50 to-indigo-100 min-h-screen">
            <header class="bg-white shadow-sm">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between h-16">
                        <div class="flex items-center">
                            <a href="{{ url('/') }}" class="flex items-center">
                                <img src="./images/logo.png" alt="FamFinance Logo" class="h-12 w-auto mr-2">
                            
                            </a>
                        </div>
                        
                        <div class="flex items-center">
            @if (Route::has('login'))
                                <div class="space-x-4">
                    @auth
                                        <a href="{{ url('/dashboard') }}" class="text-sm font-medium text-indigo-600 hover:text-indigo-800">{{ __('Tableau de bord') }}</a>
                    @else
                                        <a href="{{ route('login') }}" class="text-sm font-medium text-gray-700 hover:text-gray-900">{{ __('Connexion') }}</a>

                        @if (Route::has('register'))
                                            <a href="{{ route('register') }}" class="text-sm font-medium bg-indigo-600 text-white py-2 px-4 rounded-lg hover:bg-indigo-700">{{ __('Inscription') }}</a>
                        @endif
                    @endauth
                                </div>
            @endif
                        </div>
                    </div>
                </div>
        </header>

        <style>
            .fade-in { opacity: 0; animation: fadeIn .8s ease forwards; }
            .delay-1 { animation-delay: .15s; }
            .delay-2 { animation-delay: .3s; }
            .delay-3 { animation-delay: .45s; }
            @keyframes fadeIn { from { opacity: 0; transform: translateY(8px);} to { opacity:1; transform: translateY(0);} }
            .floaty { animation: floaty 6s ease-in-out infinite; }
            @keyframes floaty { 0%,100%{ transform: translateY(0);} 50%{ transform: translateY(-6px);} }
            .shimmer-text { background-image: linear-gradient(90deg,#111827,#4f46e5,#111827); background-size: 200% 100%; -webkit-background-clip: text; background-clip: text; color: transparent; animation: shimmer 3s linear infinite; }
            @keyframes shimmer { 0%{ background-position: 200% 0;} 100%{ background-position: -200% 0;} }
            .glow-btn { position: relative; }
            .glow-btn::after { content:""; position:absolute; inset:-2px; border-radius:9999px; background: linear-gradient(90deg,#4f46e5,#22d3ee,#16a34a); filter: blur(12px); opacity:.35; z-index:-1; transition: opacity .2s ease; }
            .glow-btn:hover::after { opacity:.5; }
        </style>

            <!-- Hero section -->
            <div class="pt-16 pb-20">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
                        <div>
                            <h1 class="text-4xl font-extrabold tracking-tight text-gray-900 sm:text-5xl md:text-6xl">
                                <span class="block xl:inline">Gérez vos finances</span>
                                <span class="block text-indigo-600 xl:inline">familiales simplement</span>
                            </h1>
                            <p class="fade-in delay-2 mt-6 text-lg text-gray-600">
                                FamFinance vous aide à suivre vos revenus, à gérer vos dépenses, à planifier votre budget et à atteindre vos objectifs financiers - tout au même endroit.
                            </p>
                            <div class="mt-8 flex space-x-4">
                                <a href="{{ route('register') }}" class="glow-btn inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-full shadow-sm text-white bg-indigo-600 hover:bg-indigo-500 transition-transform duration-200 hover:scale-[1.02]">
                                    {{ __('Commencer gratuitement') }}
                                    <svg class="ml-2 h-4 w-4 floaty" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M5 12h14M13 5l7 7-7 7" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                </a>
                                <a href="#fonctionnalites" class="fade-in delay-3 inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-full text-indigo-600 bg-indigo-100 hover:bg-indigo-200">
                                    {{ __('En savoir plus') }}
                                </a>
                            </div>
                        </div>
                        <div class="hidden md:block relative">
                            <div class="absolute -inset-4 rounded-3xl blur-2xl bg-gradient-to-tr from-indigo-200 via-cyan-200 to-emerald-200 opacity-60"></div>
                            <img src="{{ asset('images/12.jpg') }}" alt="Finance management" class="relative w-full h-auto rounded-lg shadow-xl ring-1 ring-black/10">
                        </div>
                    </div>
                </div>
            </div>

            <div id="fonctionnalites" class="py-16 bg-white">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="text-center">
                        <h2 class="text-base font-semibold text-indigo-600 tracking-wide uppercase">{{ __('Fonctionnalités') }}</h2>
                        <p class="mt-1 text-4xl font-extrabold text-gray-900 sm:text-5xl sm:tracking-tight">{{ __('Tout ce dont vous avez besoin') }}</p>
                        <p class="max-w-xl mt-5 mx-auto text-xl text-gray-500">{{ __('Découvrez les outils qui vous aideront à prendre le contrôle de vos finances familiales.') }}</p>
                    </div>

                    <div class="mt-16">
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                            <div class="bg-gray-50 rounded-lg p-6 border border-gray-200 hover:shadow-md transition duration-300">
                                <div class="w-12 h-12 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600 text-xl mb-4">
                                    <i class="fas fa-exchange-alt"></i>
                                </div>
                                <h3 class="text-lg font-medium text-gray-900">{{ __('Suivi des transactions') }}</h3>
                                <p class="mt-2 text-base text-gray-500">{{ __('Enregistrez facilement vos revenus et dépenses, avec des catégories personnalisables et des rapports détaillés.') }}</p>
                            </div>

                            <div class="bg-gray-50 rounded-lg p-6 border border-gray-200 hover:shadow-md transition duration-300">
                                <div class="w-12 h-12 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600 text-xl mb-4">
                                    <i class="fas fa-chart-pie"></i>
                                </div>
                                <h3 class="text-lg font-medium text-gray-900">{{ __('Gestion de budget') }}</h3>
                                <p class="mt-2 text-base text-gray-500">{{ __('Créez des budgets par catégorie et suivez vos dépenses en temps réel pour toujours rester dans les limites de votre budget.') }}</p>
                            </div>

                            <div class="bg-gray-50 rounded-lg p-6 border border-gray-200 hover:shadow-md transition duration-300">
                                <div class="w-12 h-12 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600 text-xl mb-4">
                                    <i class="fas fa-file-invoice-dollar"></i>
                                </div>
                                <h3 class="text-lg font-medium text-gray-900">{{ __('Factures récurrentes') }}</h3>
                                <p class="mt-2 text-base text-gray-500">{{ __('Ne manquez plus jamais une facture grâce au système de suivi des factures récurrentes avec rappels automatiques.') }}</p>
                            </div>

                            <div class="bg-gray-50 rounded-lg p-6 border border-gray-200 hover:shadow-md transition duration-300">
                                <div class="w-12 h-12 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600 text-xl mb-4">
                                    <i class="fas fa-bullseye"></i>
                                </div>
                                <h3 class="text-lg font-medium text-gray-900">{{ __('Objectifs financiers') }}</h3>
                                <p class="mt-2 text-base text-gray-500">{{ __('Définissez des objectifs d\'épargne et suivez votre progression pour réaliser vos rêves financiers.') }}</p>
                            </div>

                            <div class="bg-gray-50 rounded-lg p-6 border border-gray-200 hover:shadow-md transition duration-300">
                                <div class="w-12 h-12 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600 text-xl mb-4">
                                    <i class="fas fa-chart-line"></i>
                                </div>
                                <h3 class="text-lg font-medium text-gray-900">{{ __('Rapports et analyses') }}</h3>
                                <p class="mt-2 text-base text-gray-500">{{ __('Visualisez vos finances avec des graphiques clairs et des rapports personnalisés pour prendre de meilleures décisions.') }}</p>
                            </div>

                            <div class="bg-gray-50 rounded-lg p-6 border border-gray-200 hover:shadow-md transition duration-300">
                                <div class="w-12 h-12 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600 text-xl mb-4">
                                    <i class="fas fa-shield-alt"></i>
                                </div>
                                <h3 class="text-lg font-medium text-gray-900">{{ __('Sécurisé et privé') }}</h3>
                                <p class="mt-2 text-base text-gray-500">{{ __('Vos données financières sont protégées par des protocoles de sécurité avancés et ne sont jamais partagées.') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="py-16 bg-gradient-to-r from-indigo-500 to-purple-600">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="lg:flex lg:items-center lg:justify-between">
                        <div class="lg:w-1/2">
                            <h2 class="text-3xl font-extrabold tracking-tight text-white sm:text-4xl">
                                <span class="block">{{ __('Prêt à prendre le contrôle') }}</span>
                                <span class="block">{{ __('de vos finances familiales ?') }}</span>
                            </h2>
                            <p class="mt-4 text-lg leading-6 text-indigo-100">
                                {{ __('Rejoignez des milliers de familles qui utilisent FamFinance pour atteindre leurs objectifs financiers.') }}
                            </p>
                            <div class="mt-8">
                                <a href="{{ route('register') }}" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-indigo-600 bg-white hover:bg-gray-50 shadow-sm">
                                    {{ __('Créer un compte gratuit') }}
                                </a>
                            </div>
                        </div>
                        <div class="mt-10 lg:mt-0 lg:w-1/2 lg:pl-10">
                            <blockquote>
                                <div class="relative">
                                    <svg class="absolute -top-12 -left-12 h-16 w-16 text-indigo-300 opacity-50" fill="currentColor" viewBox="0 0 32 32">
                                        <path d="M9.352 4C4.456 7.456 1 13.12 1 19.36c0 5.088 3.072 8.064 6.624 8.064 3.36 0 5.856-2.688 5.856-5.856 0-3.168-2.208-5.472-5.088-5.472-.576 0-1.344.096-1.536.192.48-3.264 3.552-7.104 6.624-9.024L9.352 4zm16.512 0c-4.8 3.456-8.256 9.12-8.256 15.36 0 5.088 3.072 8.064 6.624 8.064 3.264 0 5.856-2.688 5.856-5.856 0-3.168-2.304-5.472-5.184-5.472-.576 0-1.248.096-1.44.192.48-3.264 3.456-7.104 6.528-9.024L25.864 4z" />
                                    </svg>
                                    <p class="text-xl font-medium text-white">
                                        {{ __('FamFinance a complètement changé notre façon de gérer l\'argent. Nous avons enfin une vision claire de nos finances et nous économisons pour l\'avenir de nos enfants.') }}
                                    </p>
                                </div>
                                <footer class="mt-8">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0">
                                            <img class="h-12 w-12 rounded-full bg-indigo-300" src="{{ asset('images/image.png') }}" alt="duja">
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-base font-medium text-white">{{ __('Khadija DRIDER') }}</div>
                                            <div class="text-base font-medium text-indigo-200">{{ __('Mère de famille, FES') }}</div>
                                        </div>
                                    </div>
                                </footer>
                            </blockquote>
                        </div>
                    </div>
                </div>
            </div>

            <footer class="bg-white">
                <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
                    <div class="md:flex md:items-center md:justify-between">
                        <div class="flex justify-center md:justify-start">
                            <a href="{{ url('/') }}" class="flex items-center">
                                <img src="{{ asset('images/logo.png') }}" alt="FamFinance Logo" class="h-16 w-auto mr-2">
                            </a>
                        </div>
                        <div class="mt-8 md:mt-0">
                            <p class="text-center text-base text-gray-500">
                                &copy; {{ date('Y') }} FamFinance. {{ __('Tous droits réservés.') }}
                            </p>
                        </div>
                </div>
                </div>
            </footer>
        </div>
    </body>
</html>
