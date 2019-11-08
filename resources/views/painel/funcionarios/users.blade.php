@extends('adminlte::page')

@section('title', 'Gestão de perfis')

@section('content_header')
    <h1>Gestão de pessoas <small>{{$title}}</small></h1>

    <ol class="breadcrumb">
        <li><a href="/painel"><i class="fa fa-dashboard"></i>Dashboard</a></li>
        <li><a href="/painel/perfis">Pessoas</a></li>
        <li><a href="/painel/perfis/{{$pessoa->id}}/usuarios">Usuários</a></li>

    </ol>
@stop

@section('content')
    <div class="box box-primary">
        <div class="box-header">
            <h3 class="box-title">
                @if ( $pessoa->user_id == null )
                    <a href="{{route('funcionario.users.add', $pessoa->id)}}" class="btn btn-primary btn-xs"><i class="fa fa-plus"></i> Usuários</a>
                    @else
                    <p>Permitido um usuário por pessoa!</p>
                @endif
            </h3>
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
                    <th>E-mail</th>
                    <th width="150">Ações</th>
                </tr>
                @forelse($users as $user)
                    <tr>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <td>
                            <a href="{{route('funcionario.user.delete', $pessoa->id)}}" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></a>
                        </td>
                    </tr>
                    @empty
                    <div class="box-body">
                        Nenhum usuário vinculado a pessoa
                    </div>
                    @endforelse
            </table>
            <div class="box-footer">
                @if(isset($dataForm))
                    {{$users->appends(Request::only('pesquisa'))->links()}}
                @else
                    {{$users->links()}}
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