@extends('partials.admin-panel.layout')
@section('title', 'المستخدم')
@section('content')
    @livewire('user-view', ['user_id' => $user->id])
@endsection
