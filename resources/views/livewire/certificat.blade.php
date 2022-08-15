<div style="font-family: Raleway-Light;">

    @if($showCertificatContainer)
    <div class="fixed top-0 w-full h-screen flex justify-center items-center z-30 md:pt-0 pt-72 overflow-scroll" style="background-color: rgba(228, 228, 228,.8);">
        
        <div class="bg-white shadow-lg rounded pb-10 px-10 m-4">
            <div class="w-full flex justify-between items-center border-b-2 border-gray-200 my-10">
                <h1 class="text-center text-xl md:text-3xl font-semibold uppercase" >{{ __('Certificat d\'authenticite ') }}</h1>
                <i wire:click="closeCertificat" class="fas fa-times-circle text-purple-300 cursor-pointer text-2xl hover:text-purple-500 transition duration-300 ease-in-out"></i>
            </div>

            <div class="w-full flex flex-col md:flex-row items-center justify-around md:space-x-4">
                @foreach($oeuvreCertificat->media as $media)
                    @if($loop->first)
                        <div class="">
                            <img class="h-96 shadow-lg" src="{{ $media->image }}" alt="{{ $oeuvreCertificat->titre }}">
                            <p class="py-4"><span class="w-72 text-gray-600 pl-2 pr-5">Code Certificat </span> <span class="font-semibold">{{ $codeCertificat }}</span></p>
                        </div>
                    @endif
                @endforeach

                <div >
                    <h1 class="mb-10"> {{ __('Je soussigne')}}, <span class="font-bold uppercase">{{ $artist->username }}</span> {{ __('certifie que la sculpture designee ci-apres est originale.')}}</h1>
                    <div class="flex justify-start mb-2">
                        <p class="w-72 text-gray-600">{{ __('Titre')}}</p>
                        <p class="font-semibold uppercase">{{ __($oeuvreCertificat->titre) }}</p>
                    </div>

                    <div class="flex justify-start mb-2">
                        <p class="w-72 text-gray-600">{{ __('Annee')}}</p>
                        <p class="font-semibold uppercase">{{ __($oeuvreCertificat->annee_creation) }}</p>
                    </div>

                    <div class="flex justify-start mb-2">
                        <p class="w-72 text-gray-600">{{ __('Technique')}}</p>
                        <p class="font-semibold uppercase">{{ __($oeuvreCertificat->technique_materiaux) }}</p>
                    </div>

                    <div class="flex justify-start mb-2">
                        <p class="w-72 text-gray-600">{{ __('Emplacement signature')}}</p>
                        <p class="font-semibold uppercase">{{ __($oeuvreCertificat->Emplacement_signature) }}</p>
                    </div>

                    @if(!empty($oeuvreCertificat->support))
                    <div class="flex justify-start mb-2">
                        <p class="w-72 text-gray-600">{{ __('Support')}}</p>
                        <p class="font-semibold uppercase">{{ __($oeuvreCertificat->support) }}</p>
                    </div>
                    @endif

                    <div class="flex justify-start mb-2">
                        <p class="w-72 text-gray-600">{{ __('Dimension')}}</p>
                        <p class="font-semibold uppercase">
                            {{ __($oeuvreCertificat->longueur) }} ×
                            {{ __($oeuvreCertificat->largeur) }}
                            @if(!empty($oeuvreCertificat->hauteur))
                            ×
                            {{ __($oeuvreCertificat->hauteur) }}
                            @endif
                        </p>
                    </div>

                    @if(!empty($oeuvreCertificat->numero_serie))
                    <div class="flex justify-start mb-2">
                        <p class="w-72 text-gray-600">{{ __('Numero de serie')}}</p>
                        <p class="font-semibold uppercase">
                            {{ __($oeuvreCertificat->numero_serie) }}
                        </p>
                    </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
    @endif

</div>