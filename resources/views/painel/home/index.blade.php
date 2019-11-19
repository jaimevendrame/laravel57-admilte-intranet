{{-- resources/views/admin/dashboard.blade.php --}}

@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1><small><span>Painel de Controle</span></small>
@stop

@section('content')
    <p>Bem vindo ao seu Painel de Controle.</p>
    <div class="row">
        <div class="col-md-8 col-sm-12">
            <div class="row">
                @can('users')
                    <div class="col-md-4 col-sm-6 col-xs-12">
                        <div class="info-box">
                            <!-- Apply any bg-* class to to the icon to color it -->
                            <span class="info-box-icon bg-aqua"><i class="fa fa-id-card"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Usuários</span>
                                <span class="info-box-number">{{$totalUser}}</span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                @endcan
                @can('categories')
                    <div class="col-md-4 col-sm-6 col-xs-12">
                        <div class="info-box">
                            <!-- Apply any bg-* class to to the icon to color it -->
                            <span class="info-box-icon bg-green"><i class="fa fa-cubes"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Categorias</span>
                                <span class="info-box-number">{{$totalCategories}}</span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                @endcan

                @can('posts')
                    <div class="col-md-4 col-sm-6 col-xs-12">
                        <div class="info-box">
                            <!-- Apply any bg-* class to to the icon to color it -->
                            <span class="info-box-icon bg-yellow"><i class="fa fa-file-text"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Posts</span>
                                <span class="info-box-number">{{$totalPosts}}</span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                @endcan
                @can('comments')
                    <div class="col-md-4 col-sm-6 col-xs-12">
                        <div class="info-box">
                            <!-- Apply any bg-* class to to the icon to color it -->
                            <span class="info-box-icon bg-purple"><i class="fa fa-comments"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Comentários</span>
                                <span class="info-box-number">{{$totalComments}}</span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                @endcan
                @can('Admin')
                    <div class="col-md-4 col-sm-6 col-xs-12">
                        <div class="info-box">
                            <!-- Apply any bg-* class to to the icon to color it -->
                            <span class="info-box-icon bg-red"><i class="fa fa-users"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Perfis</span>
                                <span class="info-box-number">{{$totalProfiles}}</span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                @endcan
                @can('Admin')
                    <div class="col-md-4 col-sm-6 col-xs-12">
                        <div class="info-box">
                            <!-- Apply any bg-* class to to the icon to color it -->
                            <span class="info-box-icon bg-maroon"><i class="fa fa-unlock"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Permissões</span>
                                <span class="info-box-number">{{$totalPermissions}}</span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                @endcan
                @can('Admin')
                    <div class="col-md-4 col-sm-6 col-xs-12">
                        <div class="info-box">
                            <!-- Apply any bg-* class to to the icon to color it -->
                            <span class="info-box-icon bg-maroon"><i class="fa fa-unlock"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Setores</span>
                                <span class="info-box-number">{{$totalPermissions}}</span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                @endcan
                @can('sumulas')
                    <div class="col-md-4 col-sm-6 col-xs-12">
                        <div class="info-box">
                            <!-- Apply any bg-* class to to the icon to color it -->
                            <span class="info-box-icon bg-orange"><i class="fa fa-file-text"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Súmulas</span>
                                <span class="info-box-number">{{$totalSumulas}}</span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                @endcan
                @can('ideas')
                    <div class="col-md-4 col-sm-6 col-xs-12">
                        <div class="info-box">
                            <!-- Apply any bg-* class to to the icon to color it -->
                            <span class="info-box-icon bg-blue-active"><i class="fa fa-lightbulb-o"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Ideias</span>
                                <span class="info-box-number">{{$totalIdeas}}</span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                @endcan
            </div>
        </div>
        <div class="col-md-4 col-sm-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <i class="fa fa-warning"></i>

                    <h3 class="box-title">Notificações</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
{{--                    <div class="alert alert-danger alert-dismissible">--}}
{{--                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>--}}
{{--                        <h4><i class="icon fa fa-ban"></i> Alert!</h4>--}}
{{--                        Danger alert preview. This alert is dismissable. A wonderful serenity has taken possession of my entire--}}
{{--                        soul, like these sweet mornings of spring which I enjoy with my whole heart.--}}
{{--                    </div>--}}
                    <div class="alert alert-info alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h4><i class="icon fa fa-birthday-cake"></i> Aniversariantes do mês!</h4>
                            @forelse($niver as $d)
                            <div class="col-md-3 text-truncate">
                                {{$d->nome_razao." ". $d->sobrenome_fantasia}}
                            </div>
                        <div class="col-md-1">
                            <span class="pull-right text-bold">{{\Carbon\Carbon::parse($d->birth_date_fundacao)->format('d')}} </span>
                        </div>

                            @empty
                                <p>nenhum registro encontrado! </p>
                            @endforelse
                    </div>
{{--                    <div class="alert alert-warning alert-dismissible">--}}
{{--                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>--}}
{{--                        <h4><i class="icon fa fa-warning"></i> Alert!</h4>--}}
{{--                        Warning alert preview. This alert is dismissable.--}}
{{--                    </div>--}}
{{--                    <div class="alert alert-success alert-dismissible">--}}
{{--                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>--}}
{{--                        <h4><i class="icon fa fa-check"></i> Alert!</h4>--}}
{{--                        Success alert preview. This alert is dismissable.--}}
{{--                    </div>--}}
                </div>
                <!-- /.box-body -->
            </div>
        </div>
    </div>


@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop