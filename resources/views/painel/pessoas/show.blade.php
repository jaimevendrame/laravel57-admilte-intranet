@extends('adminlte::page')

@section('title', 'Gestão de pessoas')

@section('content_header')
    <h1>Gestão de pessoas <small>{{$title}}</small></h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>Dashboard</a></li>
        <li><a href="#">Pessoas</a></li>

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

                            <h4><strong>Nome: </strong>
                                {{Helper::shout($data->nome_razao)}}{{$data->tipo_pessoa == 1 ? Helper::shout(" (".$data->sobrenome_fantasia.")") : Helper::shout(" ".$data->sobrenome_fantasia) }}
                            </h4>
                            <h4><strong>CPF_CNPJ: </strong>{{Helper::mask_cpf_cnpj($data->cpf_cnpj) }}</h4>
                            <h4><strong>RG_IE: </strong>{{$data->rg_ie}}</h4>
                            <h4><strong>Tipo de Pessoa: </strong>{{$data->tipo_pessoa == 0 ? 'Pessoa Física':'Pessoa Jurídica'}}</h4>
                        </div>
                        <div class="col-md-4">
                            @if(isset($data->image))
                                <img src="{{asset('storage/pessoas/'.$data->image)}}" alt="$user->image" class="img-responsive img-rounded img-bordered">
                            @endif
                        </div>
                    </div>
                </div>
                <!-- /.box-body -->
                <!-- form start -->
                <form role="form" method="post" action="{{route('pessoas.destroy', $data->id)}}" >
                    {{ method_field('DELETE') }}
                    {{ csrf_field() }}
                    <div class="box-footer">
                        <div class="form-group col-md-6">
                            <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i> Deletar</button>
                            <a href="{{route('pessoas.index')}}" class="btn btn-info"><i class="fa fa-undo"></i>  Voltar</a>
                        </div>
                    </div>
                </form>

            </div>
            <!-- /.box -->
@stop