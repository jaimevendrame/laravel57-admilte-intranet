{{-- resources/views/admin/dashboard.blade.php --}}

@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>500 Página com erro</h1>
@stop

@section('content')

    <div class="error-page">
        <h2 class="headline text-red">
            500
        </h2>
    </div>
    <div class="error-content">
        <h3>
            <i class="fa fa-warning text-red"></i>
            Oops! Algo deu errado.
        </h3>
        <p>
           Vamos trabalhar para consertar isso imediatamente. </br> <a href="javascript:history.back()">Voltar</a>

        </p>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop