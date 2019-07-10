@extends('adminlte::page')

@section('title', 'Gestão de ideias')

@section('content_header')
    <h1>Gestão de ideias <small>{{$title}}</small></h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>Dashboard</a></li>
        <li><a href="#">Ideias</a></li>

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
                <form role="form" method="post" action="{{route('ideas.update', $data->id)}}" enctype="multipart/form-data">
                    {{ method_field('PUT') }}
                    {{ csrf_field() }}

                    <div class="box-body">
                        <div class="row">
                                <div class="col-md-12">
                                    @include('painel.ideas.includes.include-show')
                                </div>
                        </div>

                        <div class="row">
                           
                                <div class="form-group col-md-12">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="featured" @if(isset($data)&& $data->featured == 1) checked @endif> Destaque?
                                        </label>
                                    </div>
                                </div>

                                <div class="form-group col-md-4">
                                    <label>Selecione o status da ideia</label>
                                    <select class="form-control" name="status" id="status">
                                        <option value="P" @if( isset($data['status'])) {{$data['status'] == 'P'? 'selected':''}}@endif>Pendente</option>
                                        <option value="A" @if( isset($data['status'])) {{$data['status'] == 'A'? 'selected':''}}@endif>Aprovado</option>
                                        <option value="R" @if( isset($data['status'])) {{$data['status'] == 'R'? 'selected':''}}@endif>Rejeitado</option>
                                    </select>
                                </div>
                                <!-- textarea -->
                                <div class="form-group col-md-12">
                                    <label>Justificativa do Status</label>
                                    <textarea class="form-control" rows="5" name="answer_status" id="answer_status" placeholder="Digite aqui ...">{{$data->answer_status ?? old('answer_status')}}</textarea>
                                </div>
                                <!-- textarea -->
                                <div class="form-group col-md-12">
                                    <label>Observações</label>
                                    <textarea class="form-control" rows="5" name="comments" id="comments" placeholder="Digite aqui ...">{{$data->comments ?? old('comments')}}</textarea>
                                </div>
                                {{--/--}}

                        </div>
                    </div>
                    <!-- /.box-body -->

                    <div class="box-footer">
                        <div class="form-group col-md-6">
                            <button type="submit" class="btn btn-success">Enviar</button>
                            <button type="reset" class="btn btn-danger">Limpar</button>
                            <a href="{{route('ideas.index')}}" class="btn btn-info"><i class="fa fa-undo"></i>  Voltar</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>


            <!-- /.box -->
@stop
@section('js')

{{--<script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>--}}
{{--<script>tinymce.init({ selector:'textarea' });</script>--}}

<script src="https://cdn.ckeditor.com/4.9.2/standard/ckeditor.js"></script>

<script>
    $(function () {
        // Replace the <textarea id="editor1"> with a CKEditor
        // instance, using default configuration.
//        CKEDITOR.replace('description')
        //bootstrap WYSIHTML5 - text editor
//        $('.textarea').wysihtml5()
    });
</script>
@stop