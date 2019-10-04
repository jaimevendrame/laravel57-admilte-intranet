@extends('adminlte::page')

@section('title', 'Gestão de usuários')

@section('content_header')
    <h1>Gestão de perfil <small>Visualizar</small></h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>Dashboard</a></li>
        <li><a href="#">Perfil</a></li>

    </ol>
@stop

@section('content')
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Visualizar perfil</h3>
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
                        <div class="col-md-4">
                            <div class="row">
                                @if(($data->image !=""))
                                    <img src="{{asset('/storage/users/'.$data->image)}}" alt="$user->image" class="img-responsive img-circle img-bordered center-block" style="width: 50%;">
                                @endif
                            </div>
                            <div class="row text-center">
                                <h4><strong>{{$data->name}}</strong></h4>
                                <h4>{{$data->email}}</h4>
                            </div>
                        </div>

                        <div class="col-md-8">

                            <h4><strong>Nome: </strong>{{$data->name." ".$data->last_name}}</h4>
                            <h4><strong>Email: </strong>{{$data->email}}</h4>
                            <h4><strong>RG: </strong>{{$data->rg}}</h4>
                            <h4><strong>CPF: </strong>{{$data->cpf}}</h4>
                            <h4><strong>Data de Nascimento: </strong>{!! Carbon\Carbon::parse($data->birth_date)->format('d/m/Y') !!}</h4>
                            <h4><strong>Sexo: </strong>
                                @switch($data->sex)
                                @case("M")
                                    Masculino
                                    @break
                                @case("F")
                                    Feminino
                                    @break
                                @default
                                    Não informado
                            @endswitch
                            </h4>
                            <h4><strong>Estado Civil: </strong>
                                @switch($data->marital_status)
                                @case(0)
                                    Não informado
                                    @break
                                @case(1)
                                    Solteiro(a)
                                    @break
                                @case(2)
                                    Casado(a)
                                    @break
                                @case(3)
                                    Desquitado(a)
                                    @break
                                @case(4)
                                    Viúvo(a)
                                    @break
                                @case(5)
                                    União estável
                                    @break
                                @default
                                    Outros
                            @endswitch    
                            </h4>
                            @if(isset($data->sectorid->initials))
                            <h4><strong>Setor: </strong>{{$data->sectorid->initials}} - {{$data->sectorid->name}}</h4>
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
                        <div class="col-md-4">
                        </div>
                        <div class="form-group col-md-8">
                            <a href="{{route('profile.edit')}}" class="btn btn-warning"><i class="fa fa-edit"></i> Editar</a>
                            <a href="{{route('home')}}" class="btn btn-info"><i class="fa fa-undo"></i>  Voltar</a>
                        </div>
                    </div>
                </form>

            </div>
            <!-- /.box -->
@stop