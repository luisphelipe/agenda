<script>
    function toggleNavbar() {
        const leftNavbar = document.getElementById("left-navbar-wrapper"),
            topNavbar = document.getElementById("excluding-sidebar"),
            burgClose = document.getElementById("burg-close");

        leftNavbar.classList.toggle('hidden');
        topNavbar.classList.toggle('expanded');
        burgClose.classList.toggle('active');

        // console.log(leftNavbar.className !== 'hidden');
        sessionStorage.setItem('navbarStatus', leftNavbar.className);

    }

    const mobileClient = document.documentElement.clientWidth < 700;

    if (sessionStorage.getItem('navbarStatus') === 'hidden' || mobileClient) {
        toggleNavbar();
    }
</script>

<nav id="top-navbar" class="navbar navbar-expand-md navbar-light navbar-laravel">
    <div class="container">
        <div onclick="toggleNavbar()" id="burg-container">
            <img id="burg" src="{{ URL::to('/') }}/burg_icon.png" alt="NAV" class="mr-3">
        </div>
        <a class="navbar-brand" href="{{ url('/') }}">
            {{ config('app.name', 'Laravel') }}
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
