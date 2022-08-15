<div class="w-full flex flex-col lg:flex-row justify-center space-x-0 space-y-3 lg:space-y-0 lg:space-x-3 items-start mt-4">
  
  <div class="bg-gray-200 h-48 shadow-inner rounded-lg px-6 w-full lg:w-1/3">
      <div class="uppercase font-semibold pt-6">
          <h1>{{ __('Rechercher un certificat') }}</h1>
      </div>
      <div class="w-48 h-1 bg-gray-100 rounded-full mb-6"></div>
      <h1 class="font-light">
        {{ __('Veuillez remplir ce formulaire, Tout les champs sont obligatoires') }}
        <br>{{ __('Vous devez disposer d\'un code ecrit sur les certificat pour tester la validite de votre certificat') }}
      </h1>
  </div>
  
  <form wire:submit.prevent="save" class="bg-white p-10 rounded-lg shadow-lg w-full lg:w-2/3">
    <div>
        @if (session()->has('noCertificat'))
            <div class="w-full py-2 bg-red-300 text-xs text-red-600 px-4 rounded text-center mb-4">
                {{ session('noCertificat') }}
            </div>
        @endif
    </div>
    <h1 class="font-bold text-center border-b-2 mb-6 pb-2 uppercase">{{__('Rechercher certificat par code')}}</h1>
    
    <div class="mb-4 md:flex md:justify-between">
      <div class="w-full mb-4 md:mr-2 md:mb-0">
        <label class="block mb-2 text-sm font-bold text-gray-700" for="nom">
          {{__('Nom')}}
        </label>
        <input required wire:model="nom" class="w-full px-3 py-2 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline" id="nom" type="text" placeholder="Doe" />
        @error('nom') <span class="block text-red-500 text-xs ">{{ __($message) }}</span> @enderror
      </div>

      <div class="w-full md:ml-2">
        <label class="block mb-2 text-sm font-bold text-gray-700" for="prenom">
          {{__('Prénom')}}
        </label>
        <input required wire:model="prenom" class="w-full px-3 py-2 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline" id="prenom" type="text" placeholder="Jhon" />
        @error('prenom') <span class="block text-red-500 text-xs ">{{ __($message) }}</span>@enderror
      </div>
    </div>

    <div class="mb-4 md:flex md:justify-between">
      <div class="w-full mb-4 md:mr-2 md:mb-0">
        <label class="block mb-2 text-sm font-bold text-gray-700" for="email">
          {{__('Email')}}
        </label>
        <input required wire:model="email" class="w-full px-3 py-2 mb-1 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline" id="email" type="email" placeholder="JhonDoe@example.com" />
        @error('email') <span class="block text-red-500 text-xs ">{{ __($message) }}</span> @enderror
      </div>

      <div class="w-full md:ml-2">
        <label class="block mb-2 text-sm font-bold text-gray-700" for="telephone">
          {{__('Téléphone')}}
        </label>
        <input required wire:model="telephone" class="w-full px-3 py-2 mb-1 text-sm text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline" id="telephone" type="text" placeholder="062342341" />
        @error('telephone') <span class="block text-red-500 text-xs ">{{ __($message) }}</span>@enderror
      </div>

    </div>

    <div class="mb-4 w-full">
      <div class="mb-4 md:mr-2 md:mb-0">
        <label class="block mb-2 text-sm font-bold text-gray-700" for="code">
          {{ __('Code de certificat')}}
        </label>
        <input required wire:model="code_certificat" class="w-full px-3 py-2 mb-1 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline" id="code" type="text" placeholder="{{ __('Code de certificat')}}" />
        @error('code') <span class="block text-red-500 text-xs ">{{ __($message) }}</span> @enderror

      </div>
    </div>

    <div class="w-full flex justify-end mt-8">
      <button class="bg-purple-500 px-8 py-2 rounded-lg text-white uppercase font-semibold text-md hover:bg-purple-600 transtion duration-300" type="submit">{{ __('Chercher') }}</button>
    </div>
  </form>

  
</div>