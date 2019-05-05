@extends('adminlte::page')

@section('title', 'Gestão de postagens')

@section('content_header')
    <h1>Gestão de postagens <small>{{$title}}</small></h1>
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
                <!-- form start -->
                @if(isset($data))
                <form role="form" method="post" action="{{route('posts.update', $data->id)}}" enctype="multipart/form-data">
                    {{ method_field('PUT') }}
                @else
                <form role="form" method="post" action="{{route('posts.store')}}" enctype="multipart/form-data">
                @endif
                    {{ csrf_field() }}
                    <div class="box-body">
                        <div class="form-group col-md-12">
                            <label for="InputTitle">Título</label>
                            <input type="text" class="form-control" id="InputTitle" name="title" placeholder="Título" value="{{$data->title ?? old('title')}}">
                        </div>
                        <div class="form-group col-md-12">
                            <label for="InputUrl">Url</label>
                            <input type="text" class="form-control" id="InputUrl" name="url" placeholder="Url" value="{{$data->url ?? old('url')}}">
                        </div>
                        <div class="form-group col-md-4">
                            <label>Selecione um categoria</label>

                            <select name="category_id" id="category_id" class="form-control">
                                <option value="">Escolha a Categoria</option>
                                @foreach( $categories as $cat)
                                    <option value="{{$cat->id}}"
                                            @if(isset($data->category_id) && $data->category_id == $cat->id )
                                            selected
                                            @endif
                                    >{{$cat->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="Inputdata">Data</label>
                            <input type="date" class="form-control date-picker" id="Inputdata" name="date"  value="{{$data->date ?? old('date')}}">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="Inputhour">Horário</label>
                            <input type="time" class="form-control bootstrap-timepicker timepicker" name="hour" id="Inputhour"  value="{{$data->hour ?? old('hour')}}">
                        </div>

                        <!-- textarea -->
                        <div class="form-group col-md-12">
                            <label>Introdução</label>
                            <textarea class="form-control" rows="5" name="description" id="description" placeholder="Digite aqui ...">{{$data->description ?? old('description')}}</textarea>
                        </div>
                        <!-- textarea -->
                        <div class="form-group col-md-12">
                            <label>Texto de Chamada</label>
                            <textarea class="form-control" rows="3" name="calltext" id="calltext" placeholder="Digite aqui ...">{{$data->calltext ?? old('calltext')}}</textarea>
                        </div>
                        <!-- textarea -->
                        <div class="form-group col-md-12">
                            <label>Texto artigo</label>
                            <textarea class="form-control" rows="5" name="descriptionfull" id="descriptionfull" placeholder="Digite aqui ...">{{$data->descriptionfull ?? old('descriptionfull')}}</textarea>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="InputTags">Tags do seu artigo</label>
                            <input type="text" class="form-control" id="tags" name="tags" placeholder="tags" value="{{$data->tags ?? old('tags')}}">
                        </div>
                        <div class="form-group col-md-12">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="featured" @if(isset($data)&& $data->featured == 1) checked @endif> Destaque?
                                </label>
                            </div>
                        </div>

                        <div class="form-group col-md-4">
                            <label>Selecione o status do post</label>
                            <select class="form-control" name="status" id="status">
                                <option value="A">Ativo</option>
                                <option value="R">Rascunho</option>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="InputFile">Imagem da categoria</label>
                            <input type="file" id="InputFile" name="image">
                        </div>
                        <div class="col-md-4">
                            @if(isset($data->image))
                                <img src="{{URL::asset('/assets/uploads/posts/'.$data->image)}}" alt="$user->image" class="img-responsive img-rounded img-bordered" style="width:20%;">
                            @endif
                        </div>

                    </div>
                    <!-- /.box-body -->

                    <div class="box-footer">
                        <div class="form-group col-md-6">
                            <button type="submit" class="btn btn-success">Enviar</button>
                            <button type="reset" class="btn btn-danger">Limpar</button>
                            <a href="{{route('posts.index')}}" class="btn btn-info"><i class="fa fa-undo"></i>  Voltar</a>
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
        CKEDITOR.replace('description')
        CKEDITOR.replace('descriptionfull')
        //bootstrap WYSIHTML5 - text editor
//        $('.textarea').wysihtml5()
    })
</script>
@stop