@extends('layouts.app')

@section('title','Art-Certification')

@section('hero')
<!-- hero section -->
<header class="relative bg-white lg:h-screen">
    <div class="max-w-7xl mx-auto">
        <div class="relative z-10 pb-8 bg-white sm:pb-16 md:pb-20 lg:max-w-2xl lg:w-full lg:pb-28 xl:pb-32 lg:h-screen">
            <svg class="hidden lg:block absolute right-0 inset-y-0 h-screen w-48 text-white transform translate-x-1/2" fill="currentColor" viewBox="0 0 100 100" preserveAspectRatio="none" aria-hidden="true">
                <polygon points="50,0 100,0 50,100 0,100" />
            </svg>
            @include('layouts.menu')
            <main class="mt-10 mx-auto max-w-7xl px-4 sm:mt-12 sm:px-6 md:mt-16 lg:mt-20 lg:px-8 xl:mt-28" >
                <div class="sm:text-center lg:text-left">
                    <div >
                        <h1 data-aos="zoom-in-down" data-aos-delay="2000" class="text-4xl tracking-tight font-extrabold text-gray-900 sm:text-5xl md:text-6xl">
                            <span class="block xl:inline" style="font-family: AtkinsonHyperlegible;">{{ __('Simplifier la certification') }}</span>
                            <span class="block text-purple-600 xl:inline" style="font-family: AtkinsonHyperlegible;">{{ __('de vos oeuvres') }}</span>
                        </h1>
                        <p data-aos="zoom-in-down" data-aos-delay="2100" class="mt-3 text-base text-gray-500 sm:mt-5 sm:text-lg sm:max-w-xl sm:mx-auto md:mt-5 md:text-xl lg:mx-0">
                            {{ __('Art certifications vous offre la possibilité de gerer vos oeuvres enligne et tres rapidement') }}
                        </p>
                    </div>
                    
                    <div class="mt-5 sm:mt-8 sm:flex sm:justify-center lg:justify-start">
                        <div data-aos="zoom-in-up" data-aos-delay="2200" class="rounded-md shadow">
                            <a href="/inscription" class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-white bg-purple-600 hover:bg-purple-700 md:py-4 md:text-lg md:px-10 transition duration-300 ease-in-out">
                                {{ __('S\'inscrire') }}
                            </a>
                        </div>
                        <div data-aos="zoom-in-up" data-aos-delay="2300" class="mt-3 sm:mt-0 sm:ml-3">
                            <a href="/admin" class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-purple-700 bg-purple-100 hover:bg-purple-200 md:py-4 md:text-lg md:px-10 transition duration-300 ease-in-out">
                                {{ __('Se Connecter') }}
                            </a>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <div class="lg:absolute lg:inset-y-0 lg:right-0 lg:w-1/2">
        <img class="h-56 w-full object-cover sm:h-72 md:h-96 lg:w-full lg:h-full" src="https://blog.singulart.com/wp-content/uploads/2018/08/CETUS-1040x861-1.jpeg" alt="hero-image-beautifull-draw">
    </div>
</header>
@endsection

