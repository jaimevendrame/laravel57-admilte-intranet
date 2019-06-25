@extends('adminlte::page-no-sidebar')

{{--@extends('layouts.app')--}}
{{--@extends('adminlte::passwords.email')--}}
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"><h2><b>{{ __('Verifição de endereço de e-mail') }}</b></h2></div>

                    <div class="card-body">
                        @if (session('resent'))
                            <div class="alert alert-success" role="alert">
                                <h3>{{ __('Um link de verificação foi enviado para o seu endereço de e-mail ') }} <strong>{{ Auth::user()->email }}</strong></h3>
                            </div>
                        @endif

                        <h3>{{ __('Antes de prosseguir, precisamos verificar seu endereços de e-mail.') }}</br>
{{--                        {{ __('Se você não recebeu o email') }}, <a href="{{ route('verification.resend') }}"><strong>{{ __('clique aqui para solicitar a verificação') }}</strong></a>.</h3>--}}
                            <a href="{{ route('verification.resend') }}"><strong>{{ __('Clique aqui') }}</strong></a>
                            {{ __('para solicitar a verificação de e-mail') }}.</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

