
@component('mail::message')

<div style="background-color:#8B5CF6;display:flex;justify-content:center;width:100%;align-items:center;border-radius:10px;padding:10px 0;">
    <img src="{{ asset('images/logowhite2.svg') }}" alt="{{ config('app.name') }}-Logo" style="width: 30px;"> 
    <span style="color:white;font-size:30px;"> RT Certification </span> 
</div>
<br> 

# {{ __('Demande de certificat')}}

{{ __('Salut') }}, {{ $demande->prenom }}  
{{ __('Votre demande est bien enregistrées') }}


@if($paymentMethod == 'face a face')
{{ __('Les frais de demande de certification est ').$amountToPay.' $' }}<br>
{{ __('Vous avez choisis ').$paymentMethod.__(' comme méthode de paiement') }}
@endif

@if($paymentMethod == 'Paypal ou Card')
{{ __('Les frais de demande de certification est ').$amountToPay.' $' }}<br>
{{ __('Votre paiement est passé avec succès en utilisant ').$paymentMethod }}
@endif

@component('mail::panel')
{{ __('L\'artist')}} {{ $demande->nom_artist}}, 
{{__('va vous contacter le plus tôt possible pour recevoir la réponse à propos de la certification de l\'oeuvre')}} 
{{ $demande->titre_oeuvre }}
@endcomponent

{{ __('Merci,')}} <br>
{{ config('app.name') }}

@endcomponent
