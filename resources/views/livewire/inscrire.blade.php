<div>
    <div class="mb-10 py-4 px-4 md:px-10 flex justify-between items-center w-full bg-purple-500 shadow-lg">
        <div class="flex justify-start items-center">
            <div class="flex justify-center items-center">
                <img class="h-10 w-auto" src="/images/logowhite2.svg" alt="logo">
            </div>
            <h1 class="text-2xl font-semibold text-white" style="font-family: Raleway-Light;">RT Certification</h1>
        </div>

        <h1 class="text-md md:text-2xl text-center text-white"> {{ __('Création du compte') }}</h1>
    
    </div>

    <div class="px-10 md:px-0 w-full flex flex-col items-center">
        <style>
            .trashIcon:hover {
                fill: #DC2626;
            }

            .line::after {
                content: '';
                position: absolute;
                width: 100%;
                height: 4px;
                background-color: gray;
                opacity: 25%;
                top: 49%;
                z-index: -1;
                border-radius: 2px;
            }

            .line::before {
                content: '';
                position: absolute;
                height: 4px;
                background-color: #8B5CF6;
                left: 0;
                top: 49%;
                z-index: -1;
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
        </style>

        <form wire:submit.prevent="save" class="w-full max-w-2xl mb-6">

            <div class="relative w-full flex justify-around my-10 line">
                <div class=" {{ $pourcentage > 24 ? 'bg-purple-500' : 'bg-gray-500' }} bg-gray-500 rounded-full transition duration-300 delay-75 ease-in-out ">
                    <p class="font-semibold text-md text-white w-10 h-10 text-center leading-10">1</p>
                </div>
                <div class="@if($pourcentage === 25) bg-gray-500 @endif {{ $pourcentage > 49 ? 'bg-purple-500' : 'bg-gray-300' }}  rounded-full transition duration-300 delay-75 ease-in-out ">
                    <p class="font-semibold text-md text-white w-10 h-10 text-center leading-10">2</p>
                </div>
                <div class="@if($pourcentage === 50) bg-gray-500 @endif {{ $pourcentage > 74 ? 'bg-purple-500' : 'bg-gray-300' }}  rounded-full transition duration-300 delay-75 ease-in-out ">
                    <p class="font-semibold text-md text-white w-10 h-10 text-center leading-10">3</p>
                </div>
                <div class="@if($pourcentage === 75) bg-gray-500 @endif {{ $pourcentage > 99 ? 'bg-purple-500' : 'bg-gray-300' }}  rounded-full transition duration-300 delay-75 ease-in-out">
                    <p class="font-semibold text-md text-white w-10 h-10 text-center leading-10">4</p>
                </div>
            </div>

            <div class="mt-2 mb-10 border-b-2 border-gray-300 bg-gray-200 rounded-md shadow-inner px-4 py-6">
                <h3 class="text-lg font-bold text-gray-900 uppercase">{{ __($pages[$currentPage]['title']) }}</h3>
                <p class="text-sm font-semibold text-gray-400">{{ __($pages[$currentPage]['description']) }}</p>
            </div>

            @if( $currentPage === 1)
            <div wire:key="page1">

                <div class="flex flex-wrap -mx-3 mb-6">

                    <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="nom">
                            {{ __('Nom') }}
                        </label>
                        <input required wire:model="LastName" class="block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-1 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="nom" type="text" placeholder="Jhon">
                        @error('LastName') <span class="block font-normal text-red-500 text-xs">{{ __($message) }}</span> @enderror
                    </div>

                    <div class="w-full md:w-1/2 px-3 ">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="prenom">
                            {{ __('Prénom') }}
                        </label>
                        <input required wire:model="FirstName" class="block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-1 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id=" prenom" type="text" placeholder="Doe">
                        @error('FirstName') <span class="block font-normal text-red-500 text-xs">{{ __($message) }}</span> @enderror
                    </div>
                </div>

                <div class="w-full mb-6 ">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="alias">
                        {{ __('Alias')}}
                    </label>
                    <input required wire:model="username" class="block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-1 leading-tight focus:outline-none focus:bg-white" id="alias" type="text" placeholder="JhonDoe">
                    @error('username') <span class="block font-normal text-red-500 text-xs">{{ __($message) }}</span> @enderror
                </div>

                <div class="flex flex-wrap -mx-3 mb-6" x-data="{ showPass:true }">
                    <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="password">
                            {{__('Mot de passe')}}
                        </label>
                        <div class="relative">
                            <input required wire:model="password" class="block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-1 leading-tight focus:outline-none focus:bg-white" id="password" :type="showPass ? 'password' : 'text' ">
                            <i @click="showPass = !showPass" :class="showPass ? 'fa-eye':'fa-eye-slash'" class="fas absolute right-4 top-3.5 cursor-pointer hover:text-gray-500 transition duration-300 ease-in-out" id="togglePass"></i>
                        </div>
                        @error('password') <span class="block font-normal text-red-500 text-xs">{{ __($message) }}</span> @enderror
                    </div>
                    <div class="w-full md:w-1/2 px-3">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="cPassword">
                            {{__('Confirmer le mot de passe')}}
                        </label>
                        <input required wire:model="cPassword" class="block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-1 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="cPassword" type="password">
                        @error('cPassword') <span class="block font-normal text-red-500 text-xs">{{ __($message) }}</span> @enderror
                    </div>
                </div>
            </div>

            @elseif($currentPage === 2)
            <div wire:key="page2">
                <div class="flex flex-wrap -mx-3 mb-6">
                    <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="naissance">
                            {{ __('Date de naissance') }}
                        </label>
                        <input required wire:model="birth" class="block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-1 leading-tight focus:outline-none focus:bg-white" id="naissance" type="date">
                        @error('birth') <span class="block font-normal text-red-500 text-xs">{{ __($message) }}</span> @enderror
                    </div>
                    <div class="w-full md:w-1/2 px-3 ">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="pays">
                            {{ __('Pays') }}
                        </label>
                        <input required wire:model="pays" class="block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-1 leading-tight focus:outline-none focus:bg-white" id="pays" type="text" placeholder="Maroc">
                        @error('pays') <span class="block font-normal text-red-500 text-xs">{{ __($message) }}</span> @enderror
                    </div>

                </div>

                <div class="flex flex-wrap -mx-3 mb-6">
                    <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="telephone">
                            {{ __('Téléphone') }}
                        </label>
                        <input required wire:model="phone" class="block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-1 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="telephone" type="text" placeholder="063128746">
                        @error('phone') <span class="block font-normal text-red-500 text-xs">{{ __($message) }}</span> @enderror
                    </div>
                    <div class="w-full md:w-1/2 px-3">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="email">
                            {{ __('Email') }}
                        </label>
                        <input required wire:model="email" class="block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-1 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="email" type="email" placeholder="jhonDoe@gmail.com">
                        @error('email') <span class="block font-normal text-red-500 text-xs">{{ __($message) }}</span> @enderror
                    </div>
                </div>
                
                <div class="flex flex-wrap -mx-3 mb-6">
                    <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="occupation">
                            {{ __('Occupation') }}
                        </label>
                        <select required wire:model="occupation" id="occupation" class="block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-1 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                            <option value=""> -- {{ __('Choisir')}} -- </option>
                            <option value="artiste"> {{ __('Artiste')}} </option>
                            <option value="marchand d'art"> {{ __('Marchand d\'art')}} </option>
                            <option value="collectionneur"> {{ __('Collectionneur')}} </option>
                            <option value="particulier"> {{ __('Particulier')}} </option>
                            <option value="entreprise"> {{ __('Entreprise')}} </option>
                            <option value="gallerie"> {{ __('Gallerie')}} </option>
                            <option value="autre"> {{ __('Autre')}} </option>
                        </select>
                        @error('occupation') <span class="block font-normal text-red-500 text-xs" >{{ __($message) }}</span> @enderror
                    </div>

                    <div class="w-full md:w-1/2 mb-6 md:mb-0">
                        <div wire:ignore class="w-full px-3">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="specialite">
                                {{ __('Specialite') }}
                            </label>
                            <select required multiple="multiple" class="select2 w-full">
                                <option value="peinture">{{ __('Peinture')}}</option>
                                <option value="sculpture">{{ __('Sculpture')}}</option>
                                <option value="litographie">{{ __('Litographie')}}</option>
                                <option value="photographie">{{ __('Photographie')}}</option>
                            </select>
                            <script>
                                $(document).ready(function() {
                                    $('.select2').select2({
                                        placeholder: '-- {{ __("Choisir") }} --'
                                    }).on('change', function() {
                                        @this.set('specialities', $(this).val());
                                    });

                                    //insert the old values 
                                    var values = @this.get('specialities');
                                    if (values.length > 0)
                                        $('.select2').val(values).trigger('change');

                                });
                            </script>
                        </div>
                        @error('specialities') <span class="block px-3 pt-1 font-normal text-red-500 text-xs" >{{ __($message) }}</span> @enderror
                    </div>
                </div>

                @if($autre)
                <div>
                    <h3 class="border-b-2 border-gray-200 text-xs uppercase text-gray-400 mb-4"> {{ __('Information Complémentaire') }}</h3>
                </div>
                <div class="flex flex-wrap -mx-3 mb-6">
                    <div class="w-full px-3">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="autreNom">
                            {{ __('Autre nom') }}
                        </label>
                        <input required wire:model="autre_nom" class="block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-1 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="autreNom" type="text" placeholder="jhonDoe">
                        @error('autre_nom') <span class="block font-normal text-red-500 text-xs">{{ __($message) }}</span> @enderror
                    </div>
                </div>
                @endif
                <div class="flex flex-wrap -mx-3 mb-6">
                    <div class="w-full px-3">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="bio">
                            {{ __('Biographie') }}
                        </label>
                        <textarea wire:model="biography" class=" no-resize block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-1 leading-tight focus:outline-none focus:bg-white focus:border-gray-500 h-48 resize-none" id="bio"></textarea>
                        @error('biography') <span class="block font-normal text-red-500 text-xs">{{ __($message) }}</span> @enderror
                    </div>
                </div>
            </div>

            @elseif( $currentPage === 3 )
            <div wire:key="page3">
                <div class="hidden">
                    @if($coverture_photo)
                        {{ $backImage = $coverture_photo->temporaryUrl() }} 
                    @else 
                        {{ $backImage = '../images/userBackground.jpg' }}
                    @endif
                </div>
  
                <div class="relative mb-16 w-full" >
                    <div class="w-full shadow-inner" >
                        <img src="{{ $backImage }}" class="h-32 w-full rounded object-cover " alt="">
                    </div>

                    <div class="absolute bottom-0 left-4 ml-4 md:ml-16 -mb-10 z-10">
                        <img src="@if($avatar) {{ $avatar->temporaryUrl() }} @else images/userProfile.png @endif " alt="imageProfile-preview" class="shadow-xl rounded-full border-none" style="width: 100px; height:100px; object-fit:cover" />
                    </div>
                    
                    <div class="top-auto bottom-0 left-0 right-0 w-full absolute pointer-events-none overflow-hidden" style="height: 90px;">
                        <svg class="absolute bottom-0 overflow-hidden" fill="#ffffff" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none" version="1.1" viewBox="0 0 2560 100" x="0" y="0">
                            <polygon points="2560 0 2560 100 0 100"></polygon>
                        </svg>
                    </div>
                </div>

                <label class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold mb-1">{{ __('Image de profile')}}</label>
                @error('avatar') <span class="block font-normal text-red-500 text-xs">{{ __($message) }}</span> @enderror
                <div class="flex flex-wrap mb-6 items-center justify-between">

                    <div class="flex-grow pr-2">
                        <div class='flex items-center justify-center w-full'>
                            <label class='flex flex-col border-4 border-dashed w-full hover:border-purple-300 group transition duration-300'>
                                <div class='flex items-center justify-center'>
                                    <svg class="w-10 h-10 text-purple-400 group-hover:text-purple-600 transition duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                    <p class='lowercase text-sm text-gray-400 group-hover:text-purple-600 pt-1 px-2 tracking-wider transition duration-300'>{{ __('Choisir une image')}}</p>
                                </div>
                                <input wire:model="avatar" type='file' class="hidden" />
                            </label>
                        </div>
                    </div>

                    @if ($avatar)
                    <div class="w-full mt-2 md:py-0 md:w-2/3 flex justify-around items-center">
                        <span class="text-gray-500">{{ $avatar->getClientOriginalName() }}</span> / <span class="text-gray-400 text-xs">{{ $avatar->getSize() }} &nbsp KB</span>
                        <svg wire:click="removeImage(1)" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#F87171" viewBox="0 0 16 16" class="cursor-pointer transition duration-300 ease-in-out trashIcon">
                            <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                            <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                        </svg>
                    </div>
                    @endif
                </div>

                <label class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold mb-1">{{ __('Image de couverture')}}</label>
                @error('coverture_photo') <span class="block font-normal text-red-500 text-xs">{{ __($message) }}</span> @enderror
                <div class="flex flex-wrap mb-6 items-center justify-between">
                    <div class="flex-grow pr-2">
                        <div class='flex items-center justify-center w-full'>
                            <label class='flex flex-col border-4 border-dashed w-full hover:border-purple-300 group transition duration-300'>
                                <div class='flex items-center justify-center'>
                                    <svg class="w-10 h-10 text-purple-400 group-hover:text-purple-600 transition duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                    <p class='lowercase text-sm text-gray-400 group-hover:text-purple-600 pt-1 px-2 tracking-wider transition duration-300'>{{ __('Choisir une image') }}</p>
                                </div>
                                <input wire:model="coverture_photo" type='file' class="hidden" />
                            </label>
                        </div>
                    </div>

                    @if ($coverture_photo)
                    <div class="w-2/3 flex justify-around items-center">
                        <span class="text-gray-500">{{ $coverture_photo->getClientOriginalName() }}</span> / <span class="text-gray-400 text-xs">{{ $coverture_photo->getSize() }} &nbsp KB</span>
                        <svg wire:click="removeImage(2)" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#F87171" viewBox="0 0 16 16" class="cursor-pointer transition duration-300 ease-in-out trashIcon">
                            <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                            <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                        </svg>
                    </div>
                    @endif

                </div>

            </div>

            @elseif( $currentPage === 4 )
            <div wire:key="page4">
                <div>
                    @if( $paymentProcess != 'seccessful' || $paymentProcess == 'unseccessful' )
                        <div class="w-full">
                            <div class="mb-2">
                                <label for="entry" class="block text-gray-700 text-sm lg:text-base font-semibold mb-2">
                                    {{ __('Nos plans') }}
                                </label>
                                @error('amountToPay') <span class="block font-normal text-red-500 text-xs">{{ __($message) }}</span> @enderror
                                
                                <div class="flex justify-center space-x-4 items-center w-full">
                                    <div class="inline-block radio">
                                        <input name="plan" type="radio" id="month" hidden="hidden" wire:model="amountToPay" value="10" />
                                        <label for="month" class="px-2 py-1 rounded-lg flex justify-center items-center text-sm font-bold w-32 h-14">
                                            {{ __('Mois')}}
                                        </label>
                                    </div>

                                    <div class="inline-block radio">
                                        <input name="plan" type="radio" id="fullLife" hidden="hidden" wire:model="amountToPay" value="25" />
                                        <label for="fullLife" class="px-2 py-1 rounded-lg flex justify-center items-center text-sm font-bold w-32 h-14">
                                            {{ __('Indéterminé') }}
                                        </label>
                                    </div>

                                    <div class="inline-block radio">
                                        <input name="plan" type="radio" id="year" hidden="hidden" wire:model="amountToPay" value="20" />                            
                                        <label for="year" class="px-2 py-1 rounded-lg flex justify-center items-center text-sm font-bold w-32 h-14">
                                            {{ __('Année') }}
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="flex justify-around items-center w-full px-2 py-1 mb-4">
                            <span class="input-label">{{ __('Prix d\'inscription') }}</span>
                            <span class="text-xl font-semibold">{{ $amountToPay }}$</span>
                        </div>
                        <div class="flex justify-center w-full -mt-4 mb-4">
                            <div class="w-48 h-1 bg-gray-200 rounded-full "></div>
                        </div>
                
                        <!-- @author: Hackcharms -->
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
                                    <button type="button" id="testTransaction" class="bg-purple-500 rounded-sm text-white py-1 px-4">{{ __('Tester la transaction') }}</button>
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
                </div>

                @error('paymentMethod') <span class="block font-normal text-red-500 text-xs">{{ __($message) }}</span> @enderror
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
                        * {{ __('En soumettant ce formulaire. Vous acceptez tous les termes et conditions') }}
                    </p>
                    <a href="#" target="_blank" class="text-sm font-normal m-0 text-purple-500 hover:text-purple-600 transition duration-300">{{ __('Lire les termes et conditions')}}</a>
                    
                </div>

                @endif

                <div class="flex items-center justify-between py-3 text-right">
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
                            <input required class="w-full shadow bg-purple-500 text-center hover:bg-purple-600 focus:shadow-outline focus:outline-none text-white font-bold py-1 px-8 cursor-pointer rounded-md transition duration-300" type="submit" value="{{__('S\'inscrire')}}" />
                        </div>
                    </div>
                    @else
                    <div>
                        <button type="button" wire:click="goNext" class="bg-purple-500 py-1 px-6 text-white rounded-md hover:bg-purple-600 transition duration-300 ease-in-out">{{ __('Ensuite') }}</button>
                    </div>
                    @endif
                </div>
            </div>
        </form>
    </div>
    
    <div wire:loading.flex wire:target="save" class="fixed top-0 w-full h-screen flex justify-center items-center" style="background-color: rgba(249, 250, 251,.8);">
        <div class="bg-purple-300 shadow-lg z-50 overflow-hidden w-96 h-96 rounded-lg flex flex-col items-center justify-center">
            <svg class="animate-spin mb-10" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 4335 4335" width="80" height="80">
                <path fill="#ffffff" d="M3346 1077c41,0 75,34 75,75 0,41 -34,75 -75,75 -41,0 -75,-34 -75,-75 0,-41 34,-75 75,-75zm-1198 -824c193,0 349,156 349,349 0,193 -156,349 -349,349 -193,0 -349,-156 -349,-349 0,-193 156,-349 349,-349zm-1116 546c151,0 274,123 274,274 0,151 -123,274 -274,274 -151,0 -274,-123 -274,-274 0,-151 123,-274 274,-274zm-500 1189c134,0 243,109 243,243 0,134 -109,243 -243,243 -134,0 -243,-109 -243,-243 0,-134 109,-243 243,-243zm500 1223c121,0 218,98 218,218 0,121 -98,218 -218,218 -121,0 -218,-98 -218,-218 0,-121 98,-218 218,-218zm1116 434c110,0 200,89 200,200 0,110 -89,200 -200,200 -110,0 -200,-89 -200,-200 0,-110 89,-200 200,-200zm1145 -434c81,0 147,66 147,147 0,81 -66,147 -147,147 -81,0 -147,-66 -147,-147 0,-81 66,-147 147,-147zm459 -1098c65,0 119,53 119,119 0,65 -53,119 -119,119 -65,0 -119,-53 -119,-119 0,-65 53,-119 119,-119z" />
            </svg>
            <h2 class="text-center text-white text-xl font-bold">{{__('Chargement')}}...</h2>
            <p class="text-center text-white text-sm px-10 py-4">{{__('Ça va prendre quelque secondes')}} , {{__('merci de ne pas fermer la page')}}.</p>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://js.braintreegateway.com/web/dropin/1.13.0/js/dropin.min.js"></script>

</div>
