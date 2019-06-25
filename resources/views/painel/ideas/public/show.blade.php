@extends('adminlte::page-no-sidebar')

@section('title', 'Gestão de postagens')

@section('content_header')

@stop

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

                <div class="box-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="box box-widget widget-user-2">
                                <div class="widget-user-header bg-light-blue-gradient">
                                    <div class="widget-user-image">
                                        @if( isset($data->user->image))
                                            <img src="{{URL::asset('/assets/uploads/users/'. $data->user->image)}}" alt="{{ $data->user->name}}" class="user-image2 img-rounded img-responsive">
                                        @else
                                            <img src="{{URL::asset('/assets/uploads/users/no-image.png')}}" alt="{{ $data->user->name}}" class="user-image2 img-rounded img-responsive">
                                        @endif
                                    </div>
                                    <h3 class="widget-user-username">{{$data->user->name. " " . $data->user->last_name}}</h3>
                                    <h5 class="widget-user-desc">{{$data->user->email}}</h5>
                                </div>
                                <div class="box-footer no-padding">
                                    <ul class="nav nav-stacked">
                                        <li><b>Data/horário do Cadastro: </b>{!! Carbon\Carbon::parse($data->date)->format('d/m/Y') !!} - {!! $data->hour !!} @if(isset($data->updated_at)) {!! " -- Atualizado em: ". Carbon\Carbon::parse($data->update_at)->format('d/m/Y H:i:s') !!} @endif</li>
                                        <li><h5><strong>{{$data->title}}</strong></h5>
                                        <p style="margin: 5px;">{!!  $data->description !!}</p>
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
{{--                                            @if(isset($data->user->sector->initials))--}}
                                                <li><h5><strong>Setor: </strong></h5>
{{--                                                    <p>{{$data->user->sector->initials}}</p>--}}
                                                    <p>{{$data->user->sectorid->initials}}</p>
                                                </li>
                                            {{--@endif--}}
                                        @endif
                                    </ul>

                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <!-- /.box-body -->
                <!-- form start -->
                <form role="form" method="post" action="{{route('ideas-public.destroy', $data->id)}}" >
                    {{ method_field('DELETE') }}
                    {{ csrf_field() }}
                    <div class="box-footer">
                        <div class="form-group col-md-6">
                            @can('admin')
                            <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i> Deletar</button>
                            @endcan
                            <a href="{{route('ideas-public.index')}}" class="btn btn-info"><i class="fa fa-undo"></i>  Voltar</a>
                        </div>
                    </div>
                </form>



            </div>
            <!-- /.box -->
@stop