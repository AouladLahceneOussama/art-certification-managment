<div>
    <style>
        .radio input + label {
            background-color: #F3F4F6;
            color: black;
            cursor: pointer;
            transition: .3s ease-in-out;
        }

        .radio input:hover + label {
            background-color: #E5E7EB;
        }

        .radio input:checked + label {
            background-color: #8B5CF6;
            color: white;
        }

        [data-braintree-id="choose-a-way-to-pay"] {
            display: none;
        }
    </style>

    <div class="mb-10 py-4 px-4 md:px-10 flex justify-between items-center w-full bg-purple-500 shadow-lg">
        <div class="flex justify-start items-center">
            <div class="flex justify-center items-center">
                <img class="h-10 w-auto" src="/images/logowhite2.svg" alt="logo">
            </div>
            <h1 class="text-2xl font-semibold text-white" style="font-family: Raleway-Light;">RT Certification</h1>
        </div>

        <h1 class="text-md md:text-2xl text-center text-white"> {{ __('Renouvellement d\'abonnement') }}</h1>
    </div>

    <div class="px-10 pb-10 md:pb-0 md:px-0 w-full min-h-screen flex flex-col md:flex-row justify-center items-center space-x-0 md:space-x-6">
        
        <img src="/images/payment.jpg" alt="paiement-Renouvellement-d'abonnement" style="width: 600px;">
        
        <form wire:submit.prevent="renewSubscription" class="bg-gray-50 rounded shadow-lg p-4">
            <div>
                <div>
                    <h1 class="text-xl mb-2 font-semibold" style="font-family: AtkinsonHyperlegible;">{{ __('Bonjour') }},<span class="ml-2">{{ $artist->LastName.' '.$artist->FirstName }}</span> </h1>
                    <p class="text-md ">{{ __('Votre dernier abonnement était').' '.__($artist->abonnement->plan) }} ( {{ $artist->abonnement->frais_plan}}$ ) </p>
                    <p class="text-md mb-4 "> {{ __('Vous avez utilise comme methode de paiement')}} {{ $artist->abonnement->method_paiement}} </p>
                </div>    
                
                <div>
                    @if( $paymentProcess != 'seccessful' || $paymentProcess == 'unseccessful' )
                    <div class="w-full">
                        <div class="mb-2">
                            <label for="entry" class="block text-gray-700 text-sm lg:text-base font-semibold mb-2">
                                {{ __('Veuillez choisir votre nouvelle plan') }}
                            </label>
                            @error('amountToPay') <span class="block text-red-500 text-xs">{{ $message }}</span> @enderror

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
                        <span class="text-xl font-semibold">{{ $amountToPay ?? $artist->abonnement->frais_plan}}$</span>
                    </div>
                    <div class="flex justify-center w-full -mt-4 mb-4">
                        <div class="w-48 h-1 bg-gray-200 rounded-full "></div>
                    </div>

                    <!-- @author: Hackcharms -->
                    <style>
                        input:checked + .radio {
                            color: white;
                            background-color: #8B5CF6;
                        }
                    </style>

                    <div class="flex justify-center items-center space-x-2">
                        <div class="rounded-lg">
                            <div class="inline-flex rounded-lg">
                                <input type="radio" id="faceToFace" name="paiment" wire:model="paymentMethod" value="face a face" hidden />
                                <label for="faceToFace" class="radio text-center self-center py-2 px-4 bg-gray-200 rounded cursor-pointer font-normal hover:opacity-75 duration-300 ease-in-out">{{ __('Face à face')}}</label>
                            </div>
                            <div class="inline-flex rounded-lg">
                                <input type="radio" id="paypalOrCard" name="paiment" wire:model="paymentMethod" value="Paypal ou Card" hidden />
                                <label for="paypalOrCard" class="radio text-center self-center py-2 px-4 bg-gray-200 rounded cursor-pointer font-normal hover:opacity-75 duration-300 ease-in-out">{{ __('PayPal ou Carte bancaire') }}</label>
                            </div>
                        </div>
                    </div>

                    <div>
                        @if( $paymentMethod === "face a face")
                            <div class="px-6 py-2 max-w-lg">
                                <span class="text-red-400 text-xs"> * {{ __('Cette méthode est disponible si vous etes au Tetouan,Maroc') }} </span>
                                <p>{{ __('L\'admin va vous contacter le plus tot possible pour finalisez votre paiment.') }}</p>
                            </div>
                        @endif
                    </div>

                    <div>
                        @if( $paymentMethod === "Paypal ou Card" )
                            <div wire:ignore class="px-6 py-1 max-w-lg">

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
                                            btn.addEventListener('click', function() {
                                                btn.disabled = true;
                                                btn.classList.add('hidden');

                                                instance.requestPaymentMethod(function(err, payload) {
                                                    if (err) {
                                                        console.log('Request Payment Method Error ', err);
                                                        btn.disabled = false;
                                                        btn.classList.remove('hidden');
                                                        return;
                                                    }

                                                    if (payload.type === 'validation:failed') {
                                                        btn.disabled = false;
                                                        btn.classList.remove('hidden');
                                                    }

                                                    @this.set('payment_method_nonce', payload.nonce);
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

                @error('paymentMethod') <span class="block text-red-500 text-xs">{{ $message }}</span> @enderror
                <div class="w-96">
                    @if ( $success != '' )
                    <div class="bg-green-300 text-green-500 font-normal px-4 py-6 my-4 rounded-lg text-left">
                        <h1 class="uppercase">{{ __('Rapport de paiement') }}</h1>
                        <div class="w-32 h-1 rounded-full bg-green-500 mb-4"></div>
                        {!! $success !!}
                    </div>
                    @endif
                </div>

                <div class="w-96">
                    @if(session()->has('error_message'))
                    <div class="bg-red-300 text-red-500 font-semibold px-4 py-2 rounded-lg text-center">
                        {!! session('error_message') !!}
                    </div>
                    @endif
                </div>

                <input required class="w-full shadow bg-purple-500 text-center hover:bg-purple-600 focus:shadow-outline focus:outline-none text-white font-bold py-1 px-8 cursor-pointer rounded-md transition duration-300 mt-4" type="submit" value="{{__('Renouveler abonnement')}}" />
            </div>
        </form>
    </div>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://js.braintreegateway.com/web/dropin/1.13.0/js/dropin.min.js"></script>
</div>