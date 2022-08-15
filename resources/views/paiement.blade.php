@extends('layouts.app')

@section('title','renouvlement d\'abonnement')

@section('content')
    @livewire('paiement',['artist'=>$artist])
@endsection