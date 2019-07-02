<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Agenda</title>

        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            body {
                background-image: url('{{ URL::to('/') }}/welcome_background.jpg');
                background-size: cover;
                background-position: center;
            }
            
            #app-name {
                position: absolute; 
                top: 10%; 
            }

            #app-name>h1 {
                font-size: 10rem;
            }

            @media(max-width: 760px) {
                #app-name {
                    top: 30%
                }

                #app-name>h1 {
                    font-size: 5rem;
                }
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Entrar</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Registrar</a>
                        @endif
                    @endauth
                </div>
            @endif

        <div id="app-name">
            <h1>
                Agenda
            </h1>
        </div>

        </div>
    </body>
</html>
