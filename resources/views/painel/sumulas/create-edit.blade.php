@extends('adminlte::page')

@section('title', 'Gestão de súmulas')

@section('content_header')
    <h1>Gestão de súmulas <small>{{$title}}</small></h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>Dashboard</a></li>
        <li><a href="#">Súmulas</a></li>

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
                <form role="form" method="post" action="{{route('sumulas.update', $data->id)}}" enctype="multipart/form-data">
                    {{ method_field('PUT') }}
                @else
                <form role="form" method="post" action="{{route('sumulas.store')}}" enctype="multipart/form-data">
                @endif
                    {{ csrf_field() }}
                    <div class="box-body">
                        <div class="form-group col-md-4">
                            <label for="InputNrProtocolo">Nº Protocolo</label>
                            <input type="text" class="form-control nr_protocolo" id="InputNrProtocolo" name="nr_protocolo" placeholder="0000/2019" value="{{$data->nr_protocolo ?? old('nr_protocolo')}}">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="InputDtProtocolo">Data Protocolo</label>
                            <input type="date" class="form-control date-picker" id="InputDtProtocolo" name="date_protocolo" placeholder="Data do Procolo" value="{{$data->date_protocolo ?? old('date_protocolo')}}">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="Inputhour">Horário</label>
                            <input type="time" class="form-control" name="hour_protocolo" id="Inputhour"  value="{{$data->hour_protocolo ??  old('hour_protocolo') }}">
                        </div>
                        <div class="form-group col-md-4">
                            <label>Selecione um Autor</label>
                            <select class="form-control user_parlamentar" name="parlamentar_id">
                                @foreach($dataParlamentar as $parlamentar)
                                    @if(isset($data['parlamentar_id'])) @else <option value="" selected></option> @endif
                                    <option value="{{$parlamentar->id}}" @if( isset($data['parlamentar_id'])) {{$data['parlamentar_id'] == $parlamentar->id ? 'selected':''}}@endif>{{$parlamentar->nome_parlamentar}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="InputDtStart">Data Início Prazo</label>
                            <input type="date" class="form-control" id="InputDtStart" name="date_start" placeholder="Sigla" value="{{$data->date_start ?? old('date_start')}}">
                        </div>
                        <div class="form-group col-md-4">
                            <label>Selecione o status da súmula</label>
                            <select class="form-control" name="status" id="status">
                                <option value="A" @if( isset($data['status'])) {{$data['status'] == 'A'? 'selected':''}}@endif>Ativo</option>
                                <option value="P" @if( isset($data['status'])) {{$data['status'] == 'P'? 'selected':''}}@endif>Pendente</option>
                                <option value="C" @if( isset($data['status'])) {{$data['status'] == 'C'? 'selected':''}}@endif>Contrário</option>
                            </select>
                        </div>
                        <!-- textarea -->
                        <div class="form-group col-md-12">
                            <label>Descrição</label>
                            <textarea class="form-control" rows="3" name="description" placeholder="Digite aqui ...">{{$data->description ?? old('description')}}</textarea>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="InputFile">Anexo</label>
                            <input type="file" id="InputFile" name="image">
                        </div>
                    </div>
                    <!-- /.box-body -->

                    <div class="box-footer">
                        <div class="form-group col-md-6">
                            <button type="submit" class="btn btn-success">Enviar</button>
                            <button type="reset" class="btn btn-danger">Limpar</button>
                            <a href="{{route('sumulas.index')}}" class="btn btn-info"><i class="fa fa-undo"></i>  Voltar</a>

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

                        $('.nr_protocolo').mask('0000/0000', {reverse: true});
                    });


                </script>
                <script type="text/javascript" src="{{url('assets/js/jquery.mask.js')}}"></script>

@stop