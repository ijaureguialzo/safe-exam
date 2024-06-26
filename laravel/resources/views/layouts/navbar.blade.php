@php($debug_text_color = config('app.debug') ? 'dark' : 'light')
@php($debug_navbar_color = config('app.debug') ? 'navbar-light bg-warning' : 'navbar-dark bg-dark')

<nav class="navbar navbar-expand-md {{ $debug_navbar_color }} shadow-sm">
    <a class="navbar-brand text-{{ $debug_text_color }} m-0 text-start ps-3 text-md-center ps-md-0 hover-link"
       style="width: 15rem;"
       href="{{ route('home') }}">
        {{ config('app.name', 'Laravel') }}
    </a>
    <button class="navbar-toggler border-0" type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
            aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
        <i class="bi bi-list text-{{ $debug_text_color }}"></i>
    </button>
    <div class="collapse navbar-collapse mx-3" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto"></ul>
        <ul class="navbar-nav ms-auto">
            @guest
                @if(config('auth.registration_enabled'))
                    @include('layouts.navbar.register')
                    @include('layouts.navbar.navbar-separator')
                @endif
            @endguest
            @include('layouts.navbar.language-selector')
            @include('layouts.navbar.navbar-separator')
            @auth
                @include('layouts.navbar.user-dropdown')
                @include('layouts.navbar.navbar-separator')
            @endauth
            @include('layouts.navbar.theme-selector')
        </ul>
    </div>
</nav>
