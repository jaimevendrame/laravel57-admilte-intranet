@extends('adminlte::page')

@section('title', "Gestão de perfis")

@section('content_header')
    <h1>Gestão de pessoas <small>{{$title}}</small></h1>
    <ol class="breadcrumb">
        <li><a href="/painel"><i class="fa fa-dashboard"></i>Dashboard</a></li>
        <li><a href="/painel/perfis">Perfis</a></li>
        <li><a href="/painel/perfis/{{$pessoa->id}}/usuarios">Usuários</a></li>
        <li><a href="/painel/perfis/{{$pessoa->id}}/usuarios/cadastrar">Cadastrar</a></li>


    </ol>
@stop

@section('content')
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">{{$title}}</h3>
                </div>
                <!-- /.box-header -->

                <!-- Alert Errors start -->
                @if( isset($errors) && count($errors) > 0 )
                    <div class="col-md-12">
                        <div class="alert alert-warning alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <h4><i class="icon fa fa-warning"></i> Atenção!</h4>
                            @foreach( $errors->all() as $error)
                                <p>{{$error}}</p>
                            @endforeach
                        </div>
                    </div>

                @endif
                <!-- /.Alert Errors start -->

                <!-- form start -->
                <form role="form" method="post" action="{{route('funcionario.users.add', $pessoa->id)}}" enctype="multipart/form-data">
                {{ csrf_field() }}
                    <div class="box-body">

                            <div class="form-group">
                                @foreach( $users as $user)
                                <div class="col-md-3">
                                    <div class="checkbox">
                                        <label>
                                            <input type="radio" name="users[]" value="{{$user->id}}">  {{$user->name. " ".$user->last_name. " (".$user->email.")"}}
                                        </label>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                    </div>
                    <!-- /.box-body -->

                    <div class="box-footer">
                        <div class="form-group col-md-6">
                            <button type="submit" class="btn btn-success">Enviar</button>
                            <a href="{{route('funcionario.user',  $pessoa->id)}}" class="btn btn-info"><i class="fa fa-undo"></i>  Voltar</a>
                            <a href="{{route('funcionario.create.user', $pessoa->id)}}" class="btn btn-danger"><i class="fa fa-plus"></i>  Usuário para {{$pessoa->nome_razao}}</a>

                        </div>
                    </div>
                </form>
            </div>
            <!-- /.box -->
@stop
