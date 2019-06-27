@extends('adminlte::master')

@section('adminlte_css')
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/css/auth.css') }}">
    @yield('css')
@stop

@section('body_class', 'register-page')

@section('body')


    <div class="register-box">
        <div class="register-logo">
            <a href="{{ url(config('adminlte.dashboard_url', 'home')) }}">{!! config('adminlte.logo', '<b>Admin</b>LTE') !!}</a>
            texto

        </div>

        <div class="register-box-body">

            <p class="login-box-msg">{{ trans('adminlte::adminlte.register_message') }}</p>
            <form action="{{ url(config('adminlte.register_url', 'register')) }}" method="post">
                {!! csrf_field() !!}

                <div class="form-group has-feedback {{ $errors->has('name') ? 'has-error' : '' }}">
                    <label for="InputName">{{ trans('adminlte::adminlte.name') }}</label>
                    <input id="InputName" type="text" name="name" class="form-control" value="{{ old('name') }}"
                           placeholder="{{ trans('adminlte::adminlte.name') }}">
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                    @if ($errors->has('name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group has-feedback {{ $errors->has('last_name') ? 'has-error' : '' }}">
                    <label for="InputLastName">{{ trans('adminlte::adminlte.last_name') }}</label>
                    <input id="InputLastName" type="text" name="last_name" class="form-control" value="{{ old('last_name') }}"
                           placeholder="{{ trans('adminlte::adminlte.last_name') }}">
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                    @if ($errors->has('last_name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('last_name') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group has-feedback {{ $errors->has('email') ? 'has-error' : '' }}">
                    <label for="InputEmail">{{ trans('adminlte::adminlte.email') }}</label>
                    <input id="InputEmail" type="email" name="email" class="form-control" value="{{ old('email') }}"
                           placeholder="{{ trans('adminlte::adminlte.email') }}">
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group has-feedback {{ $errors->has('password') ? 'has-error' : '' }}">
                    <label for="InputPassword">{{ trans('adminlte::adminlte.password') }}</label>
                    <input id="InputPassword" type="password" name="password" class="form-control"
                           placeholder="{{ trans('adminlte::adminlte.password') }}">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group has-feedback {{ $errors->has('password_confirmation') ? 'has-error' : '' }}">
                    <label for="InputRetryPassword">{{ trans('adminlte::adminlte.retype_password') }}</label>
                    <input id="InputRetryPassword" type="password" name="password_confirmation" class="form-control"
                           placeholder="{{ trans('adminlte::adminlte.retype_password') }}">
                    <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
                    @if ($errors->has('password_confirmation'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group has-feedback {{ $errors->has('rg') ? 'has-error' : '' }}">
                    <label for="InputRG">{{ trans('adminlte::adminlte.rg') }}</label>
                    <input id="InputRG" type="text" name="rg" class="form-control" value="{{ old('rg') }}"
                           placeholder="{{ trans('adminlte::adminlte.rg') }}">
                    <span class="glyphicon glyphicon-credit-card form-control-feedback"></span>
                    @if ($errors->has('rg'))
                        <span class="help-block">
                            <strong>{{ $errors->first('rg') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group has-feedback {{ $errors->has('cpf') ? 'has-error' : '' }}">
                    <label for="InputCPF">{{ trans('adminlte::adminlte.cpf') }}</label>
                    <input id="InputCPF" type="text" name="rg" class="form-control cpf" value="{{ old('cpf') }}"
                           placeholder="{{ trans('adminlte::adminlte.cpf') }}">
                    <span class="glyphicon glyphicon-credit-card form-control-feedback"></span>
                    @if ($errors->has('cpf'))
                        <span class="help-block">
                            <strong>{{ $errors->first('cpf') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group has-feedback {{ $errors->has('birth_date') ? 'has-error' : '' }}">
                    <label for="InputBirth">{{ trans('adminlte::adminlte.birth_date') }}</label>
                    <input id="InputBirth" type="date" name="rg" class="form-control" value="{{ old('birth_date') }}"
                           placeholder="{{ trans('adminlte::adminlte.birth_date') }}">
                    <span class="glyphicon glyphicon-calendar form-control-feedback"></span>
                    @if ($errors->has('birth_date'))
                        <span class="help-block">
                            <strong>{{ $errors->first('birth_date') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group has-feedback {{ $errors->has('sex') ? 'has-error' : '' }}">
                    <select class="form-control" name="sex" id="sex">
                        <option value="">Sexo:</option>
                        <option value="N">Não informado</option>
                        <option value="M">Masculino</option>
                        <option value="F">Feminino</option>
                    </select>
                </div>
                <div class="form-group has-feedback {{ $errors->has('marital_status') ? 'has-error' : '' }}">
                    <select class="form-control" name="marital_status" id="marital_status">
                        <option value="">Estado Civil</option>
                        <option value="0">Não informado</option>
                        <option value="1">Solteiro(a)</option>
                        <option value="2">Casado(a)</option>
                        <option value="3">Desquitado(a)</option>
                        <option value="4">Viúvo(a)</option>
                        <option value="5">União estável</option>
                        <option value="6">Outros</option>
                    </select>
                </div>

                <button type="submit"
                        class="btn btn-primary btn-block btn-flat"
                >{{ trans('adminlte::adminlte.register') }}</button>
            </form>
            <div class="auth-links">
                <a href="{{ url(config('adminlte.login_url', 'login')) }}"
                   class="text-center">{{ trans('adminlte::adminlte.i_already_have_a_membership') }}</a>
            </div>
        </div>
        <!-- /.form-box -->
    </div><!-- /.register-box -->
@stop

@section('adminlte_js')
    @yield('js')
@stop

@section('js')
    <script>
        $(document).ready(function() {
            $('.cpf').mask('000.000.000-00');
            $('.birth').mask('00/00/0000');
        });
    </script>
    <script type="text/javascript" src="{{url('assets/js/jquery.mask.js')}}"></script>
@stop
