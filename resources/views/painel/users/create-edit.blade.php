@extends('adminlte::page')

@section('title', 'Gestão de usuários')

@section('content_header')
    <h1>Gestão de usuários <small>Cadastrar/Atualizar</small></h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>Dashboard</a></li>
        <li><a href="#">Usuários</a></li>

    </ol>
@stop

@section('content')
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Manutenção de usuários</h3>
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
                <form role="form" method="post" action="{{route('usuarios.update', $data->id)}}" enctype="multipart/form-data">
                    {{ method_field('PUT') }}
                @else
                <form role="form" method="post" action="{{route('usuarios.store')}}" enctype="multipart/form-data">
                @endif
                    {{ csrf_field() }}
                    <div class="box-body">
                        <div class="form-group col-md-6">
                            <label for="InputName">Nome</label>
                            <input type="text" class="form-control" id="InputName" name="name" placeholder="Nome" value="{{$data->name or old('name')}}">
                        </div>
                        @if(isset($data))
                        <div class="form-group col-md-6">
                            <label for="InputEmail">Email</label>
                            <input type="email" class="form-control" id="InputEmail" name="email_noo" placeholder="Email" value="{{$data->email or old('email')}}" readonly="readonly">
                        </div>
                        @else
                        <div class="form-group col-md-6">
                            <label for="InputEmail">Email</label>
                            <input type="email" class="form-control" id="InputEmail" name="email" placeholder="Email" value="{{$data->email or old('email')}}">
                        </div>
                        @endif
                        <div class="form-group col-md-6">
                            <label for="InputPassword">Senha</label>
                            <input type="password" class="form-control" id="InputPassword" name="password" placeholder="Senha" >
                        </div>
                        <div class="form-group col-md-6">
                            <label for="InputPasswordConfirmation">Confirmar a senha</label>
                            <input type="password" class="form-control" id="InputPasswordConfirmation" name="password_confirmation" placeholder="Confirmar a senha" >
                        </div>
                        <div class="form-group col-md-6">
                            <label for="InputFacebook">Facebook</label>
                            <input type="text" class="form-control" id="InputFacebook" name="facebook" placeholder="Facebook" value="{{$data->facebook or old('facebook')}}">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="InputTwitter">Twitter</label>
                            <input type="text" class="form-control" id="InputTwitter" name="twitter" placeholder="Twitter" value="{{$data->twitter or old('twitter')}}">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="InputGitHub">GitHub</label>
                            <input type="text" class="form-control" id="InputGitHub" name="github" placeholder="GitHub" value="{{$data->github or old('github')}}">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="InputSite">Site</label>
                            <input type="text" class="form-control" id="InputSite" name="site" placeholder="Site" value="{{$data->site or old('site')}}">
                        </div>
                        <!-- textarea -->
                        <div class="form-group col-md-6">
                            <label>Biografia</label>
                            <textarea class="form-control" rows="3" name="biography" placeholder="Digite aqui ...">{{$data->biography or old('biography')}}</textarea>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="InputFile">Imagem de Perfil</label>
                            <input type="file" id="InputFile" name="image">

                            <p class="help-block">Example block-level help text here.</p>
                        </div>
                    </div>
                    <!-- /.box-body -->

                    <div class="box-footer">
                        <div class="form-group col-md-6">
                            <button type="submit" class="btn btn-success">Enviar</button>
                            <a href="{{route('usuarios.index')}}" class="btn btn-info"><i class="fa fa-undo"></i>  Voltar</a>
                            <button type="reset" class="btn btn-danger">Limpar</button>
                        </div>
                    </div>
                </form>
            </div>
            <!-- /.box -->
@stop