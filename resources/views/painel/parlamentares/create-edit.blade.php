@extends('adminlte::page')

@section('title', 'Gestão de Parlamentares')

@section('content_header')
    <h1>Gestão de parlamentares <small>{{$title}}</small></h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>Dashboard</a></li>
        <li><a href="#">Parlamentares</a></li>

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
                @if(isset($data))
                <form role="form" method="post" action="{{route('parlamentares.update', $data->id)}}" enctype="multipart/form-data">
                    {{ method_field('PUT') }}
                @else
                <form role="form" method="post" action="{{route('parlamentares.store')}}" enctype="multipart/form-data">
                @endif
                    {{ csrf_field() }}
                    <div class="box-body">
                        <div class="form-group col-md-6">
                            <label>Selecione um Usuário</label>
                            <select class="form-control user_parlamentar" name="user_id">
                                @foreach($dataUsers as $user)
                                    @if(isset($data['user_id'])) @else <option value="" selected></option> @endif
                                    <option value="{{$user->id}}" @if( isset($data['user_id'])) {{$data['user_id'] == $user->id ? 'selected':''}}@endif>{{$user->name." ". $user->last_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="InputNameParlamentar">Nome Parlamentar</label>
                            <input type="text" class="form-control" id="InputNameParlamentar" name="nome_parlamentar" placeholder="Nome Parlamentar" value="{{$data->nome_parlamentar ?? old('nome_parlamentar')}}">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="InputPartido">Nome Partido</label>
                            <input type="text" class="form-control" id="InputPartido" name="nome_partido" placeholder="Nome Partido" value="{{$data->nome_partido ?? old('nome_partido')}}">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="InputInitials">Sigla</label>
                            <input type="text" class="form-control" id="InputInitials" name="sigla_partido" placeholder="Sigla" value="{{$data->sigla_partido ?? old('sigla_partido')}}">
                        </div>

                        <div class="form-group col-md-6">
                            <label>Selecione o status do Parlamentar</label>
                            <select class="form-control" name="status" id="status">
                                <option value="A" @if( isset($data['status'])) {{$data['status'] == 'A'? 'selected':''}}@endif>Ativo</option>
                                <option value="I" @if( isset($data['status'])) {{$data['status'] == 'I'? 'selected':''}}@endif>Inativo</option>
                            </select>
                        </div>


                    </div>
                    <!-- /.box-body -->

                    <div class="box-footer">
                        <div class="form-group col-md-6">
                            <button type="submit" class="btn btn-success">Enviar</button>
                            <button type="reset" class="btn btn-danger">Limpar</button>
                            <a href="{{route('parlamentares.index')}}" class="btn btn-info"><i class="fa fa-undo"></i>  Voltar</a>

                        </div>
                    </div>
                </form>
            </div>
            <!-- /.box -->
@stop
@section('js')

                <script type="text/javascript">

                    $(document).ready(function() {
                        $('.user_parlamentar').select2(
                            {
                                placeholder : 'Digite nome do usuário',
                                language : {
                                    noResults :  function ( params ) {
                                        return  " Nenhum resultado encontrado. " ;
                                    }
                                },
                            }

                        );
                    });
                </script>
@stop