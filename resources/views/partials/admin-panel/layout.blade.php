@include('partials.admin-panel.header')
@livewireStyles()
@include('partials.admin-panel.navbar')
@auth
    @if (auth()->user()->user_status == 'active')
        @include('partials.admin-panel.sidebar')
    @endif
@endauth
@yield('content')
@livewireScripts()
@include('partials.admin-panel.footer')