<!-- hero section -->
@section('content')
<!-- Service section -->
<div class=" w-full min-h-screen bg-gray-50 flex flex-col justify-center items-center md:items-start space-y-10 py-4" id="home">

    <div class="mx-auto max-w-4xl py-24 px-4">
        <img data-aos="fade-right" data-aos-duration="300" class="h-8 w-auto sm:h-10" src="/images/logoPurple2.svg" alt="Art-certification-logo">
        <p data-aos="fade-right" data-aos-duration="500" class="text-3xl md:text-5xl text-purple-600 uppercase mt-4" style="font-family: Raleway-Light;">Art certification</p>
        <div data-aos="fade-right" data-aos-duration="700" class="w-60 h-1 rounded-xl my-2 bg-purple-500 mb-6"></div>

        <div data-aos="fade-down" data-aos-duration="1500"  style="font-family: Raleway-Light;" class="text-lg">
            <span class="text-3xl font-bold">{{ __('N')}}</span>{{ __('otre platforme est designee pour les artistes ou leur managers pour les aider a gerer leur oeuvres, et aussi pour les personnes qui pensent a acheter ou verifier la credibilite de leurs oeuvres')}}
            <p class="font-semibold pt-4">{{ __('Les préférences de notre plateforme')}}</p>
            <ul class="px-10 mt-4">
                <li> {{ __('L\'inscription sur notre plateforme est simple et rapide')}}. </li>
                <li> {{ __('La manipulation des oeuvres est automatisée')}}. </li>
                <li> {{ __('La vérification de certificat est gratuite')}}. </li>
                <li> {{ __('La fluidité par rapport à votre type de travail')}}. </li>
                <li> {{ __('Le support est actif pour régler vos problèmes')}}. </li>
            </ul>
        </div>
    </div>

    
    <div class="ml-0 md:ml-14 pt-4" id="services">
        <h1 data-aos="zoom-in-right" data-aos-duration="300" class="text-5xl text-gray-600 font-bold mt-10 lg:mt-0" style="font-family: PaytoneOne;">{{ __('NOS SERVICES') }}</h1>
        <div data-aos="zoom-in-right" data-aos-duration="500" class="w-56 h-2 rounded-xl my-2 bg-gray-600"></div>
    </div>

    <div class="relative w-full flex flex-col justify-center space-y-10 lg:space-y-0 lg:flex-row lg:justify-center items-center py-24">
        <div data-aos="fade-right" data-aos-duration="300" class="relative flex flex-col items-center justify-around p-4 mr-4 w-80 h-80 bg-gray-100 rounded-2xl shadow-inner ">
            <div class="z-10 p-2 ">
                <i class="fas fa-file-contract mb-4 text-purple-600" style="font-size: 50px;"></i>
                <h3 class="z-10 text-2xl font-semibold text-purple-600">{{ __('Certification de vos oeuvres') }}</h3>
                <div class="w-16 h-1 bg-purple-500 my-2 rounded-2xl"></div>
            </div>
            <div class="z-10 p-2 text-sm text-center text-gray-500 ">{{ __('Notre plateforme vous donne la possibilité de demander la certification pour vos oeuvres') }}</div>
        </div>

        <div data-aos="fade-right" data-aos-duration="1000" class="relative flex flex-col items-center justify-around p-4 mr-4 w-80 h-80 bg-gray-100 rounded-2xl shadow-inner ">
            <div class="z-10 p-2">
                <i class="fas fa-search mb-4 text-purple-600" style="font-size: 50px;"></i>
                <h3 class="z-10 text-2xl font-semibold text-purple-600">{{ __('Rechercher des certificats') }}</h3>
                <div class="w-16 h-1 bg-purple-500 my-2 rounded-2xl"></div>
            </div>
            <div class="z-10 p-2 text-sm text-center text-gray-500 ">{{ __('Vous avez des certificats, vous pouvez verifier s\'il est vrai ? nous vous offrons ce service') }}</div>
        </div>

        <div data-aos="fade-right" data-aos-duration="1700" class="relative flex flex-col items-center justify-around p-4 mr-4 w-80 h-80 bg-gray-100 rounded-2xl shadow-inner">
            <div class="z-10 p-2">
                <i class="fas fa-headset mb-4 text-purple-600" style="font-size: 50px;"></i>
                <h3 class="z-10 text-2xl font-semibold text-purple-600">{{ __('Support technique') }} <br> 24H / 7J</h3>
                <div class="w-16 h-1 bg-purple-500 my-2 rounded-2xl"></div>
            </div>
            <div class="z-10 p-2 text-sm text-center text-gray-500 ">{{ __('Notre support est très actif pour répondre à vos problèmes et questions') }}</div>
        </div>

        <svg class=" block absolute bottom-0 h-48 w-full transform translate-y-28" fill="#F9FAFB" viewBox="0 0 100 100" preserveAspectRatio="none" aria-hidden="true">
            <polygon points="100,50 0,50 100,100" />
        </svg>
    </div>

</div>
<!-- Service section -->

