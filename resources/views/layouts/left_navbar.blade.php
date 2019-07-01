<nav id="left-navbar">
    <div class="container mt-4">
        <img id="burg-close" onclick="toggleNavbar()" src="{{ URL::to('/') }}/burg_close.jpg" alt="close NAV" class="mr-3 active">
        <ul class="navbar-nav w-100">
            <div>
                <?php $current_uri = explode('/', \Request::route()->uri)[0] ?>

                <li class="nav-item">
                    <a class="nav-link {{ $current_uri == 'home' ? 'active-nav-link' : ''}}" href="{{ url('/') }}">{{ __('Inicio') }}</a> 
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ $current_uri == 'schedules' ? 'active-nav-link' : ''}}" href="{{ route('schedules.index') }}">{{ __('Agendamentos') }}</a> 
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ $current_uri == 'services' ? 'active-nav-link' : ''}}" href="{{ route('services.index') }}">{{ __('Serviços') }}</a> 
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ $current_uri == 'reminders' ? 'active-nav-link' : ''}}" href="{{ route('reminders.index') }}">{{ __('Lembretes') }}</a> 
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ $current_uri == 'payments' ? 'active-nav-link' : ''}}" href="{{ route('payments.index') }}">{{ __('Pagamentos') }}</a> 
                </li>
            </div>
            <div id="lower-nav-links">
                @yield('custom-links')
            </div>
        </ul>
    </div>
</nav>