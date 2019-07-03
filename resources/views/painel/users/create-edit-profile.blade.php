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
                        <div class="form-group col-md-6 col-sm-12">
                            <label for="InputName">Nome</label>
                            <input type="text" class="form-control" id="InputName" name="name" placeholder="Nome" value="{{$data->name ?? old('name')}}">
                        </div>
                        <div class="form-group col-md-6 col-sm-12">
                            <label for="InputLastName">Sobrenome</label>
                            <input type="text" class="form-control" id="InputLastName" name="last_name" placeholder="Sobrenome" value="{{$data->last_name ?? old('last_name')}}">
                        </div>
                        <div class="form-group col-md-6 col-md-12">
                            <label for="InputEmail">Email</label>
                            <input type="email" class="form-control" id="InputEmail" name="email_noa" placeholder="Email" value="{{$data->email ?? old('email')}}" readonly>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="InputPassword">Senha</label>
                            <input type="password" class="form-control" id="InputPassword" name="password" placeholder="Senha" >
                        </div>
                        <div class="form-group col-md-4 col-sm-12">
                            <label for="InputRG">RG</label>
                            <input type="text" class="form-control" id="InputRG" name="rg" placeholder="RG" value="{{$data->rg ?? old('rg')}}">
                        </div>
                        <div class="form-group col-md-4 col-sm-12">
                            <label for="InputCPF">CPF</label>
                            <input type="text" class="form-control cpf" id="InputCPF" name="cpf" placeholder="CPF" value="{{$data->cpf ?? old('cpf')}}">
                        </div>
                        <div class="form-group col-md-4 col-sm-12">
                            <label for="InputCPF">Data Nascimento</label>
                            <input type="date" class="form-control" id="InputBirthDate" name="birth_date" placeholder="Data Nascimento" value="{{$data->birth_date ?? old('birth_date')}}">
                        </div>
                        <div class="form-group col-md-4">
                            <label>Sexo:</label>
                            <select class="form-control" name="sex" id="sex">
                                <option value="N" @if(isset($data)) {{ $data->sex == 'N'  ? 'selected' : '' }} @endif >Não informado</option>
                                <option value="M" @if(isset($data)) {{ $data->sex == 'M'  ? 'selected' : '' }} @endif >Masculino</option>
                                <option value="F" @if(isset($data)) {{ $data->sex == 'F'  ? 'selected' : '' }} @endif >Feminino</option>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Estado Civil:</label>
                            <select class="form-control" name="marital_status" id="marital_status">
                                <option value="0" @if(isset($data)) {{ $data->marital_status == 0  ? 'selected' : '' }} @endif>Não informado</option>
                                <option value="1" @if(isset($data)) {{ $data->marital_status == 1  ? 'selected' : '' }} @endif>Solteiro(a)</option>
                                <option value="2" @if(isset($data)) {{ $data->marital_status == 2  ? 'selected' : '' }} @endif>Casado(a)</option>
                                <option value="3" @if(isset($data)) {{ $data->marital_status == 3  ? 'selected' : '' }} @endif>Desquitado(a)/Separado(a)</option>
                                <option value="3" @if(isset($data)) {{ $data->marital_status == 7  ? 'selected' : '' }} @endif>Divorciado(a)</option>
                                <option value="4" @if(isset($data)) {{ $data->marital_status == 4  ? 'selected' : '' }} @endif>Viúvo(a)</option>
                                <option value="5" @if(isset($data)) {{ $data->marital_status == 5  ? 'selected' : '' }} @endif>União estável</option>
                                <option value="6" @if(isset($data)) {{ $data->marital_status == 6  ? 'selected' : '' }} @endif>Outros</option>
                            </select>
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