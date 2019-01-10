@extends('adminlte::page')

@section('title', 'Atualização de Perfil')

@section('content_header')
    <h1>Atualizar Perfil <small>Atualizar</small></h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>Dashboard</a></li>
        <li><a href="#">Perfil</a></li>

    </ol>
@stop

@section('content')
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Manutenção de perfil</h3>
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
                <form role="form" method="post" action="{{route('profile.editgo')}}" enctype="multipart/form-data">
{{--                    {{ method_field('PUT') }}--}}
                    {{ csrf_field() }}
                    <div class="box-body">
                        <div class="form-group col-md-6">
                            <label for="InputName">Nome</label>
                            <input type="text" class="form-control" id="InputName" name="name" placeholder="Nome" value="{{$data->name or old('name')}}">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="InputEmail">Email</label>
                            <input type="email" class="form-control" id="InputEmail" name="email_noa" placeholder="Email" value="{{$data->email or old('email')}}" readonly>
                        </div>
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

                        </div>
                    </div>
                    <!-- /.box-body -->

                    <div class="box-footer">
                        <div class="form-group col-md-6">
                            <button type="submit" class="btn btn-success"><i class="fa fa-edit"></i> Atualizar</button>
                            <a href="{{route('profile.show')}}" class="btn btn-info"><i class="fa fa-undo"></i>  Voltar</a>
                        </div>
                    </div>
                </form>
            </div>
            <!-- /.box -->
@stop