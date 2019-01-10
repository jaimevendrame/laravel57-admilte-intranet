@extends('adminlte::page')

@section('title', 'Gestão de respostas')

@section('content_header')
    <h1>Gestão de respostas <small>{{$title}}</small></h1>

    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>Dashboard</a></li>
        <li><a href="#">Respostas</a></li>

    </ol>
@stop

@section('content')
    <div class="box box-primary">
        <div class="box-header">
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
            <h3 class="box-title">
                <!-- form start -->
                <p class="abreveiar">{{$comment->description}}:</p>

                <form role="form" method="post" action="{{route('comments.destroy', $comment->id)}}" >
{{--                    {{ method_field('DELETE') }}--}}
                    {{ csrf_field() }}
                    <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i> Deletar comentário</button>

                </form>
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
                    <th>Comentário</th>
                    <th>Status</th>
                    <th width="150">Ações</th>
                </tr>
                @forelse($answers as $data)
                    <tr>
                        <td>{{$data->name}}</td>
                        <td>{{$data->description}}</td>
                        <td>{{$data->status}}</td>
                        <td>
                            <a href="{{route('destroy-answer',['id' => $comment->id, 'idAnswer' => $data->id]  )}}" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></a>
                        </td>
                    </tr>
                    @empty
                    <div class="box-body">
                        Nenhuma resposta cadastrada
                    </div>
                    @endforelse
            </table>
            <div class="box-footer">
                @if(isset($dataForm))
                    {{$answers->appends(Request::only('pesquisa'))->links()}}
                @else
                    {{$answers->links()}}
                @endif
            </div>
            <!-- /.box-footer-->
            <div class="box-body">
                <form role="form" method="post" action="{{route('answer.reply', $comment->id)}}" enctype="multipart/form-data">
                {{ csrf_field() }}
                <!-- textarea -->
                    <div class="form-group col-md-12">
                        <label>Resposta comentário</label>
                        <textarea class="form-control" rows="5" name="description" id="description" placeholder="Digite aqui ..."></textarea>
                    </div>
                    <div class="form-group col-md-6">
                        <button type="submit" class="btn btn-success">Responder</button>
                        <button type="reset" class="btn btn-danger">Limpar</button>
                    </div>
                </form>
            </div>
                <div class="box-footer">

                </div>
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