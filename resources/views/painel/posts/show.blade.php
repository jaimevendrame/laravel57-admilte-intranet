@extends('adminlte::page')

@section('title', 'Gestão de postagens')

@section('content_header')
    <h1>Gestão de categorias <small>{{$title}}</small></h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>Dashboard</a></li>
        <li><a href="#">Posts</a></li>

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

                            <h4><strong>Título: </strong>{{$data->title}}</h4>
                            <h4><strong>Introdução: </strong></h4>
                            {!! $data->description !!}
                            <h4><strong>Chamada: </strong></h4>
                            <i>{!! $data->calltext !!}</i>
                            <h4><strong>Artigo: </strong></h4>
                            {!! $data->descriptionfull !!}
                        </div>
                        <div class="col-md-4">
                            @if(isset($data->image))
                            <img src="{{URL::asset('/assets/uploads/posts/'.$data->image)}}" alt="$user->image" class="img-responsive img-rounded img-bordered">
                            @endif
                                <h4><strong>Url: </strong>{!! $data->url !!}</h4>
                                <h4><strong>Data: </strong>{!! Carbon\Carbon::parse($data->date)->format('d/m/Y') !!}</h4>
                                <h4><strong>Horário: </strong>{!! $data->hour !!}</h4>
                                <h4><strong>Tags: </strong>{!! $data->tags !!}</h4>
                        </div>
                    </div>
                </div>
                <!-- /.box-body -->
                <!-- form start -->
                <form role="form" method="post" action="{{route('posts.destroy', $data->id)}}" >
                    {{ method_field('DELETE') }}
                    {{ csrf_field() }}
                    <div class="box-footer">
                        <div class="form-group col-md-6">
                            <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i> Deletar</button>
                            <a href="{{route('posts.index')}}" class="btn btn-info"><i class="fa fa-undo"></i>  Voltar</a>
                        </div>
                    </div>
                </form>

            </div>
            <!-- /.box -->
@stop