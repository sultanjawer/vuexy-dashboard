@extends('partials.admin-panel.layout')
@section('title', 'صفقة البيع')
@section('content')
    @livewire('sale-view', ['sale_id' => $sale->id])
@endsection
