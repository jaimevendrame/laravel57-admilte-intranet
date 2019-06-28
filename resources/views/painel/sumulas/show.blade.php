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

                <div class="box-body">
                    <div class="row">
                        <div class="col-md-8">

                            <h4><strong>Nº do Protocolo: </strong>{{$data->nr_protocolo}}</h4>
                            <h4><strong>Data do Protocolo: </strong>{{\Carbon\Carbon::parse($data->date_protocolo)->format('d/m/Y')}} </h4>
                            <h4><strong>Horário </strong>{{\Carbon\Carbon::parse($data->hour_protocolo)->format('H:i')}} </h4>
                            <h4><strong>Autor: </strong>{{ $data->parlamentar->nome_parlamentar. " - ".$data->parlamentar->sigla_partido }} </h4>
                            @if(isset($data->date_start))
                            <h4><strong>Data Fim Súmula: </strong>{{ \Carbon\Carbon::parse(Helper::calcularDataEndSumula($data->date_start,90))->format('d/m/Y') }}</h4>
                            <h4><strong>Expira em: </strong> {{ Helper::calcularDiasRestantesSumula($data->date_start)}}</h4>
                            @endif
                            <h4><strong>Descrição: </strong></h4>
                            <p>{{$data->description}}</p>
                            <h4><strong>Status: </strong>{{$data->status == 'A'? 'ATIVO':'INATIVO'}}</h4>
                            <hr>
                            <h4><strong>Protocolista: </strong>{{$data->user->name}}</h4>


                        </div>
                        <div class="col-md-4">
                            @if(isset($data->image))
                                <h4><strong>Anexo: </strong><a href="{{URL::asset('/assets/uploads/sumulas/'.$data->image)}}" target="_blank"><i class="fa fa-file-text fa-3x" aria-hidden="true"></i></a></h4>
                            @endif
                        </div>
                    </div>
                </div>
                <!-- /.box-body -->
                <!-- form start -->
                <form role="form" method="post" action="{{route('sumulas.destroy', $data->id)}}" >
                    {{ method_field('DELETE') }}
                    {{ csrf_field() }}
                    <div class="box-footer">
                        <div class="form-group col-md-6">
                            <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i> Deletar</button>
                            <a href="{{route('sumulas.index')}}" class="btn btn-info"><i class="fa fa-undo"></i>  Voltar</a>
                        </div>
                    </div>
                </form>

            </div>
            <!-- /.box -->
@stop