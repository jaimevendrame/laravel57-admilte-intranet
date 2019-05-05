@extends('adminlte::page')

@section('title', 'Gestão de setores')

@section('content_header')
    <h1>Gestão de setores <small>{{$title}}</small></h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>Dashboard</a></li>
        <li><a href="#">Setores</a></li>

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
                <form role="form" method="post" action="{{route('sectors.update', $data->id)}}" enctype="multipart/form-data">
                    {{ method_field('PUT') }}
                @else
                <form role="form" method="post" action="{{route('sectors.store')}}" enctype="multipart/form-data">
                @endif
                    {{ csrf_field() }}
                    <div class="box-body">
                        <div class="form-group col-md-6">
                            <label for="InputName">Nome</label>
                            <input type="text" class="form-control" id="InputName" name="name" placeholder="Nome" value="{{$data->name ?? old('name')}}">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="InputLabel">Rótulo</label>
                            <input type="text" class="form-control" id="InputLabel" name="label" placeholder="Rótulo" value="{{$data->label ?? old('label')}}">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="InputInitials">Sigla</label>
                            <input type="text" class="form-control" id="InputInitials" name="initials" placeholder="Sigla" value="{{$data->initials ?? old('initials')}}">
                        </div>
                        <div class="form-group col-md-6">
                            <label>Selecione o status do setor</label>
                            <select class="form-control" name="status" id="status">
                                <option value="A" @if( isset($data['status'])) {{$data['status'] == 'A'? 'selected':''}}@endif>Ativo</option>
                                <option value="I" @if( isset($data['status'])) {{$data['status'] == 'I'? 'selected':''}}@endif>Inativo</option>
                            </select>
                        </div>
                        <!-- textarea -->
                        <div class="form-group col-md-12">
                            <label>Descrição</label>
                            <textarea class="form-control" rows="3" name="description" placeholder="Digite aqui ...">{{$data->description ?? old('description')}}</textarea>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="InputFile">Imagem Setor</label>
                            <input type="file" id="InputFile" name="image">
                        </div>
                    </div>
                    <!-- /.box-body -->

                    <div class="box-footer">
                        <div class="form-group col-md-6">
                            <button type="submit" class="btn btn-success">Enviar</button>
                            <button type="reset" class="btn btn-danger">Limpar</button>
                            <a href="{{route('sectors.index')}}" class="btn btn-info"><i class="fa fa-undo"></i>  Voltar</a>

                        </div>
                    </div>
                </form>
            </div>
            <!-- /.box -->
@stop
