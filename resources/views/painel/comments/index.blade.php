@extends('adminlte::page')

@section('title', 'Gestão de categorias')

@section('content_header')
    <h1>Gestão de comentários <small>{{$title}}</small></h1>

    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>Dashboard</a></li>
        <li><a href="#">Comentários</a></li>

    </ol>
@stop

@section('content')
    <div class="box box-primary">
        <div class="box-header">
            <h3 class="box-title">
{{--                <a href="{{route('categorias.create')}}" class="btn btn-primary btn-xs"><i class="fa fa-plus"></i> NOVA CATEGORIA</a>--}}
            </h3>
            <div class="box-tools pull-right">
                <form class="form-inline" role="form" method="get" action="{{url('painel/comentarios/pesquisar')}}" enctype="multipart/form-data">
                    {{--{{ csrf_field() }}--}}
                    <div class="input-group input-group-sm" style="width: 100px;">
                        <select class="form-control select2" name="status" id="status">
                            <option value="R" @if( isset($dataForm['status'])) {{$dataForm['status'] == 'R'? 'selected':''}} @else @endif >Rascunho</option>
                            <option value="A" @if( isset($dataForm['status'])) {{$dataForm['status'] == 'A'? 'selected':''}} @else @endif >Ativo</option>
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
                    <th>Nome</th>
                    <th>email</th>
                    <th>Comentário</th>
                    <th>Status</th>
                    <th width="150">Ações</th>
                </tr>
                @forelse($datas as $data)
                    <tr>
                        <td>{{$data->name}}</td>
                        <td>{{$data->email}}</td>
                        <td>{{$data->description}}</td>
                        <td>{{$data->status}}</td>
                        <td>
                            <a href="{{url("painel{$data->id}/respostas")}}" class="btn btn-danger btn-xs"><i class="fa fa-reply-all"></i></a>
                        </td>
                    </tr>
                    @empty
                    <div class="box-body">
                        Nenhum comentário cadastrado
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

    $(document).ready(function() {
        $('.select2').select2();
    });
    </script>
@stop