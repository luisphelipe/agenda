<nav id="left-navbar" class="navbar navbar-expand-md navbar-light navbar-laravel">
    <div class="container mt-4">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/') }}">{{ config('app.name', 'Laravel') }}</a> 
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('schedules.index') }}">{{ __('Agendamentos') }}</a> 
                </li>
            </ul>

      
        </div>
    </div>
</nav>