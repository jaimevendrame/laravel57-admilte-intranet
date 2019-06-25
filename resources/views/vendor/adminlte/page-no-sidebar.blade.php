@extends('adminlte::master')

@section('adminlte_css')
    <link rel="stylesheet"
          href="{{ asset('vendor/adminlte/dist/css/skins/skin-' . config('adminlte.skin', 'blue') . '.min.css')}} ">
    @stack('css')
    @yield('css')
@stop

{{--@section('body_class', 'skin-' . config('adminlte.skin', 'blue') . ' sidebar-mini ' . (config('adminlte.layout') ? [--}}
{{--    'boxed' => 'layout-boxed',--}}
{{--    'fixed' => 'fixed',--}}
{{--    'top-nav' => 'layout-top-nav'--}}
{{--][config('adminlte.layout')] : '') . (config('adminlte.collapse_sidebar') ? ' sidebar-collapse ' : ''))--}}

@section('body')
    <div class="wrapper">

        <!-- Main Header -->
        <header class="main-header">

            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <!-- Navbar Right Menu -->
                <div class="navbar-custom-menu">

                    <ul class="nav navbar-nav">
                        <li class="dropdown">
                        @if(config('adminlte.logout_method') == 'GET' || !config('adminlte.logout_method') && version_compare(\Illuminate\Foundation\Application::VERSION, '5.3.0', '<'))
                                <a href="{{ url(config('adminlte.logout_url', 'auth/logout')) }}">
                                    <i class="fa fa-fw fa-power-off"></i> {{ trans('adminlte::adminlte.log_out') }}
                                </a>
                            @else
                                @if(Auth::check())
{{--                                    {{ Auth::user()->name }}--}}
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                    @if( auth()->user()->image != '' && file_exists(public_path('assets/uploads/users/'. auth()->user()->image)))
                                    <img src="{{URL::asset('/assets/uploads/users/'. auth()->user()->image)}}" alt="{{ auth()->user()->name}}" class="user-image img-circle img-responsive">
                                    {{auth()->user()->name}} <span class="caret"></span></a>
                                    @else
                                    <img src="{{URL::asset('/assets/uploads/users/no-image.png')}}" alt="{{ auth()->user()->name}}" class="user-image img-circle img-responsive">
                                    {{auth()->user()->name}} <span class="caret"></span></a>
                                    @endif
                                @endif

                            <ul class="dropdown-menu user-body">
                                <li>
                                    <a href="{{ url(config('adminlte.logout_url', 'auth/logout')) }}"> <i class="fa fa-fw fa-power-off"></i> {{ trans('adminlte::adminlte.log_out') }} </a>
                                </li>
                            </ul>

                        </li>
                        @endif
                    </ul>
                </div>

            </nav>
        </header>


        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper" style="margin-left: 0px !important;">

{{--            <!-- Content Header (Page header) -->--}}
{{--            <section class="content-header">--}}
{{--                @section('content_header')--}}
{{--                    <div class="container">--}}
{{--                        <div class="row">--}}
{{--                            <div class="col-md-2 col-sm-12">--}}
{{--                                <img src="{{URL::asset('/assets/painel/img/brasao_campomourao.png')}}" alt="" class="img-responsive center-block" >--}}
{{--                            </div>--}}
{{--                            <div class="col-md-10 col-sm-12">--}}
{{--                                <p class="text-left"><h1>Câmara Municipal de Campo Mourão - PR</h1></p>--}}
{{--                                <p><h3>Banco de Ideias</h3></p>--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                    </div>--}}
{{--                @stop--}}
{{--            </section>--}}

            <!-- Main content -->
            <section class="content">
                <div class="container">
                    @yield('content')
                </div>

            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

    </div>
    <!-- ./wrapper -->
@stop

@section('adminlte_js')
    <script src="{{ asset('vendor/adminlte/dist/js/adminlte.min.js') }}"></script>
    @stack('js')
    @yield('js')
@stop
