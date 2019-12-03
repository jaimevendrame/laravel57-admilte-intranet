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
                @if(isset($data))
                <form role="form" method="post" action="{{route('ideas.update', $data->id)}}" enctype="multipart/form-data">
                    {{ method_field('PUT') }}
                @else
                <form role="form" method="post" action="{{route('ideas.store')}}" enctype="multipart/form-data">
                @endif
                    {{ csrf_field() }}
                    <div class="box-body">

                        {{--Área de uso da assessoria--}}
                        @can('view_ideas', App\Models\Idea::class)


                            @cannot('admin')
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="box box-widget widget-user-2">
                                            <div class="widget-user-header bg-light-blue-gradient">
                                                <div class="widget-user-image">
                                                    @if( isset($data->user->image))
                                                        <img src="{{URL::asset('/assets/uploads/users/'. $data->user->image)}}" alt="{{ $data->user->name}}" alt="{{ $data->user->name}}" class="user-image img-circle img-responsive">
                                                    @else
                                                        <img src="{{URL::asset('/assets/uploads/users/no-image.png')}}" alt="{{ $data->user->name}}" class="user-image img-circle img-responsive">
                                                    @endif
                                                </div>
                                                <h3 class="widget-user-username">{{$data->user->name}}</h3>
                                                <h5 class="widget-user-desc">{{$data->user->email}}</h5>
                                            </div>
                                            <div class="box-footer no-padding">
                                                <ul class="nav nav-stacked">
                                                    <li><b>Data/horário do Cadastro: </b>{!! Carbon\Carbon::parse($data->date)->format('d/m/Y') !!} - {!! $data->hour !!}</li>
                                                    <li><h5><strong>{{$data->title}}</strong></h5>
                                                        <p>{{$data->description}}</p>
                                                    </li>
                                                    <li><h5><strong>Categoria: </strong>{{$data->category->name}}</h5></li>
                                                    <li><h5><strong>Status: </strong>@if($data->status == 'P') <span class="label label-warning">Pendente</span> @elseif($data->status == 'A') <span class="label label-success">Aprovada</span> @else <span class="label label-danger">Rejeitado</span> @endif</h5></li>
                                                    @if(isset($data->file))
                                                        <li><h5><strong>Arquivo Anexo: </strong><a href="{{URL::asset('/assets/uploads/ideas/'.$data->file)}}" target="_blank" class="btn btn-app"> <i class="fa  fa-file-archive-o"></i></a></h5></li>
                                                    @else
                                                        <li><h5><strong>Arquivo Anexo: </strong>SEM ANEXO</h5></li>
                                                    @endif
                                                    <li><h5><strong>Tags (palavras-chaves) relacionadas a ideia</strong></h5>
                                                        <p>{{$data->tags}}</p>
                                                    </li>

                                                    @if($data->status != 'P')
                                                        <li><h5><strong>Justificativa do status</strong></h5>
                                                            <p>{{$data->answer_status}}</p>
                                                        </li>
                                                        @if(isset($data->comments))
                                                            <li><h5><strong>Observações:</strong></h5>
                                                                <p>{{$data->comments}}</p>
                                                            </li>
                                                        @endif
                                                    @endif
                                                    @if(isset($data->assessor_id))
                                                        <li><h5><strong>Assessor: </strong></h5>
                                                            <p>{{$data->assessor->name}}</p>
                                                        </li>
                                                        @if(isset($data->user->sector->initials))
                                                            <li><h5><strong>Setor: </strong></h5>
                                                                <p>{{$data->user->sector->initials}}</p>
                                                            </li>
                                                        @endif
                                                    @endif
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            @endcannot



                        @endcan


                    <!-- /.box-body -->


                    {{--lllll--}}
                        <div class="row">
                            {{--Área de uso da assessoria--}}
                            @can('view_ideas', App\Models\Idea::class)
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

                            @endcan

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