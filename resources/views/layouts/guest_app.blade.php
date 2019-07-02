<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Agenda') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <style>
        body {
            background-image: url('{{ URL::to('/') }}/welcome_background.jpg');
            background-size: cover;
            background-position: center;
        }

        #register-form *>label,
        #login-form *>label {
            margin-top: 0;
        }
                
        #app-name {
            position: absolute; 
            top: 10%; 
        }

        @media(max-width: 760px) {
            #app-name {
                top: 30%
            }

            #login-card {
                margin-top: 20%
            }
        }
    </style>
</head>

<body>
    <div id="app">
        <div style="padding: 0px">
            @include('layouts.top_navbar')

            <main class="py-4">
                @yield('content')
            </main>
        </div>
    </div>
</body>

</html>