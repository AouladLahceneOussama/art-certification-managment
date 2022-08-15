@component('mail::message')

<div style="background-color:#8B5CF6;display:flex;justify-content:center;width:100%;align-items:center;border-radius:10px;padding:10px 0;">
    <img src="{{ asset('images/logowhite2.svg') }}" alt="{{ config('app.name') }}-Logo" style="width: 30px;"> 
    <span style="color:white;font-size:30px;"> RT Certification </span> 
</div>
<br>

# {{ __('Email de validation d\'inscription')}}
{{ $name }},<br>
{{ __('Merci beaucoup d\'avoir rejoint Art-certification !')}}

{{ __('Votre compte a été créé,
il vous suffit de cliquer sur le bouton au-dessous pour valider votre adresse email')}}

@component('mail::panel')
{{ __('Le plan d\'inscription que vous avez choisis est').' '.$plan.__(' son prix est').' '.$amountToPay."$"}}
@endcomponent

@if($paymentMethod === 'Paypal ou Card')
## {{ __('Votre paiement est passé avec succès en utilisant la méthode Paypal ou Card. Votre compte est activée il suffit de verifier votre email pour finaliser le traitement') }}
@endif

@if($paymentMethod === 'face a face')
## {{ __('Vous avez choisis comme méthode de paiement face à face. Le responsable va vous contacter le plus tôt possible pour effectuer votre paiement et activer votre compte') }}   
@endif

@component('mail::button', ['url' => $url])
{{ __('Verifier votre email') }}
@endcomponent

{{ __('Merci encore d\'avoir rejoint Art-certification !')}}

{{ __('L\'équipe Art-certification')}}

P.S: <br>
- {{ __('Il faut verifier votre email dans tout les cas.') }}<br>
- {{ __('Si votre email ne prend pas en charge les liens HTML, veuillez copier et coller cette URL dans votre navigateur pour activer votre compte ')}}<br>
- ## {{ $url }}

<hr>

{{ __('S\'il vous plaît laissez-nous savoir si nous pouvons vous aider de quelque manière que ce soit!')}}

{{ __('merci')}},<br>
{{ config('app.name') }}
@endcomponent