<!-- plans section -->
<div class="min-w-screen min-h-screen px-5 py-10" id="plans">
    <div class="w-full mx-auto text-gray-600 ">
        <div class="ml-14">
            <h1 data-aos="zoom-in-right" data-aos-duration="300" class="text-5xl text-gray-600 font-bold" style="font-family: PaytoneOne;">{{ __('NOS PLANS') }}</h1>
            <div data-aos="zoom-in-right" data-aos-duration="500" class="w-56 h-2 rounded-xl my-2 bg-gray-600"></div>
        </div>
        <div data-aos="fade-down" data-aos-duration="700" class="text-center max-w-xl mx-auto">
            <h3 class="text-lg font-medium my-10" style="font-family: AtkinsonHyperlegible;">{{ __('Vous pouvez choisir l\'un des plans que vous pouvez si vous etes besoin des plan special vous pouvez contactez l\'admin') }}</h3>
        </div>
        <div class="max-w-4xl mx-auto md:flex">
            <div data-aos="fade-up-right" data-aos-duration="1000" class="w-full md:w-1/3 md:max-w-none bg-white px-8 md:px-10 py-8 md:py-10 mb-3 mx-auto md:my-6 rounded-md shadow-lg shadow-gray-600 md:flex md:flex-col">
                <div class="w-full flex-grow">
                    <h2 class="text-center font-bold uppercase mb-4">{{ __('Mois') }}</h2>
                    <h3 class="text-center font-bold text-4xl mb-5">5$</h3>
                    <ul class="text-sm px-5 mb-8">
                        <li class="leading-tight"><i class="mdi mdi-check-bold text-lg"></i> Lorem ipsum</li>
                        <li class="leading-tight"><i class="mdi mdi-check-bold text-lg"></i> Dolor sit amet</li>
                    </ul>
                </div>
                <div class="w-full text-center">
                    <a href="/inscription?plan=10" class="font-bold bg-purple-500 hover:bg-purple-600 text-white rounded-md px-10 py-3 cursor-pointer transition duration-300 ease-in-out w-full">{{ __('S\'inscrire') }}</a>
                </div>
            </div>
            <div data-aos="zoom-out-down" data-aos-duration="1500" class="w-full md:w-1/3 md:max-w-none bg-white px-8 md:px-10 py-8 md:py-10 mb-3 mx-auto md:-mx-3 md:mb-0 rounded-md shadow-lg shadow-gray-600 md:relative md:z-50 md:flex md:flex-col">
                <div class="w-full flex-grow">
                    <h2 class="text-center font-bold uppercase mb-4">{{ __('Indéterminé') }}</h2>
                    <h3 class="text-center font-bold text-4xl md:text-5xl mb-5">20$</h3>
                    <ul class="text-sm px-5 mb-8">
                        <li class="leading-tight"><i class="mdi mdi-check-bold text-lg"></i> Lorem ipsum</li>
                        <li class="leading-tight"><i class="mdi mdi-check-bold text-lg"></i> Dolor sit amet</li>
                        <li class="leading-tight"><i class="mdi mdi-check-bold text-lg"></i> Consectetur</li>
                        <li class="leading-tight"><i class="mdi mdi-check-bold text-lg"></i> Adipisicing</li>
                        <li class="leading-tight"><i class="mdi mdi-check-bold text-lg"></i> Elit repellat</li>
                    </ul>
                </div>
                <div class="w-full text-center">
                    <a href="/inscription?plan=25" class="font-bold bg-purple-500 hover:bg-purple-600 text-white cursor-pointer rounded-md px-10 py-3 transition duration-300 ease-in-out w-full">{{ __('S\'inscrire') }}</a>
                </div>
            </div>
            <div data-aos="fade-up-left" data-aos-duration="1000" class="w-full md:w-1/3 md:max-w-none bg-white px-8 md:px-10 py-8 md:py-10 mb-3 mx-auto md:my-6 rounded-md shadow-lg shadow-gray-600 md:flex md:flex-col">
                <div class="w-full flex-grow">
                    <h2 class="text-center font-bold uppercase mb-4">{{ __('Annee') }}</h2>
                    <h3 class="text-center font-bold text-4xl mb-5">15$</h3>
                    <ul class="text-sm px-5 mb-8">
                        <li class="leading-tight"><i class="mdi mdi-check-bold text-lg"></i> Lorem ipsum</li>
                        <li class="leading-tight"><i class="mdi mdi-check-bold text-lg"></i> Dolor sit amet</li>
                        <li class="leading-tight"><i class="mdi mdi-check-bold text-lg"></i> Consectetur</li>
                        <li class="leading-tight"><i class="mdi mdi-check-bold text-lg"></i> Adipisicing</li>
                        <li class="leading-tight"><i class="mdi mdi-check-bold text-lg"></i> Much more...</li>
                    </ul>
                </div>
                <div class="w-full text-center">
                    <a href="/inscription?plan=20" class="font-bold bg-purple-500 hover:bg-purple-600 cursor-pointer text-white rounded-md px-10 py-3 transition duration-300 ease-in-out w-full">{{ __('S\'inscrire') }}</a>
                </div>
            </div>
        </div>
        <div data-aos="zoom-out-down" data-aos-duration="1000" class="max-w-4xl mx-auto flex justify-center space-x-10 mt-10">
            <div>
                <i class="fas fa-handshake text-3xl text-gray-400"></i>
                <p>{{ __('Face à face') }}</p>
            </div>
            <div>
                <i class="fas fa-credit-card text-3xl text-gray-400"></i>
                <p>{{ __('Carte de crédit') }}</p>
            </div>
            <div>
                <i class="fab fa-paypal text-3xl text-gray-400"></i>
                <p>{{ __('PayPal') }}</p>
            </div>
        </div>
    </div>
</div>
<!-- plans section -->

<!-- contact section -->
<div data-aos="zoom-in" data-aos-duration="500" >
    @livewire('contactus')
</div>


<!-- contact section -->
@endsection