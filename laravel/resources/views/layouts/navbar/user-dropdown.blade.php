<li class="nav-item dropdown d-flex align-items-center">
    <a id="navbarDropdown"
       class="nav-link dropdown-toggle text-{{ $debug_text_color }} hover-background d-flex align-items-center rounded"
       href="#"
       role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <span class="me-1">{{ Auth::user()->name }}</span>
    </a>
    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
        <a class="dropdown-item hover-link" href="{{ route('logout') }}"
           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            {{ __('Logout') }}
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
    </div>
</li>
