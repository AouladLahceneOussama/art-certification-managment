<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link href="/vendor/laravel-admin/AdminLTE/plugins/select2/select2.min.css" rel="stylesheet" />
    <link href="{{ asset('css/select2.css') }}" rel="stylesheet"/>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <title>@yield('title')</title>

    <style>
        body,html{
            scroll-behavior: smooth;
        }
        .loader{
            z-index: 100000;
        }
        .fadeOut{
            visibility: hidden;
            opacity: 0;
            transition: .3s ease-in-out;
        }
        @font-face {
            font-family: PaytoneOne;
            src: url('/fonts/PaytoneOne-Regular.ttf');
        }

        @font-face {
            font-family: AtkinsonHyperlegible;
            src: url('/fonts/AtkinsonHyperlegible-Regular.ttf');
        }

        @font-face {
            font-family: Lato-Thin;
            src: url('/fonts/Lato-Thin.ttf');
        }

        @font-face {
            font-family: Raleway-Light;
            src: url('/fonts/Raleway-Light.ttf');
        }

        @import url(https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/5.3.45/css/materialdesignicons.min.css);
    </style>
    @livewireStyles

</head>

<body class="antialiased font-sans font-thin">
    
    <div class="fixed top-0 left-0 w-full h-screen bg-white flex justify-center align-center loader transition duration-300 ease-in-out">
        <img src="/images/loader.gif" alt="loader">
    </div>
    @yield('hero')
    
    @yield('content')

    <!-- footer section -->
    <footer class="bg-gray-800 pt-10 sm:mt-10 pt-10">
        <div class="max-w-6xl m-auto text-gray-800 flex flex-wrap justify-left">
            <!-- Col-1 -->
            <div class="p-5 w-1/2 sm:w-4/12 md:w-3/12">
                <!-- Col Title -->
                <div class="text-xs uppercase text-gray-400 font-medium mb-6">
                    {{ __('À Propos de nous') }}
                </div>

                <!-- Links -->
                <div class="w-full flex justify-center">
                    <img class="h-8 w-auto sm:h-10 " src="/images/logowhite2.svg" alt="logo">
                </div>
                <p class="my-6 block text-gray-300">{{ __('Art certification est une plateforme designee pour les artistes et les personnes qui pensent a acheter ou verifier la credibilite de leurs oeuvres') }}</p>

            </div>

            <!-- Col-2 -->
            <div class="p-5 w-1/2 sm:w-4/12 md:w-3/12">
                <!-- Col Title -->
                <div class="text-xs uppercase text-gray-400 font-medium mb-6">
                    {{ __('Menu') }}
                </div>

                <!-- Links -->
                <a href="/#home" class="my-3 block text-gray-300 hover:text-gray-100 text-sm font-medium duration-700">
                    {{__('Accueil') }}
                </a>
                <a href="/#services" class="my-3 block text-gray-300 hover:text-gray-100 text-sm font-medium duration-700">
                    {{__('Services') }}
                </a>
                <a href="/#plans" class="my-3 block text-gray-300 hover:text-gray-100 text-sm font-medium duration-700">
                    {{__('Plans') }}
                </a>
                <a href="/#contact" class="my-3 block text-gray-300 hover:text-gray-100 text-sm font-medium duration-700">
                    {{__('Contact') }}
                </a>
                <a href="/admin" class="my-3 block bg-gray-500 px-4 py-2 text-center rounded-xl text-gray-300 hover:bg-gray-400 text-sm font-medium duration-700">
                    {{__('Se Connecter') }}
                </a>
            </div>

            <!-- Col-3 -->
            <div class="p-5 w-1/2 sm:w-4/12 md:w-3/12">
                <!-- Col Title -->
                <div class="text-xs uppercase text-gray-400 font-medium mb-6">
                    {{ __('regles et condition') }}
                </div>

                <!-- Links -->
                <a href="#" class="my-3 block text-gray-300 hover:text-gray-100 text-sm font-medium duration-700">
                    {{ __('Privacy & Policy')}}
                </a>
                <a href="#" class="my-3 block text-gray-300 hover:text-gray-100 text-sm font-medium duration-700">
                    {{ __('Termes et condition')}}
                </a>
            </div>

            <!-- Col-3 -->
            <div class="p-5 w-1/2 sm:w-4/12 md:w-3/12">
                <!-- Col Title -->
                <div class="text-xs uppercase text-gray-400 font-medium mb-6">
                    {{ __('Restons Connectés')}}
                </div>

                <!-- Links -->
                <label for="emailTrach" class="text-white">{{ __('Votre email')}}</label>
                <input type="email" class="w-full bg-gray-50 text-gray-900 mt-2 p-3 rounded-md focus:outline-none focus:shadow-outline" id="emailTrach">
                <button class="bg-purple-500 text-white py-1 px-4 rounded-md mt-2 text-xs uppercase hover:bg-purple-600 transition duration-300 ease-in-out">{{ __('Envoyer') }}</button>

            </div>
        </div>

        <!-- Copyright Bar -->
        <div class="pt-2">
            <div class="flex pb-5 px-3 m-auto pt-5 border-t border-gray-500 text-gray-400 text-sm flex-row justify-between items-center max-w-6xl">
                <div class="mt-2">
                    © Copyright 2021. {{ __('Tous droits réservés') }}.
                </div>
                <div>
                    @foreach (Config::get('languages') as $lang => $language)
                        @if ($lang == App::getLocale())
                            <a class="font-semibold text-xs text-black cursor-pointer mx-1 bg-white rounded-md p-1 uppercase"  href="{{ route('lang.switch', $lang) }}" > {{$lang}} </a>
                        @else
                            <a class="font-semibold text-xs text-gray-50 cursor-pointer mx-1 uppercase"  href="{{ route('lang.switch', $lang) }}"> {{$lang}} </a>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </footer>
    <!-- footer section -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="/vendor/laravel-admin/AdminLTE/plugins/select2/select2.full.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>

        function loader(){
            var loader = document.querySelector('.loader').classList.add('fadeOut');
        }

        function fadeOut(){
            setInterval(loader,1500);
        }

        window.onload = fadeOut;

        AOS.init();
    </script>
    @livewireScripts

</body>
</html>