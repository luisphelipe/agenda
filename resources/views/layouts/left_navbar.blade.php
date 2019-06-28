<nav id="left-navbar">
    <div class="container mt-4">
        <img id="burg-close" onclick="toggleNavbar()" src="{{ URL::to('/') }}/burg_close.jpg" alt="close NAV" class="mr-3 active">
        <ul class="navbar-nav w-100">
            <div>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/') }}">{{ __('Inicio') }}</a> 
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('schedules.index') }}">{{ __('Agendamentos') }}</a> 
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('reminders.index') }}">{{ __('Lembretes') }}</a> 
                </li>
            </div>
            <div id="lower-nav-links">
                @yield('custom-links')
            </div>
        </ul>
    </div>
</nav>