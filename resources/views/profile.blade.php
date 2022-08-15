<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <title>Profile</title>
    <style>
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

<body class="text-gray-800 antialiased">
    <nav class="top-0 absolute z-10 w-full flex flex-wrap items-center justify-between px-2 py-3 ">
        <div class="container px-4 mx-auto flex flex-wrap items-center justify-between">
            <div class="relative lg:w-auto lg:static lg:block lg:justify-start">
                <a class="text-sm font-bold leading-relaxed inline-block mr-4 py-2 whitespace-nowrap uppercase text-white" href="#">{{ __('Art-Certifications')}}</a>
            </div>
            <div class="lg:bg-transparent lg:shadow-none">
                <button class="bg-white text-gray-800 active:bg-gray-100 text-xs font-bold uppercase px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none lg:mr-1 lg:mb-0 ml-3 mb-3 transition duration-300" type="button">
                    {{ __('Mon siteweb')}}
                </button>
            </div>
        </div>
    </nav>

    <main class="profile-page">

        <section class="relative block" style="height: 500px;">
            <div class="absolute top-0 w-full h-full bg-center bg-cover" style="background-image: url('..{{ $artist->coverture_photo }}');">
                <span id="blackOverlay" class="w-full h-full absolute opacity-50 bg-black"></span>
            </div>
            <div class="top-auto bottom-0 left-0 right-0 w-full absolute pointer-events-none overflow-hidden" style="height: 70px;">
                <svg class="absolute bottom-0 overflow-hidden" fill="#F3F4F6" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none" version="1.1" viewBox="0 0 2560 100" x="0" y="0">
                    <polygon class="text-gray-300" points="2560 0 2560 100 0 100"></polygon>
                </svg>
            </div>
        </section>

        <section class="relative py-16 bg-gray-100">
            <div class="container mx-auto px-4">
                <div class="relative flex flex-col min-w-0 break-words bg-white w-full mb-6 shadow-xl rounded-lg -mt-64">
                    <div class="px-6">

                        <div class="flex flex-col lg:flex-row justify-start">

                            <div class="w-full lg:w-3/12 px-4 flex justify-center">
                                <div class="relative">
                                    <img src="{{ $artist->avatar }}" alt="{{ $artist->FirstName.' '.$artist->LastName }}" class="shadow-xl rounded-full h-auto align-middle border-none -m-16" style="max-width: 150px;" />
                                </div>
                            </div>

                            <div class="w-full mt-16 lg:mt-0 lg:w-4/12 px-4 py-4 lg:text-left text-center lg:self-center">
                                <div class="px-3 sm:mt-0">
                                    <h3 class="text-4xl font-bold text-gray-800">
                                        {{ $artist->FirstName.' '.$artist->LastName }}
                                    </h3>
                                    <div class="text-sm mb-2 text-gray-500 uppercase">
                                        <span>{{ $artist->occupation }} </span>
                                        @if( !empty($artist->autre_nom ))
                                        <span> {{ $artist->autre_nom }} </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            
                        </div>


                        <div class="w-full flex flex-col md:flex-row justify-around md:items-center mt-12 mx-6">
                           
                            <div>
                                <div class="text-sm leading-normal mt-0 mb-2">
                                    <i class="fas fa-envelope mr-2 text-lg text-gray-600"></i>
                                    <span class="text-gray-400 font-semibold">{{$artist->email}}</span>
                                </div>

                                <div class="text-sm leading-normal mt-0 mb-2">
                                    <i class="fas fa-phone-alt mr-2 text-lg text-gray-600"></i>
                                    <span class="text-gray-400 font-semibold">{{$artist->phone}}</span>
                                </div>

                                <div class="text-sm leading-normal mt-0 mb-2">
                                    <i class="fas fa-calendar-day mr-2 text-lg text-gray-600"></i>
                                    <span class="text-gray-400 font-semibold">{{$artist->birth}}</span>
                                </div>
                            </div>

                            <div>
                                <div class="text-sm leading-normal mt-0 mb-2">
                                    <i class="fas fa-map-marker-alt mr-2 text-lg text-gray-600"></i>
                                    <span class="text-gray-400 font-semibold">{{$artist->pays}}</span>
                                </div>

                                <div class="text-sm leading-normal mt-0 mb-2">
                                    <i class="fas fa-briefcase mr-2 text-lg text-gray-600"></i>
                                    <span class="text-gray-400 font-semibold">
                                    @foreach($artist->specialities as $sp)
                                        {{ $sp }}
                                        @if(!$loop->last)
                                            ,
                                        @endif
                                    @endforeach
                                    </span>
                                </div>
                            </div>

                        </div>

                        <div class="mt-10 py-10 border-t border-gray-300 text-center">
                            <div class="flex flex-wrap justify-center">
                                <div class="w-full lg:w-9/12 px-4">
                                    <p class="mb-4 text-lg leading-relaxed text-gray-800">
                                        {{ $artist->biography }}
                                    </p>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="w-full flex flex-col md:flex-row justify-end px-4 space-x-0 md:space-x-6">
                        <button class="w-full md:w-1/5 cursor-pointer bg-purple-500 text-white mb-6 shadow-xl rounded-lg py-4 px-6 focus:outline-none hover:bg-purple-600 transition duration-300" id="rechercheBtn">{{ __('Rechercher un certificat')}}</button>
                        <button class="w-full md:w-1/5 cursor-pointer bg-purple-500 text-white mb-6 shadow-xl rounded-lg py-4 px-6 focus:outline-none hover:bg-purple-600 transition duration-300" id="demandeBtn">{{ __('Demander un certificat')}}</button>
                    </div>
                </div>

                

                <div class="hidden" id="recherche">
                    @livewire('recherche',['id_artist' => $artist->id])
                </div>
                <div class="hidden" id="demande">
                    @livewire('demande',['nom_artist' => $artist->username])
                </div>
            </div>
        </section>
    </main>

    @livewire('certificat')

    <script>
        var rechrcheBtn = document.getElementById("rechercheBtn");
        var demandeBtn = document.getElementById("demandeBtn");
        var rechercheForm = document.getElementById("recherche");
        var demandeForm = document.getElementById("demande");

        rechrcheBtn.addEventListener("click", function() {
            rechercheForm.classList.toggle("hidden");
            if (!demandeForm.classList.contains("hidden"))
                demandeForm.classList.toggle("hidden");
        });

        demandeBtn.addEventListener("click", function() {
            demandeForm.classList.toggle("hidden");
            if (!rechercheForm.classList.contains("hidden"))
                rechercheForm.classList.toggle("hidden");
        });
    </script>
    @livewireScripts
</body>

</html>