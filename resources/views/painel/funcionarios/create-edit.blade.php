@extends('adminlte::page')

@section('title', 'Gestão de Funcionários')

@section('content_header')
    <h1>Gestão de funcionários <small>{{$title}}</small></h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>Dashboard</a></li>
        <li><a href="#">Funcionários</a></li>

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
                <form role="form" method="post" action="{{route('funcionarios.update', $data->id)}}" enctype="multipart/form-data">
                    {{ method_field('PUT') }}
                @else
                <form role="form" method="post" action="{{route('funcionarios.store')}}" enctype="multipart/form-data">
                @endif
                    {{ csrf_field() }}
                    <div class="box-body">
                        <div class="form-group col-md-6">
                            <label>Selecione um Funcionário</label>
                            <select class="form-control pessoa_funcionario" name="pessoa_id">
                                @foreach($pessoas as $pessoa)
                                    @if(isset($data['pessoa_id'])) @else <option value="" selected></option> @endif
                                    <option value="{{$pessoa->id}}" @if( isset($data['pessoa_id'])) {{$data['pessoa_id'] == $pessoa->id ? 'selected':''}}@endif>{{$pessoa->nome_razao." ". $pessoa->sobrenome_fantasia}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="InputNameCargo">Cargo</label>
                            <input type="text" class="form-control" id="InputNameCargo" name="cargo" placeholder="Cargo" value="{{$data->cargo ?? old('cargo')}}">
                        </div>
                        <div class="form-group col-md-6">
                            <label>Selecione um Setor</label>
                            <select class="form-control setor_funcionario" name="sector_id">
                                @foreach($sectores as $sector)
                                    @if(isset($data['sector_id'])) @else <option value="" selected></option> @endif
                                    <option value="{{$sector->id}}" @if( isset($data['sector_id'])) {{$data['sector_id'] == $sector->id ? 'selected':''}}@endif>{{$sector->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="InputRamal">Ramal</label>
                            <input type="text" class="form-control" id="InputRamal" name="ramal" placeholder="Ramal" value="{{$data->ramal ?? old('ramal')}}">
                        </div>


                        <div class="form-group col-md-6">
                            <label>Selecione o status do Funcionário</label>
                            <select class="form-control" name="status" id="status">
                                <option value="A" @if( isset($data['status'])) {{$data['status'] == 'A'? 'selected':''}}@endif>Ativo</option>
                                <option value="I" @if( isset($data['status'])) {{$data['status'] == 'I'? 'selected':''}}@endif>Inativo</option>
                            </select>
                        </div>




                    </div>
                    <!-- /.box-body -->

                    <div class="box-footer">
                        <div class="form-group col-md-4">
                            <button type="submit" class="btn btn-success">Enviar</button>
                            <button type="reset" class="btn btn-danger">Limpar</button>
                            <a href="{{route('funcionarios.index')}}" class="btn btn-info"><i class="fa fa-undo"></i>  Voltar</a>
{{--                            <a href="{{route('funcionario.create.user', $pessoa->id)}}" class="btn btn-warning"><i class="fa fa-user"></i>  User</a>--}}

                        </div>
                    </div>
                </form>
            </div>
            <!-- /.box -->
@stop
@section('js')

                <script type="text/javascript">

                    $(document).ready(function() {
                        $('.pessoa_funcionario').select2(
                            {
                                placeholder : 'Digite nome do usuário',
                                language : {
                                    noResults :  function ( params ) {
                                        return  " Nenhum resultado encontrado. " ;
                                    }
                                },
                            }

                        );

                        $('.setor_funcionario').select2(
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