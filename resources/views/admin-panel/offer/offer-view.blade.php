@extends('partials.admin-panel.layout')
@section('title', 'العرض')
@section('content')
    @livewire('offer-view', ['offer_id' => $offer->id])
@endsection
