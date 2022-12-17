@extends('partials.admin-panel.actions')
@section('title', 'تحديث العرض')
@section('content')
    @livewire('edit-offer', ['offer_id' => $offer->id])
@endsection
