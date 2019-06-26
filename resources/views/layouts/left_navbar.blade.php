<nav id="left-navbar">
    <div class="container mt-4">
        <ul class="navbar-nav mr-auto">
            <div>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/') }}">{{ __('Inicio') }}</a> 
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('schedules.index') }}">{{ __('Agendamentos') }}</a> 
                </li>
            </div>
            <div id="lower-nav-links">
                @yield('custom-links')
            </div>
        </ul>
    </div>
</nav>