@extends('layouts.app')

@section('title','Verification Email')

<div class="py-4 px-4 md:px-10 flex justify-between items-center w-full bg-purple-500 shadow-lg">
        <div class="flex justify-start items-center">
            <div class="flex justify-center items-center">
                <img class="h-10 w-auto" src="/images/logowhite2.svg" alt="logo">
            </div>
            <h1 class="text-2xl font-semibold text-white" style="font-family: Raleway-Light;">RT Certification</h1>
        </div>

        <h1 class="text-md md:text-2xl text-center text-white"> {{ __('Vérification d\'email') }}</h1>
    
    </div>

@section('content')
    <div class="container flex flex-col md:flex-row min-h-full justify-center items-center mx-auto">
        <div class="py-10 px-5 bg-white">
            <div class="text-left">
                <img class="h-8 w-auto sm:h-10" src="/images/logoPurple2.svg" alt="Art-certification-logo">
                <p class="text-3xl md:text-5xl text-purple-600 uppercase mt-4" style="font-family: Raleway-Light;">Art certification</p>
                <div class="w-60 h-1 rounded-xl my-2 bg-purple-500 mb-6"></div>

                @if(!$emailVerified)
                    <h1 class="font-normal text-xl font-semibold text-grey-800 leading-loose my-3 w-full" style="font-family: Raleway-Light;">
                        {{ __('Un email d\'activation est envoye sur votre adresse email') }}
                    </h1>
                    <p class="text-gray-500 text-xs -mt-4 mb-10">
                        {{ __('Rendez-vous sur votre messagerie') }}
                    </p>
                    <a href="/mail/verify/{{ $alias }}/resend" class="text-white bg-purple-500 py-2 px-4 rounded uppercase font-semibold hover:bg-purple-600 transition duration-300 ease-in-out">
                        {{ __('Cliquer ici pour renvoyer l\'email')}}
                    </a>
                @else
                    <h1 class="font-normal text-xl font-semibold text-grey-800 leading-loose my-3 w-full" style="font-family: Raleway-Light;">
                        {{ __('Votre email est verifiee, merci d\'etre parmi nous') }}
                    </h1>
                    <i class="far fa-smile-wink -mt-4" style="font-size: 30px;"> </i>
                @endif
            </div>
        </div>
        <img src="https://sleekbundle.com/wp-content/uploads/2020/10/16-Email-Newsletter-01-1250x938.png" style="width: 500px;">

    </div>
@endsection
