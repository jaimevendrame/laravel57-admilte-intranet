@extends('adminlte::page-no-sidebar')

@section('title', 'Gestão de Ideia')


@section('content')
    @include('painel.ideas.public.top-home')

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
                <form role="form" method="post" action="{{route('ideas-public.update', $data->id)}}" enctype="multipart/form-data">
                    {{ method_field('PUT') }}
                @else
                <form role="form" method="post" action="{{route('ideas-public.store')}}" enctype="multipart/form-data">
                @endif
                    {{ csrf_field() }}
                    <div class="box-body">
                        {{--Área de uso publico--}}
                            <div class="form-group col-md-12">
                                <label for="InputTitle">Título</label>
                                <input type="text" class="form-control" id="InputTitle" name="title" placeholder="Título de sua ideia" value="{{ $data->title ?? old('title')}}">
                            </div>
                            <div class="form-group col-md-4">
                                <label>Selecione um categoria</label>

                                <select name="category_id" id="category_id" class="form-control">
                                    {{--<option value="">Escolha a Categoria</option>--}}
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
                                <input type="text" class="form-control date-picker" id="Inputdata" name="date"    value=" @if(isset($data->date)) {{\Carbon\Carbon::parse($data->date)->format('d/m/Y')}} @else {{\Carbon\Carbon::now()->format('d/m/Y')}} @endif" readonly>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="Inputhour">Horário</label>
                                <input type="text" class="form-control bootstrap-timepicker timepicker" name="hour" id="Inputhour"  value="{{$data->hour ??  \Carbon\Carbon::now()->format('H:i')}}" readonly>
                            </div>

                            <!-- textarea -->
                            <div class="form-group col-md-12">
                                <label>Descrição de sua ideia</label>
                                <textarea class="form-control" rows="10" name="description" id="description" placeholder="Digite aqui a sua ideia">{{$data->description ?? old('description')}}</textarea>
                            </div>
                            <div class="form-group col-md-12">
                                <label for="InputTags">Tags do sua ideia</label>
                                <input type="text" class="form-control" id="tags" name="tags" placeholder="Digite aqui as palavras chaves que representam sua ideia" value="{{$data->tags ?? old('tags')}}">
                            </div>

                            <div class="form-group col-md-4">
                                <label for="InputFile">Anexar arquivo</label>
                                <input type="file" id="InputFile" name="file">
                            </div>
                            <div class="col-md-4">
                                @if(isset($data->file))
                                    <a href="{{URL::asset('/assets/uploads/ideas/'.$data->file)}}" target="_blank" class="btn btn-app"> <i class="fa  fa-file-archive-o"></i>Anexo</a>
                                @else
                                    <h5><strong>SEM ANEXO</strong></h5>
                                @endif
                            </div>
                            {{--/--}}


                    <div class="box-footer">
                        <div class="form-group col-md-6">
                            <button type="submit" class="btn btn-success">Enviar</button>
                            <button type="reset" class="btn btn-danger">Limpar</button>
                            <a href="{{route('ideas-public.index')}}" class="btn btn-info"><i class="fa fa-undo"></i>  Voltar</a>
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