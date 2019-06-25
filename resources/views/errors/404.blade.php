{{-- resources/views/admin/dashboard.blade.php --}}

@extends('adminlte::page-no-sidebar')

@section('title', 'Dashboard')

@section('content')

    <div class="error-page">
        <h2 class="headline text-yellow">
            404
        </h2>
    </div>
    <div class="error-content">
        <h3>
            <i class="fa fa-warning text-yellow"></i>
            Oops! Página não encontrada.
        </h3>
        <p>
            Não foi possível encontrar a página que você estava procurando. </br> <a href="javascript:history.back()">Voltar</a>

        </p>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop