<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Câmara Municipal de Campo Mourão - PR</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Bootstrap 3.3.7 -->
        <link rel="stylesheet" href="{{ asset('vendor/adminlte/vendor/bootstrap/dist/css/bootstrap.min.css') }}">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="{{ asset('vendor/adminlte/vendor/font-awesome/css/font-awesome.min.css') }}">
        <!-- Ionicons -->
        <link rel="stylesheet" href="{{ asset('vendor/adminlte/vendor/Ionicons/css/ionicons.min.css') }}">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
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
                font-size: 36px;
            }

            /*.links > a {*/
            /*    color: #ffffff;*/
            /*    padding: 0 25px;*/
            /*    font-size: 25px;*/
            /*    font-weight: 600;*/
            /*    letter-spacing: .1rem;*/
            /*    text-decoration: none;*/
            /*    text-transform: uppercase;*/
            /*}*/

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
{{--                <div class="top-right links">--}}
{{--                    @auth--}}
{{--                        <a href="{{ url('/home') }}">Home</a>--}}
{{--                    @else--}}
{{--                        <a href="{{ route('login') }}" class="btn btn-warning"><strong>Login</strong></a>--}}
{{--                        <a href="{{ route('register') }}" class="btn btn-success"><strong>Registrar-se</strong></a>--}}
{{--                    @endauth--}}
{{--                </div>--}}
            @endif

            <div class="content">
                <div class="title m-b-md">
                    <img src="{{URL::asset('/assets/painel/img/brasao_campomourao.png')}}" alt="" class="img-responsive center-block" >

                    <strong>Câmara Municipal de Campo Mourão - PR</strong>
                   <p>Portal da Intranet</p>
                </div>

                <div class="links">
                    <a href="{{ route('ideas-public.index') }}" class="btn btn-success btn-lg"><strong>Banco de Ideias</strong></a>
                    <a href="{{ route('sumulas.index') }}" class="btn btn-warning btn-lg"><strong>SIS-Súmulas</strong></a>
                    <a href="{{ route('home.painel') }}" class="btn btn-primary btn-lg"><strong>CotecSGL</strong></a>
{{--                    <a href="https://forge.laravel.com" class="btn btn-primary btn-lg">Forge</a>--}}
{{--                    <a href="https://github.com/laravel/laravel" class="btn btn-primary btn-lg">GitHub</a>--}}
                </div>
            </div>
        </div>
    </body>
</html>
