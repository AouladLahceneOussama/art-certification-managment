<div >

    <style>
        .line::after {
            content: '';
            position: absolute;
            width: 100%;
            height: 4px;
            background-color: gray;
            opacity: 25%;
            top: 49%;
            z-index: 0;
            border-radius: 2px;
        }

        .line::before {
            content: '';
            position: absolute;
            height: 4px;
            background-color: #8B5CF6;
            left: 0;
            top: 49%;
            z-index: 0;
            border-radius: 2px;
            transition: .3s ease-in-out;
            width: {{ $pourcentage }}%
        }

        .radio input~label {
            background-color: #F3F4F6;
            color: black;
            cursor: pointer;
            transition: .3s ease-in-out;
        }

        .radio input:hover~label {
            background-color: #E5E7EB;
        }
        .radio input:checked~label {
            background-color: #8B5CF6;
            color: white;
        }

        [data-braintree-id="choose-a-way-to-pay"] {
            display: none;
        }
        
        .bootstrap-tagsinput {
            background-color: #fff;
            border: 1px solid #E5E7EB;
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06);;
            display: inline-block;
            padding: 0.25rem 0.75rem;
            margin-top: 0.5rem;
            color: #374151;
            border-radius: 0.25rem;
            line-height: 1.25;
            width: 100% !important;
            line-height: 22px;
            cursor: text;
        }

        .bootstrap-tagsinput input {
            border: none;
            box-shadow: none;
            outline: none;
            background-color: transparent;
            padding: 0;
            margin:0.25rem 0;
            width: auto;
        }

        .bootstrap-tagsinput.form-control input::-moz-placeholder {
            color: #777;
            opacity: 1;
        }

        .bootstrap-tagsinput.form-control input:-ms-input-placeholder {
            color: #777;
        }

        .bootstrap-tagsinput.form-control input::-webkit-input-placeholder {
            color: #777;
        }

        .bootstrap-tagsinput input:focus {
            border: none;
            box-shadow: none;
        }

        .bootstrap-tagsinput .tag {
            margin-right: 2px;
            background-color: #8B5CF6;
            padding: 2px 3px;
            border-radius: 5px;
            color: white;
        }

        .bootstrap-tagsinput .tag [data-role="remove"] {
            margin-left: 8px;
            cursor: pointer;
        }

        .bootstrap-tagsinput .tag [data-role="remove"]:after {
            content: "x";
            padding: 0px 2px;
        }

        .bootstrap-tagsinput .tag [data-role="remove"]:hover {
            box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.2), 0 1px 2px rgba(0, 0, 0, 0.05);
        }

        .bootstrap-tagsinput .tag [data-role="remove"]:hover:active {
            box-shadow: inset 0 3px 5px rgba(0, 0, 0, 0.125);
        }
    </style>

    <div class="w-full flex flex-col lg:flex-row justify-center space-x-0 space-y-3 lg:space-y-0 lg:space-x-3 items-start mt-4">
       
        <div class="bg-gray-200 h-48 shadow-inner rounded-lg px-6 w-full lg:w-1/3">
            <div class="uppercase font-semibold pt-6">
                <h1>{!! __($pages[$currentPage]['title']) !!}</h1>
            </div>
            <div class="w-48 h-1 bg-gray-100 rounded-full mb-6"></div>
            <h1 class="font-light">{!! __($pages[$currentPage]['description']) !!}</h1>
        </div>

        <form wire:submit.prevent="save" class="bg-white p-10 rounded-lg shadow-lg w-full lg:w-2/3">
            <h1 class="font-bold text-center border-b-2 mb-6 pb-2 uppercase"> {{ __('Demande de certification') }}</h1>
            
            <div class="relative w-full flex justify-around my-10 line">
                <div class=" {{ $pourcentage > 24 ? 'bg-purple-500' : 'bg-gray-500' }} bg-gray-500 rounded-full z-10 transition duration-300 delay-75 ease-in-out ">
                    <p class="font-semibold text-md text-white w-10 h-10 text-center leading-10">1</p>
                </div>
                <div class="@if($pourcentage === 25) bg-gray-500 @endif {{ $pourcentage > 49 ? 'bg-purple-500' : 'bg-gray-300' }}  rounded-full z-10 transition duration-300 delay-75 ease-in-out ">
                    <p class="font-semibold text-md text-white w-10 h-10 text-center leading-10">2</p>
                </div>
                <div class="@if($pourcentage === 50) bg-gray-500 @endif {{ $pourcentage > 74 ? 'bg-purple-500' : 'bg-gray-300' }}  rounded-full z-10 transition duration-300 delay-75 ease-in-out ">
                    <p class="font-semibold text-md text-white w-10 h-10 text-center leading-10">3</p>
                </div>
                <div class="@if($pourcentage === 75) bg-gray-500 @endif {{ $pourcentage > 99 ? 'bg-purple-500' : 'bg-gray-300' }}  rounded-full z-10 transition duration-300 delay-75 ease-in-out">
                    <p class="font-semibold text-md text-white w-10 h-10 text-center leading-10">4</p>
                </div>
            </div>
            
            <div wire:key="page1" class="px-4"> 
                @if($currentPage === 1 )
                    
                        <div class="mb-4 md:flex md:justify-between">

                            <div class="w-full mb-4 md:mr-2 md:mb-0">
                                <label class="block mb-2 text-sm font-bold text-gray-700" for="nom">
                                    {{__('Nom')}}
                                </label>
                                <input wire:model="nom" class="w-full px-3 py-2 mb-1 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none" id="nom" type="text" placeholder="Jhon" />
                                @error('nom') <span class="block text-red-500 text-xs ">{{ __($message) }}</span> @enderror
                            </div>

                            <div class="w-full md:ml-2">
                                <label class="block mb-2 text-sm font-bold text-gray-700" for="prenom">
                                    {{__('Prenom')}}
                                </label>
                                <input wire:model="prenom" class="w-full px-3 py-2 mb-1 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none" id="prenom" type="text" placeholder="Doe" />
                                @error('prenom') <span class="block text-red-500 text-xs ">{{ __($message) }}</span>@enderror
                            </div>

                        </div>

                        <div class="mb-4 md:flex md:justify-between">
                            <div class="w-full mb-4 md:mr-2 md:mb-0">
                                <label class="block mb-2 text-sm font-bold text-gray-700" for="email">
                                    {{__('Email')}}
                                </label>
                                <input wire:model="email" class="w-full px-3 py-2 mb-1 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none" id="email" type="email" placeholder="JohnDoe@example.com" />
                                @error('email') <span class="block text-red-500 text-xs ">{{ __($message) }}</span> @enderror
                            </div>

                            <div class="w-full md:ml-2">
                                <label class="block mb-2 text-sm font-bold text-gray-700" for="telephone">
                                    {{__('Numéro téléphone')}}
                                </label>
                                <input wire:model="telephone" class="w-full px-3 py-2 mb-1 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none" id="telephone" type="text" placeholder="0662534904" />
                                @error('telephone') <span class="block text-red-500 text-xs ">{{ __($message) }}</span>@enderror
                            </div>
                        </div>
                    
                @endif
            </div>

            <div wire:key="page2" class="px-4">
                @if($currentPage === 2 )
                    
                        <div class="mb-4">
                            <label class="mb-2 text-sm font-bold text-gray-700" for="typeOeuvre">
                                {{__('Type de l\'oeuvre')}}
                            </label>
                            <select wire:model="type_oeuvre" class="w-full px-3 py-2 mb-1 text-sm leading-tight text-gray-700 border rounded shadow appearance-none bg-white focus:outline-none" id="typeOeuvre">
                                <option value="" selected>-- {{__('Choisir')}} --</option>
                                <option value="tableau">{{__('Tableau')}}</option>
                                <option value="lito">{{__('Litographie')}}</option>
                                <option value="sculpture">{{__('Sculpture')}}</option>
                            </select>
                            @error('type_oeuvre') <span class="block text-red-500 text-xs ">{{ __($message) }}</span>@enderror
                        </div>

                        <div class="mb-4">
                            <div class="mb-4">
                                <label class="mb-2 text-sm font-bold text-gray-700" for="nSerie">
                                    {{__('Titre de l\'oeuvre')}}
                                </label>
                                <input wire:model="titre_oeuvre" class="w-full px-3 py-2 mb-1 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none" id="titreOeuvre" type="text" placeholder="{{ __('titre de l\'oeuvre')}}" />
                                @error('titre_oeuvre') <span class="block text-red-500 text-xs ">{{ __($message) }}</span> @enderror
                            </div>
                        </div>

                        @if ($tableau ?? '')
                        <h3 class="font-bold text-center border-b-2 mb-6 pb-2 uppercase">{{__('Les informations à propos de l\'oeuvre')}}</h3>

                        <!-- form to add table-->
                        <div class="mb-4">
                            <label class="block mb-2 text-sm font-bold text-gray-700" for="dimension">
                                {{__('Dimensions')}}
                            </label>
                            <div class="flex justify-between space-x-4">
                                <div class="w-full">
                                    <input wire:model="largeur"  class="w-full px-3 py-2 mb-1 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none" id="dimension" min="10" type="number" placeholder="{{__('largeur')}} cm" />
                                    @error('largeur') <span class="block text-red-500 text-xs ">{{ __($message) }}</span>@enderror
                                </div>
                                <div class="w-full">
                                    <input wire:model="longueur" class="w-full px-3 py-2 mb-1 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none" id="" min="10" type="number" placeholder="{{__('longueur')}} cm" />
                                    @error('longueur') <span class="block text-red-500 text-xs ">{{ __($message) }}</span>@enderror
                                </div>
                            </div>
                        </div>

                        <div class="mb-4 md:flex md:justify-between">
                            <div class="w-full mb-4 md:mr-2 md:mb-0">
                                <label class="block mb-2 text-sm font-bold text-gray-700" for="technique">
                                    {{__('Techniques et matériel utilisé')}}
                                </label>
                                <input wire:model="technique_materiaux" class="w-full px-3 py-2 mb-1 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none" id="technique" type="text" placeholder="{{__('Techniques et matériel utilisé')}}" />
                                @error('technique_materiaux') <span class="block text-red-500 text-xs ">{{ __($message) }}</span>@enderror
                            </div>
                            <div class="w-full md:ml-2">
                                <label class="block mb-2 text-sm font-bold text-gray-700" for="support">
                                    {{__('Support')}}
                                </label>
                                <input wire:model="support" class="w-full px-3 py-2 mb-1 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none" id="support" type="text" placeholder="{{__('Support')}}" />
                                @error('support') <span class="block text-red-500 text-xs ">{{ __($message) }}</span>@enderror
                            </div>
                        </div>

                        <div class="mb-4 md:flex md:justify-between">
                            <div class="w-full mb-4 md:mr-2 md:mb-0">
                                <label class="block mb-2 text-sm font-bold text-gray-700" for="dateCreation">
                                    {{__('Année de création')}}
                                </label>
                                <input wire:model="annee_creation" class="w-full px-3 py-2 mb-1 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none" id="dateCreation" min="1800"  type="number" placeholder="{{__('Année de création')}}" />
                                @error('annee_creation') <span class="block text-red-500 text-xs ">{{ __($message) }}</span>@enderror
                            </div>
                            <div class="w-full md:ml-2">
                                <label class="block mb-2 text-sm font-bold text-gray-700" for="signature">
                                    {{__('Emplacement de signature')}}
                                </label>
                                <input wire:model="Emplacement_signature" class="w-full px-3 py-2 mb-1 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none" id="signature" type="text" placeholder="{{__('Emplacement de signature')}}" />
                                @error('Emplacement_signature') <span class="block text-red-500 text-xs ">{{ __($message) }}</span>@enderror

                            </div>
                        </div>
                        <!-- form to add table-->
                        @endif

                        @if ($lito ?? '')
                        <h3 class="font-bold text-center border-b-2 mb-6 pb-2 uppercase">{{__('Les informations à propos de l\'oeuvre')}}</h3>

                        <!-- form to add table-->
                        <div class="mb-4">
                            <label class="block mb-2 text-sm font-bold text-gray-700" for="dimension">
                                {{__('Dimensions')}}
                            </label>
                            <div class="w-full flex justify-between space-x-4">
                                <div class="w-full">
                                    <input wire:model="largeur" class="w-full px-3 py-2 mb-1 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none" id="dimension" min="10" type="number" placeholder="{{__('largeur')}} cm" />
                                    @error('largeur') <span class="block text-red-500 text-xs ">{{ __($message) }}</span>@enderror
                                </div>
                                <div class="w-full">
                                    <input wire:model="longueur" class="w-full px-3 py-2 mb-1 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none" id="" min="10" type="number" placeholder="{{__('longueur')}} cm" />
                                    @error('longueur') <span class="block text-red-500 text-xs ">{{ __($message) }}</span>@enderror
                                </div>
                            </div>
                        </div>

                        <div class="mb-4 md:flex md:justify-between">
                            <div class="w-full mb-4 md:mr-2 md:mb-0">
                                <label class="block mb-2 text-sm font-bold text-gray-700" for="technique">
                                    {{__('Techniques et matériel utilisé')}}
                                </label>
                                <input wire:model="technique_materiaux" class="w-full px-3 py-2 mb-1 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none" id="technique" type="text" placeholder="{{__('Techniques et matériel utilisé')}}" />
                                @error('technique_materiaux') <span class="block text-red-500 text-xs ">{{ __($message) }}</span>@enderror
                            </div>
                            <div class="w-full md:ml-2">
                                <label class="block mb-2 text-sm font-bold text-gray-700" for="support">
                                    {{__('Support')}}
                                </label>
                                <input wire:model="support" class="w-full px-3 py-2 mb-1 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none" id="support" type="text" placeholder="{{__('Support')}}" />
                                @error('support') <span class="block text-red-500 text-xs ">{{ __($message) }}</span>@enderror
                            </div>
                        </div>

                        <div>

                            <div class="mb-4 md:flex md:justify-between">
                                <div class="w-full mb-4 md:mr-2 md:mb-0">
                                    <label class="block mb-2 text-sm font-bold text-gray-700" for="dateCreation">
                                        {{__('Année de création')}}
                                    </label>
                                    <input wire:model="annee_creation" class="w-full px-3 py-2 mb-1 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none" id="dateCreation" min="1800"  type="number" placeholder="{{__('Année de création')}}" />
                                    @error('annee_creation') <span class="block text-red-500 text-xs ">{{ __($message) }}</span>@enderror

                                </div>
                                <div class="w-full md:ml-2">
                                    <label class="block mb-2 text-sm font-bold text-gray-700" for="signature">
                                        {{__('Emplacement de signature')}}
                                    </label>
                                    <input wire:model="Emplacement_signature" class="w-full px-3 py-2 mb-1 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none" id="signature" type="text" placeholder="{{__('Emplacement de signature')}}" />
                                    @error('Emplacement_signature') <span class="block text-red-500 text-xs ">{{ __($message) }}</span>@enderror

                                </div>
                            </div>

                            <div class="mb-4">
                                <div class="mb-4">
                                    <label class="mb-2 text-sm font-bold text-gray-700" for="nSerie">
                                        {{__('Numéro de série')}}
                                    </label>
                                    <input wire:model="numero_serie" class="w-full px-3 py-2 mb-1 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none" id="nSerie" type="text" placeholder="{{__('Numéro de série')}}" />
                                    @error('numero_serie') <span class="block text-red-500 text-xs ">{{ __($message) }}</span>@enderror

                                </div>
                            </div>

                        </div>

                        <!-- form to add table-->
                        @endif

                        @if ($sculpture ?? '')
                        <h3 class="font-bold text-center border-b-2 mb-6 pb-2 uppercase">{{__('Les informations à propos de l\'oeuvre')}}</h3>

                        <!-- form to add sculpture-->
                        <div class="mb-4">
                            <label class="block mb-2 text-sm font-bold text-gray-700" for="dimension">
                                {{__('Dimensions')}}
                            </label>
                            <div class="flex justify-between space-x-4">
                                <div class="w-full flex flex-col">
                                    <input wire:model="largeur" class="w-full px-3 py-2 mb-1 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none" id="dimension" min="10" type="number" placeholder="{{__('largeur')}} cm" />
                                    @error('largeur') <span class="block text-red-500 text-xs ">{{ __($message) }}</span>@enderror
                                </div>
                                <div class="w-full flex flex-col">
                                    <input wire:model="longueur" class="w-full px-3 py-2 mb-1 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none" id="" min="10" type="number" placeholder="{{__('longueur')}} cm" />
                                    @error('longueur') <span class="block text-red-500 text-xs ">{{ __($message) }}</span>@enderror
                                </div>
                                <div class="w-full flex flex-col">
                                    <input wire:model="hauteur" class="w-full px-3 py-2 mb-1 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none" id="" min="10" type="number" placeholder="{{__('hauteur')}} cm" />
                                    @error('hauteur') <span class="block text-red-500 text-xs ">{{ __($message) }}</span>@enderror
                                </div>
                            </div>
                        </div>

                        <div class="mb-4 md:flex md:justify-between">
                            <div class="w-full mb-4 md:mr-2 md:mb-0">
                                <label class="block mb-2 text-sm font-bold text-gray-700" for="technique">
                                    {{__('Techniques et matériel utilisé')}}
                                </label>
                                <input wire:model="technique_materiaux" class="w-full px-3 py-2 mb-1 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none" id="technique" type="text" placeholder="{{__('Techniques et matériel utilisé')}}" />
                                @error('technique_materiaux') <span class="block text-red-500 text-xs ">{{ __($message) }}</span>@enderror
                            </div>
                            <div class="w-full md:ml-2">
                                <label class="block mb-2 text-sm font-bold text-gray-700" for="support">
                                    {{__('Support')}}
                                </label>
                                <input wire:model="support" class="w-full px-3 py-2 mb-1 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none" id="support" type="text" placeholder="{{__('Support')}}" />
                                @error('support') <span class="block text-red-500 text-xs ">{{ __($message) }}</span>@enderror
                            </div>
                        </div>

                        <div class="mb-4 md:flex md:justify-between">
                            <div class="w-full mb-4 md:mr-2 md:mb-0">
                                <label class="block mb-2 text-sm font-bold text-gray-700" for="dateCreation">
                                    {{__('Année de création')}}
                                </label>
                                <input wire:model="annee_creation" class="w-full px-3 py-2 mb-1 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none" id="dateCreation" min="1800"  type="number" placeholder="{{__('Année de création')}}" />
                                @error('annee_creation') <span class="block text-red-500 text-xs ">{{ __($message) }}</span>@enderror
                            </div>
                            <div class="w-full md:ml-2">
                                <label class="block mb-2 text-sm font-bold text-gray-700" for="nSerie">
                                    {{__('Numéro de série')}}
                                </label>
                                <input wire:model="numero_serie" class="w-full px-3 py-2 mb-1 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none" id="nSerie" type="text" placeholder="{{__('Numéro de série')}}" />
                                @error('numero_serie') <span class="block text-red-500 text-xs ">{{ __($message) }}</span>@enderror
                            </div>
                        </div>
                        <!-- form to add sculpture-->
                        @endif
                    
                @endif
            </div>

            <div wire:key="page3" class="px-4">
                @if($currentPage === 3 )
                    <div>
                        @if ($tableau || $lito || $sculpture)

                            @foreach ($imagesForm as $index => $image)
                                <div wire:key="012{{ $loop->index }}">

                                    <h1 class="font-semibold text-sm text-gray-300 uppercase border-b-2 border-gray-300 my-2">{{ $imagesForm[$index]['intitule'] != '' ? $imagesForm[$index]['intitule'] : __('Intitule') }}</h1>
                                    <div class="flex flex-col md:flex-row justify-around items-center space-x-o md:space-x-6">
                                        <div class="w-full md:w-1/2">
                                            <div class="flex items-center justify-center w-full">
                                                <label class="flex flex-col rounded-lg border-4 border-dashed w-full h-40 group text-center">
                                                    <div class="h-full w-full text-center flex flex-col items-center justify-center items-center ">
                                                        <p class="pointer-none text-gray-500 p-2"><span class="text-sm">{{__('Faites glisser et déposez')}} </span> {{__('ou')}}
                                                            <span class="text-blue-600 hover:underline">{{__('sélectionnez un fichier')}}</span> {{__('sur votre ordinateur')}}
                                                        </p>
                                                    </div>
                                                    <input wire:model="imagesForm.{{ $index }}.src" type="file" class="hidden">
                                                </label>
                                            </div>
                                            @error('imagesForm.'.$index.'.src') <span class="block text-red-500 text-xs ">{{ __($message) }}</span>@enderror
                                        </div>

                                        <div class="w-full flex flex-col justify-center">
                                            <div class="w-full pb-2">
                                                <label class="block text-sm font-bold text-gray-500 tracking-wide">{{__('Intitule')}}</label>
                                                <input wire:model="imagesForm.{{ $index }}.intitule" class="w-full px-3 py-2 mb-1 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none @if($loop->iteration <= 3) pointer-events-none @endif" type="text" placeholder="{{__('Intitule')}}"><br>
                                                @error('imagesForm.'.$index.'.intitule') <span class="block text-red-500 text-xs ">{{ __($message) }}</span>@enderror
                                            </div>

                                            <div wire:ignore class="pb-2" >
                                                <label class="block text-sm font-bold text-gray-500 tracking-wide">{{__('Tags')}}</label>
                                                <input id="{{ $index }}" type="text" data-role="tagsinput" placeholder="{{__('Tags')}}">
                                                <div>
                                                    @if($loop->last)
                                                        <script>
                                                            $(document).ready(function() {

                                                                $('input[data-role="tagsinput"]').tagsinput({
                                                                    trimValue: true,
                                                                    confirmKeys: [44],
                                                                    maxTags: 3,
                                                                    maxChars: 8,
                                                                });

                                                                $('input').on('itemAdded', function(event) {
                                                                    var id = event.target.id;
                                                                    if($(this).val() != '')
                                                                        @this.set('imagesForm.' + id + '.tag', $(this).val());
                                                                });

                                                                $('input').on('itemRemoved', function(event) {
                                                                    var id = event.target.id;
                                                                    if($(this).val() != '')
                                                                        @this.set('imagesForm.' + id + '.tag', $(this).val());
                                                                });

                                                                //insert the old values 
                                                                var imagesForm = @this.get('imagesForm');
                                                                var tagsInput = $('input[data-role="tagsinput"]');


                                                                if (imagesForm.length > 0){
                                                                    for(var i=0 ; i < tagsInput.length ; i++){
                                                                        if(imagesForm[i]['tag'] != '')
                                                                            tagsInput.eq(i).tagsinput('add',imagesForm[i]['tag']);  
                                                                    }
                                                                }
                                                            });
                                                        </script>
                                                    @endif
                                                </div>
                                            </div>
                                            @error('imagesForm.'.$index.'.tag') <span class="block text-red-500 text-xs ">{{ __($message) }}</span>@enderror


                                            <div >
                                                @if($loop->iteration > 3)
                                                <div class="pt-2 flex justify-end items-center">
                                                    <button wire:click.prevent="removeImage({{ $index }})" type="button" class="px-6 py-1 bg-red-400 text-white font-semibold text-sm rounded focus:outline-none hover:bg-red-600 shadow-lg cursor-pointer transition ease-in duration-300">
                                                        {{__('Supprimer')}}
                                                    </button>
                                                </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div>
                                        @if ($imagesForm[$index]['src'])
                                            <div class="w-full relative my-3 shadow-lg ">
                                                <img src="{{ $imagesForm[$index]['src']->temporaryUrl() }}" class="w-full h-96 object-cover">
                                                <div class="absolute w-full top-0 right-0 bg-gray-50 shadow opacity-90">
                                                    <div class="w-full flex flex-col lg:flex-row justify-around items-center py-2 px-1 lg:px-5">
                                                        <span class="text-gray-500">{{ $imagesForm[$index]['src']->getClientOriginalName() }}</span> 
                                                        <div>
                                                            <span class="text-gray-500 text-xs">{{ $imagesForm[$index]['src']->getSize() }} &nbsp KB</span>
                                                            <i wire:click="resetImage({{ $index }})" class="fas fa-trash text-red-400 ml-4 cursor-pointer hover:text-red-500 transition duration-300 ease-in-out"></i>
                                                        </div>
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    </div>

                                </div>
                            @endforeach

                            <button wire:click.prevent="addImage" class="my-2 bg-gray-400 px-8 py-1 tracking-wide text-white font-semibold rounded focus:outline-none hover:bg-gray-500 shadow-lg cursor-pointer transition ease-in duration-300">
                                {{__('Ajouter image')}}
                            </button>
                            
                        @endif
                    </div>
                @endif
            </div>

            <div wire:key="page4" class="px-4">
                @if($currentPage === 4 )
                    
                        @if( $paymentProcess != 'seccessful' || $paymentProcess == 'unseccessful' )
                            <div class="flex justify-around items-center w-full px-2 py-1 mb-4">
                                <span class="input-label">{{ __('Frais de certification') }}</span>
                                <span class="text-xl font-semibold">10$</span>
                            </div>

                            <div class="flex justify-center w-full -mt-4 mb-4">
                                <div class="w-48 h-1 bg-gray-200 rounded-full "></div>
                            </div>
                    
                            <style>
                                input:checked ~ .radio {
                                    color: white;
                                    background-color: #8B5CF6;
                                }
                            </style>

                            <div class="flex justify-center items-center space-x-2">
                                <div class="rounded-lg">
                                    <div class="inline-flex rounded-lg">
                                        <input type="radio" id="faceToFace" name="paiment" wire:model="paymentMethod" value="face a face" checked hidden/>
                                        <label for="faceToFace" class="radio text-center self-center py-2 px-4 bg-gray-200 rounded cursor-pointer font-normal hover:opacity-75 duration-300 ease-in-out">{{ __('Face à face')}}</label>
                                    </div>
                                    <div class="inline-flex rounded-lg">
                                        <input type="radio" id="paypalOrCard" name="paiment" wire:model="paymentMethod" value="Paypal ou Card" hidden/>
                                        <label for="paypalOrCard" class="radio text-center self-center py-2 px-4 bg-gray-200 rounded cursor-pointer font-normal hover:opacity-75 duration-300 ease-in-out">{{ __('PayPal ou Carte bancaire') }}</label>
                                    </div>
                                </div>
                            </div>

                            <div>
                                @if( $paymentMethod === "face a face")
                                    <div class="px-6 py-2">
                                        <span class="text-red-400 text-xs"> * {{ __('Cette méthode est disponible si vous etes au Tetouan,Maroc') }} </span>
                                        <p>{{ __('L\'admin va vous contacter le plus tot possible pour finalisez votre paiment.') }}</p>
                                    </div>
                                @endif
                            </div>

                            <div>
                                @if( $paymentMethod === "Paypal ou Card" )
                                    <div wire:ignore class="px-6 py-1">
                                    
                                        <div id="bt-dropin"></div>            
                                        <input id="nonce" name="payment_method_nonce" type="hidden" />
                                        <button type="button" id="testTransaction" class="bg-purple-500 rounded-sm text-white py-1 px-4">{{ __('Tester la transaction')}}</button>
                                        <script>
                                            var client_token = "{{ $token }}";
                                            var btn = document.querySelector('#testTransaction');

                                            braintree.dropin.create({
                                                authorization: client_token,
                                                selector: '#bt-dropin',
                                                defaultFirst: true,
                                                paypal: {
                                                    flow: 'vault'
                                                }
                                            }, 
                                            function(createErr, instance) {
                                                btn.addEventListener('click', function () {
                                                    btn.disabled = true;
                                                    btn.classList.add('hidden');

                                                    instance.requestPaymentMethod(function (err, payload) {
                                                    if (err) {
                                                        console.log('Request Payment Method Error ',err);
                                                        btn.disabled = false;
                                                        btn.classList.remove('hidden');
                                                        return;
                                                    }
                                                    
                                                    if (payload.type === 'validation:failed') {
                                                        btn.disabled = false;
                                                        btn.classList.remove('hidden');
                                                    }

                                                    @this.set('payment_method_nonce',payload.nonce);
                                                    @this.emit('continuePayment');

                                                    });
                                                });
                                            });
                                        </script>
                                    </div>
                                @endif
                            </div>
                        @endif               

                        @error('paymentMethod') <span class="block text-red-500 text-xs">{{ $message }}</span> @enderror
                        <div>
                            @if ( $success != '' )
                                <div class="bg-green-300 text-green-500 font-normal px-4 py-6 my-4 rounded-lg text-left">
                                <h1 class="uppercase">{{ __('Rapport de paiement') }}</h1>
                                <div class="w-32 h-1 rounded-full bg-green-500 mb-4"></div>
                                {!! $success !!}
                                </div>
                            @endif
                        </div>

                        <div>
                            @if(session()->has('error_message'))
                                <div class="bg-red-300 text-red-500 font-semibold px-4 py-2 rounded-lg text-center">
                                {!! session('error_message') !!}
                                </div>
                            @endif
                        </div>

                        <div class="w-full mt-10">
                            <p class="uppercase text-gray-500 text-xs font-semibold ">
                                * {{ __('En soumettant le formulaire. Vous acceptez tous les termes et conditions') }}
                            </p>
                            <a href="#" target="_blank" class="text-sm m-0 text-purple-500 hover:text-purple-600 transition duration-300">{{ __('Lire les termes et conditions')}}</a>
                            
                        </div>
                    
                @endif
            </div>

            <div class="flex items-center justify-between py-3 px-4 text-right">
                @if($currentPage != 1)
                <div>
                    <button type="button" wire:click="goBack" class="bg-purple-500 py-1 px-6 text-white rounded-md hover:bg-purple-600 transition duration-300 ease-in-out">{{ __('Arrière') }}</button>
                </div>
                @else
                <p></p>
                @endif

                @if($currentPage === count($pages))

                <div class="md:flex md:items-center">
                    <div class="">
                        <button class="flex justify-around bg-purple-500 px-6 py-1 rounded-lg text-white uppercase font-semibold text-md hover:bg-purple-600 transtion duration-300" type="submit">
                            <div wire:loading wire:target="save">
                                <svg class="animate-spin mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 4335 4335" width="20" height="20">
                                    <path fill="#ffffff" d="M3346 1077c41,0 75,34 75,75 0,41 -34,75 -75,75 -41,0 -75,-34 -75,-75 0,-41 34,-75 75,-75zm-1198 -824c193,0 349,156 349,349 0,193 -156,349 -349,349 -193,0 -349,-156 -349,-349 0,-193 156,-349 349,-349zm-1116 546c151,0 274,123 274,274 0,151 -123,274 -274,274 -151,0 -274,-123 -274,-274 0,-151 123,-274 274,-274zm-500 1189c134,0 243,109 243,243 0,134 -109,243 -243,243 -134,0 -243,-109 -243,-243 0,-134 109,-243 243,-243zm500 1223c121,0 218,98 218,218 0,121 -98,218 -218,218 -121,0 -218,-98 -218,-218 0,-121 98,-218 218,-218zm1116 434c110,0 200,89 200,200 0,110 -89,200 -200,200 -110,0 -200,-89 -200,-200 0,-110 89,-200 200,-200zm1145 -434c81,0 147,66 147,147 0,81 -66,147 -147,147 -81,0 -147,-66 -147,-147 0,-81 66,-147 147,-147zm459 -1098c65,0 119,53 119,119 0,65 -53,119 -119,119 -65,0 -119,-53 -119,-119 0,-65 53,-119 119,-119z" />
                                </svg>
                            </div>
                            {{__('Envoyer demande')}}
                        </button>
                    </div>
                </div>
                @else
                <div>
                    <button type="button" wire:click="goNext()" class="bg-purple-500 py-1 px-6 text-white rounded-md hover:bg-purple-600 transition duration-300 ease-in-out">{{ __('Ensuite') }}</button>
                </div>
                @endif
            </div>

        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.min.js"></script>
    <script src="https://js.braintreegateway.com/web/dropin/1.13.0/js/dropin.min.js"></script>

</div>