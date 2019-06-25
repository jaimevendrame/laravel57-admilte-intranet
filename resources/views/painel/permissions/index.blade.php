@extends('adminlte::page')

@section('title', 'Gestão de permissão')

@section('content_header')
    <h1>Gestão de permissão <small>{{$title}}</small></h1>

    <ol class="breadcrumb">
        <li><a href="/painel"><i class="fa fa-dashboard"></i>Dashboard</a></li>
        <li><a href="/painel/permissoes">Permissão</a></li>

    </ol>
@stop

@section('content')
    <div class="box box-primary">
        <div class="box-header">
            <h3 class="box-title">
                <a href="{{route('permissoes.create')}}" class="btn btn-primary btn-lg"><i class="fa fa-plus"></i> NOVA PERMISSÃO</a>
            </h3>
            <div class="box-tools">
                <form role="form" method="get" action="{{url('painel')}}" enctype="multipart/form-data">
                    {{--{{ csrf_field() }}--}}
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
                    <th>Nome</th>
                    <th>Rótulo</th>
                    <th width="150">Ações</th>
                </tr>
                @forelse($datas as $data)
                    <tr>
                        <td>{{$data->name}}</td>
                        <td>{{$data->label}}</td>
                        <td>
                            <a href='{{route('permissoes.edit', $data->id)}}' class="btn btn-success btn-xs"><i class="fa fa-edit"></i></a>
                            <a href="{{route('permissoes.show', $data->id)}}" class="btn btn-info btn-xs"><i class="fa fa-eye"></i></a>
                            <a href="{{route('permission.profiles', $data->id)}}" class="btn btn-warning btn-xs"><i class="fa fa-users"></i></a>
                        </td>
                    </tr>
                    @empty
                    <div class="box-body">
                        Nenhum permissão cadastrada
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