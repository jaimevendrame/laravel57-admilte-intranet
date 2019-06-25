@extends('adminlte::page')

@section('title', 'Gestão de usuários')

@section('content_header')
    <h1>Gestão de usuários <small>Visualizar</small></h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>Dashboard</a></li>
        <li><a href="#">Usuários</a></li>

    </ol>
@stop

@section('content')
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Visualizar usuário</h3>
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

                <div class="box-body">
                    <div class="row">
                        <div class="col-md-8">

                            <h4><strong>Nome completo: </strong>{{$data->name. " " .$data->last_name}}</h4>
                            <h4><strong>Email: </strong>{{$data->email}}</h4>
                            <h4><strong>RG: </strong>{{$data->rg}}</h4>
                            <h4><strong>CPF: </strong>{{$data->cpf}}</h4>
                            <h4><strong>Data de Nascimento: </strong>{{$data->birth_date}}</h4>
                            <h4><strong>Sexo: </strong>{{$data->sex}}</h4>
                            <h4><strong>Estado Civil: </strong>{{$data->marital_status}}</h4>
                            <h4><strong>Setor: </strong>{{$data->sectorid->initials}} - {{$data->sectorid->name}}</h4>
                        </div>
                        <div class="col-md-4">
                            @if(isset($data->image))
                            <img src="{{URL::asset('/assets/uploads/users/'.$data->image)}}" alt="$user->image" class="img-responsive img-rounded img-bordered">
                            @endif
                        </div>
                    </div>
                </div>
                <!-- /.box-body -->
                <!-- form start -->
                <form role="form" method="post" action="{{route('usuarios.destroy', $data->id)}}" >
                    {{ method_field('DELETE') }}
                    {{ csrf_field() }}
                    <div class="box-footer">
                        <div class="form-group col-md-6">
                            <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i> Deletar</button>
                            <a href="{{route('usuarios.index')}}" class="btn btn-info"><i class="fa fa-undo"></i>  Voltar</a>
                        </div>
                    </div>
                </form>

            </div>
            <!-- /.box -->
@stop