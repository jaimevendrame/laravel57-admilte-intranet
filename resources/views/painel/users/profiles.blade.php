@extends('adminlte::page')

@section('title', 'Gestão de usuários')

@section('content_header')
    <h1>Gestão de usuários <small>{{$title}}</small></h1>

    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>Dashboard</a></li>
        <li><a href="#">Usuário</a></li>
        <li><a href="#">Perfis</a></li>

    </ol>
@stop

@section('content')
    <div class="box box-primary">
        <div class="box-header">
            <h3 class="box-title">
                <a href="{{route('user.profiles.add', $user->id)}}" class="btn btn-primary btn-xs"><i class="fa fa-plus"></i> Usuários</a>
            </h3>
            <div class="box-tools">
                <form role="form" method="get" action="{{route('user.profiles.search', $user->id)}}" enctype="multipart/form-data">
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
                @forelse($profiles as $profile)
                    <tr>
                        <td>{{$profile->name}}</td>
                        <td>{{$profile->label}}</td>
                        <td>
                            <a href="{{route('user.profile.delete', [$user->id, $profile->id])}}" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></a>
                        </td>
                    </tr>
                    @empty
                    <div class="box-body">
                        Nenhum perfil vinculado ao usuário
                    </div>
                    @endforelse
            </table>
            <div class="box-footer">
                @if(isset($dataForm))
                    {{$profiles->appends(Request::only('pesquisa'))->links()}}
                @else
                    {{$profiles->links()}}
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