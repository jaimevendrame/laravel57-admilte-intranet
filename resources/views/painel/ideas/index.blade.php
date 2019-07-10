@extends('adminlte::page')

@section('title', 'Gestão de postagens')

@section('content_header')
    <h1>Gestão de ideias <small>{{$title}}</small></h1>

    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>Dashboard</a></li>
        <li><a href="#">Ideias</a></li>

    </ol>
@stop

@section('content')
    <div class="box box-primary">
        <div class="box-header">
            <h3 class="box-title">
                {{-- <a href="{{route('ideas.create')}}" class="btn btn-primary btn-lg"><i class="fa fa-plus"></i> NOVA IDEIA</a> --}}
            </h3>
            <div class="box-tools pull-right">
                    <form class="form-inline" role="form" method="get" action="{{url('painel/sumulas/pesquisar')}}" enctype="multipart/form-data">
                        {{--{{ csrf_field() }}--}}
                        <div class="input-group input-group-sm" style="width: 100px;">
                            <select class="form-control select2" name="status" id="status">
                                <option value="">Todas</option>
                                <option value="A" @if( isset($dataForm['status'])) {{$dataForm['status'] == 'A'? 'selected':''}} @else @endif >Ativo</option>
                                <option value="P" @if( isset($dataForm['status'])) {{$dataForm['status'] == 'P'? 'selected':''}} @else @endif >Pendente</option>
                                <option value="C" @if( isset($dataForm['status'])) {{$dataForm['status'] == 'C'? 'selected':''}} @else @endif >Contrário</option>
                            </select>
                        </div>
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <input type="text" name="pesquisa" class="form-control pull-right" placeholder="Pesquisar">
                            <div class="input-group-btn">
                                <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
        </div>

        <!-- /.box-header -->
        <div class="box-body table-responsive no-padding">
            @if( Session::has('success'))
                <div class="col-md-12">
                    <div class="alert alert-success alert-dismissible hide-msg">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h4><i class="icon fa fa-warning"></i> {{Session::get('success')}}</h4>

                    </div>
                </div>
            @endif
            <table class="table table-hover">
                <tr>
                    <th>Título</th>
                    <th>Status</th>
                    <th>Data/Hora</th>
                    <th>Autor</th>
                    <th width="150">Ações</th>
                </tr>
                @forelse($datas as $data)

                    @if ((Auth::user()->can('owner', $data)) or (Auth::user()->can('owner_idea', $data)) or ($data->status == 'P'))
                    <tr>
                        <td>{{$data->title}}</td>
                        <td>@if($data->status == 'P') <span class="label label-warning">Pendente</span>  @elseif($data->status == 'A') <span class="label label-success">Aprovado</span>  @else <span class="label label-danger">Rejeitado</span> @endif</td>
                        <td>{{\Carbon\Carbon::parse($data->date)->format('d/m/Y')}} - {{$data->hour ??  \Carbon\Carbon::now()->format('H:i')}}</td>
                        <td>{{ $data->user->name }}</td>
                        <td>
                            <a href="{{route('ideas.show', $data->id)}}" class="btn btn-info btn-xs" ><i class="fa fa-eye"></i></a>
                            <a href='{{route('ideas.edit', $data->id)}}' class="btn btn-success btn-xs" alt="Editar"><i class="fa fa-edit"></i></a>
                        </td>
                    </tr>
                    @endif
                    @empty
                    <div class="box-body">
                        Nenhuma ideia cadastrada
                    </div>
                    @endforelse
            </table>
            <div class="box-footer">
                @if(isset($dataForm))
                    {{$datas->appends(Request::only('pesquisa'))->links()}}
                @else
                    {{$datas->links()}}
                @endif
            </div>
            <!-- /.box-footer-->
        </div>
        <!-- /.box-body -->
    </div>
    <!-- /.box -->
@stop
@section('js')
    <script>
    $(function () {
        setTimeout("$('.hide-msg').fadeOut();", 3000)
    })
    </script>
@stop