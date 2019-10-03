@extends('adminlte::page')

@section('title', 'Gestão de Pessoas')

@section('content_header')
    <h1>Gestão de pessoas <small>{{$title}}</small></h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>Dashboard</a></li>
        <li><a href="#">Pessoas</a></li>

    </ol>
@stop

@section('content')
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">{{$title}}</h3>
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
                <form role="form" method="post" action="{{route('pessoas.update', $data->id)}}" enctype="multipart/form-data">
                    {{ method_field('PUT') }}
                @else
                <form role="form" method="post" action="{{route('pessoas.store')}}" enctype="multipart/form-data">
                @endif
                    {{ csrf_field() }}
                    <div class="box-body">
                        <div class="row">
                            <div class="form-group col-md-9 col-sm-12">
                                <label class="col-md-3">
                                    <input id="radio_pf" type="radio" name="tipo_pessoa" class="minimal"  {{ old('tipo_pessoa') == 0 ? 'checked': '' }} onclick="checkRadio('pf')" value="0" >
                                    Pessoal Física
                                </label>

                                <label>
                                    <input id="radio_pj" type="radio" name="tipo_pessoa" class="minimal" {{ old('tipo_pessoa') == 1 ? 'checked': '' }} onclick="checkRadio('pj')" value="1">
                                    Pessoal Jurídica
                                </label>
                            </div>

                        </div>
                        <!-- radio -->

                        <div class="form-group col-md-6 col-sm-12">
                            <label id="LabelNameRazao" for="InputNameRazao">Primeiro Nome</label>
                            <input type="text" class="form-control" id="InputNameRazao" name="nome_razao" placeholder="Primeiro Nome" value="{{$data->nome_razao ?? old('nome_razao')}}">
                        </div>

                        <div class="form-group col-md-6 col-sm-12">
                            <label id="LabelSobrenomeFantasia" for="InputSobrenomeFantasia">Sobrenome</label>
                            <input type="text" class="form-control" id="InputSobrenomeFantasia" name="sobrenome_fantasia" placeholder="Sobrenome" value="{{$data->sobrenome_fantasia ?? old('sobrenome_fantasia')}}">
                        </div>

                        <div class="form-group col-md-4 col-sm-12">
                            <label id="LabelCPF" for="InputCPF">CPF</label>
                            <input type="text" class="form-control cpf" id="InputCPF" name="cpf_cnpj" placeholder="CPF" value="{{$data->cpf_cnpj ?? old('cpf_cnpj')}}">
                        </div>

                        <div class="form-group col-md-4 col-sm-12">
                            <label id="LabelRG" for="InputRG">RG</label>
                            <input type="text" class="form-control" id="InputRG" name="rg_ie" placeholder="RG" value="{{$data->rg_ie ?? old('rg_ie')}}">
                        </div>

                        <div class="form-group col-md-4">
                            <label>Selecione o status da Pessoa</label>
                            <select class="form-control" name="status" id="status">
                                <option value="A" @if( isset($data['status'])) {{$data['status'] == 'A'? 'selected':''}}@endif>Ativo</option>
                                <option value="I" @if( isset($data['status'])) {{$data['status'] == 'I'? 'selected':''}}@endif>Inativo</option>
                            </select>
                        </div>


                        <!-- Pessoa Física -->

                        <div class="form-group col-md-4 col-sm-12">
                            <label id="LabelBirthDate" for="InputBirthDate">Data Nascimento</label>
                            <input type="date" class="form-control" id="InputBirthDate" name="birth_date_fundacao" placeholder="Data Nascimento" value="{{$data->birth_date_fundacao ?? old('birth_date_fundacao')}}">
                        </div>
                        <div id="sexo" class="form-group col-md-4">
                            <label>Sexo:</label>
                            <select class="form-control" name="sex" id="sex">
                                <option value="N" @if( isset($data['sex'])) {{$data['sex'] == 'N'? 'selected':''}}@endif>Não informado</option>
                                <option value="M" @if( isset($data['sex'])) {{$data['sex'] == 'M'? 'selected':''}}@endif>Masculino</option>
                                <option value="F" @if( isset($data['sex'])) {{$data['sex'] == 'F'? 'selected':''}}@endif>Feminino</option>
                            </select>
                        </div>
                        <div class="form-group col-md-4" id="div_marital_status">
                            <label>Estado Civil:</label>
                            <select class="form-control" name="marital_status" id="marital_status">
                                <option value="0" @if( isset($data['marital_status'])) {{$data['marital_status'] == '0'? 'selected':''}}@endif>Não informado</option>
                                <option value="1" @if( isset($data['marital_status'])) {{$data['marital_status'] == '1'? 'selected':''}}@endif>Solteiro(a)</option>
                                <option value="2" @if( isset($data['marital_status'])) {{$data['marital_status'] == '2'? 'selected':''}}@endif>Casado(a)</option>
                                <option value="3" @if( isset($data['marital_status'])) {{$data['marital_status'] == '3'? 'selected':''}}@endif>Desquitado(a)/Separado(a)</option>
                                <option value="7" @if( isset($data['marital_status'])) {{$data['marital_status'] == '7'? 'selected':''}}@endif>Divorciado(a)</option>
                                <option value="4" @if( isset($data['marital_status'])) {{$data['marital_status'] == '4'? 'selected':''}}@endif>Viúvo(a)</option>
                                <option value="5" @if( isset($data['marital_status'])) {{$data['marital_status'] == '5'? 'selected':''}}@endif>União estável</option>
                                <option value="6" @if( isset($data['marital_status'])) {{$data['marital_status'] == '6'? 'selected':''}}@endif>Outros</option>
                            </select>
                        </div>

                        <div class="col-md-10">
                            <div class="nav-tabs-custom">
                                <ul class="nav nav-tabs">
                                    <li class="active"><a href="#endereco" data-toggle="tab">ENDEREÇOS</a></li>
                                    <li><a href="#contato" data-toggle="tab">CONTATOS</a></li>
                                    <li><a href="#diversos" data-toggle="tab">DIVERSOS</a></li>
                                </ul>
                                <div class="tab-content">
                                    <div class="active tab-pane" id="endereco">
                                        <div class="nav-tabs-custom">
                                            <ul class="nav nav-tabs">
                                                <li class="active"><a href="#principal" data-toggle="tab">Endereço Principal</a></li>
                                                <li><a href="#comercial" data-toggle="tab">Endereço Comercial</a></li>
                                                <li><a href="#correspondencia" data-toggle="tab">Endereço de Correspondência</a></li>
                                            </ul>
                                            <div class="tab-content">
                                                <div class="active tab-pane" id="principal">
                                                    <div class="row">
                                                        <div class="form-horizontal">
                                                            <div class="form-group">
                                                                <label for="InputCepRes" class="col-sm-2 control-label">CEP</label>
                                                                <div class="col-md-2">
                                                                    <input type="text" class="form-control cep" id="InputCepRes" name="cep_res" placeholder="CEP" value="{{$data->cep_res ?? old('cep_res')}}"
                                                                           onblur="pesquisacep(this.value, 'Res');">
                                                                </div>'
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="InputUfRes" class="col-sm-2 control-label">Estado</label>
                                                                <div class="col-md-2">
                                                                    <input type="text" class="form-control" id="InputUfRes" name="uf_res" placeholder="Estado" value="{{$data->uf_res ?? old('uf_res')}}" readonly>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="InputCidadeRes" class="col-sm-2 control-label">Cidade</label>
                                                                <div class="col-md-4">
                                                                    <input type="text" class="form-control" id="InputCidadeRes" name="cidade_res" placeholder="Cidade" value="{{$data->cidade_res ?? old('cidade_res')}}" readonly>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="InputBairroRes" class="col-sm-2 control-label">Bairro</label>
                                                                <div class="col-md-4">
                                                                    <input type="text" class="form-control" id="InputBairroRes" name="bairro_res" placeholder="Bairro" value="{{$data->bairro_res ?? old('bairro_res')}}">
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="InputLougradouroRes" class="col-sm-2 control-label">Lougradouro</label>
                                                                <div class="col-md-6">
                                                                    <input type="text" class="form-control" id="InputLougradouroRes" name="lougradouro_res" placeholder="Lougradouro" value="{{$data->lougradouro_res ?? old('lougradouro_res')}}">
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="InputNumeroRes" class="col-sm-2 control-label">Número</label>
                                                                <div class="col-md-2">
                                                                    <input type="text" class="form-control" id="InputNumeroRes" name="numero_res" placeholder="Número" value="{{$data->numero_res ?? old('numero_res')}}">
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="InputComplementoRes" class="col-sm-2 control-label">Complemento</label>
                                                                <div class="col-md-6">
                                                                    <input type="text" class="form-control" id="InputComplementoRes" name="complemento_res" placeholder="Complemento" value="{{$data->complemento_res ?? old('complemento_res')}}">
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="InputPontoReferenciaRes" class="col-sm-2 control-label">Ponto de referência</label>
                                                                <div class="col-md-6">
                                                                    <input type="text" class="form-control" id="InputPontoReferenciaRes" name="ponto_referencia_res" placeholder="Ponto de referência" value="{{$data->ponto_referencia_res ?? old('ponto_referencia_res')}}">
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="InputIbgeRes" class="col-sm-2 control-label">IBGE</label>
                                                                <div class="col-md-2">
                                                                    <input type="text" class="form-control" id="InputIbgeRes" name="ibge_cidade_id_res" placeholder="IBGE" value="{{$data->ibge_cidade_id_res ?? old('ibge_cidade_id_res')}}" readonly>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- /.tab-pane -->
                                                <div class="tab-pane" id="comercial">
                                                    <div class="row">
                                                        <div class="form-horizontal">
                                                            <div class="form-group">
                                                                <label for="InputCepCom" class="col-sm-2 control-label">CEP</label>
                                                                <div class="col-md-2">
                                                                    <input type="text" class="form-control cep" id="InputCepCom" name="cep_com" placeholder="CEP" value="{{$data->cep_com ?? old('cep_com')}}"
                                                                           onblur="pesquisacep(this.value, 'Com');">
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="InputUfCom" class="col-sm-2 control-label">Estado</label>
                                                                <div class="col-md-2">
                                                                    <input type="text" class="form-control" id="InputUfCom" name="uf_com" placeholder="Estado" value="{{$data->uf_com ?? old('uf_com')}}" readonly>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="InputCidadeCom" class="col-sm-2 control-label">Cidade</label>
                                                                <div class="col-md-4">
                                                                    <input type="text" class="form-control" id="InputCidadeCom" name="cidade_com" placeholder="Cidade" value="{{$data->cidade_com ?? old('cidade_com')}}" readonly>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="InputBairroCom" class="col-sm-2 control-label">Bairro</label>
                                                                <div class="col-md-4">
                                                                    <input type="text" class="form-control" id="InputBairroCom" name="bairro_com" placeholder="Bairro" value="{{$data->bairro_com ?? old('bairro_com')}}">
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="InputLougradouroCom" class="col-sm-2 control-label">Lougradouro</label>
                                                                <div class="col-md-6">
                                                                    <input type="text" class="form-control" id="InputLougradouroCom" name="lougradouro_com" placeholder="Lougradouro" value="{{$data->lougradouro_com ?? old('lougradouro_com')}}">
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="InputNumeroCom" class="col-sm-2 control-label">Número</label>
                                                                <div class="col-md-2">
                                                                    <input type="text" class="form-control" id="InputNumeroCom" name="numero_com" placeholder="Número" value="{{$data->numero_com ?? old('numero_com')}}">
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="InputComplementoCom" class="col-sm-2 control-label">Complemento</label>
                                                                <div class="col-md-6">
                                                                    <input type="text" class="form-control" id="InputComplementoCom" name="complemento_com" placeholder="Complemento" value="{{$data->v ?? old('complemento_com')}}">
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="InputPontoReferenciaCom" class="col-sm-2 control-label">Ponto de referência</label>
                                                                <div class="col-md-6">
                                                                    <input type="text" class="form-control" id="InputPontoReferenciaCom" name="ponto_referencia_com" placeholder="Ponto de referência" value="{{$data->ponto_referencia_com ?? old('ponto_referencia_com')}}">
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="InputIbgeCom" class="col-sm-2 control-label">IBGE</label>
                                                                <div class="col-md-2">
                                                                    <input type="text" class="form-control" id="InputIbgeCom" name="ibge_cidade_id_com" placeholder="IBGE" value="{{$data->ibge_cidade_id_com ?? old('ibge_cidade_id_com')}}" readonly>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- /.tab-pane -->
                                                <div class="tab-pane" id="correspondencia">
                                                    <div class="row">
                                                        <div class="form-horizontal">
                                                            <div class="form-group">
                                                                <label for="InputCepCor" class="col-sm-2 control-label">CEP</label>
                                                                <div class="col-md-2">
                                                                    <input type="text" class="form-control cep" id="InputCepCor" name="cep_cor" placeholder="CEP" value="{{$data->cep_cor ?? old('cep_cor')}}"
                                                                           onblur="pesquisacep(this.value, 'Cor');">
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="InputUfCor" class="col-sm-2 control-label">Estado</label>
                                                                <div class="col-md-2">
                                                                    <input type="text" class="form-control" id="InputUfCor" name="uf_cor" placeholder="Estado" value="{{$data->uf_cor ?? old('uf_cor')}}" readonly>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="InputCidadeCor" class="col-sm-2 control-label">Cidade</label>
                                                                <div class="col-md-4">
                                                                    <input type="text" class="form-control" id="InputCidadeCor" name="cidade_cor" placeholder="Cidade" value="{{$data->cidade_cor ?? old('cidade_cor')}}" readonly>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="InputBairroCor" class="col-sm-2 control-label">Bairro</label>
                                                                <div class="col-md-4">
                                                                    <input type="text" class="form-control" id="InputBairroCor" name="bairro_cor" placeholder="Bairro" value="{{$data->bairro_cor ?? old('bairro_cor')}}">
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="InputLougradouroCor" class="col-sm-2 control-label">Lougradouro</label>
                                                                <div class="col-md-6">
                                                                    <input type="text" class="form-control" id="InputLougradouroCor" name="lougradouro_cor" placeholder="Lougradouro" value="{{$data->lougradouro_cor ?? old('lougradouro_cor')}}">
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="InputNumeroCor" class="col-sm-2 control-label">Número</label>
                                                                <div class="col-md-2">
                                                                    <input type="text" class="form-control" id="InputNumeroCor" name="numero_cor" placeholder="Número" value="{{$data->numero_cor ?? old('numero_cor')}}">
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="InputComplementoCor" class="col-sm-2 control-label">Complemento</label>
                                                                <div class="col-md-6">
                                                                    <input type="text" class="form-control" id="InputComplementoCor" name="complemento_cor" placeholder="Complemento" value="{{$data->complemento_cor ?? old('complemento_cor')}}">
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="InputPontoReferenciaCor" class="col-sm-2 control-label">Ponto de referência</label>
                                                                <div class="col-md-6">
                                                                    <input type="text" class="form-control" id="InputPontoReferenciaCor" name="ponto_referencia_cor" placeholder="Ponto de referência" value="{{$data->ponto_referencia_cor ?? old('ponto_referencia_cor')}}">
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="InputIbgeCor" class="col-sm-2 control-label">IBGE</label>
                                                                <div class="col-md-2">
                                                                    <input type="text" class="form-control" id="InputIbgeCor" name="ibge_cidade_id_cor" placeholder="IBGE" value="{{$data->ibge_cidade_id_cor ?? old('ibge_cidade_id_cors')}}" readonly>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                                <!-- /.tab-pane -->

                                            </div>
                                            <!-- /.tab-content -->
                                        </div>
                                        <!-- /.nav-tabs-custom -->

                                    </div>
                                    <!-- /.tab-pane -->
                                    <div class="tab-pane" id="contato">

                                        <div class="row">
                                            <div class="form-horizontal">

                                                <div class="form-group">
                                                    <label for="InputEmail" class="col-sm-2 control-label">Email</label>
                                                    <div class="col-md-4">
                                                        <input type="text" class="form-control" id="InputEmail" name="email" placeholder="Email Principal" value="{{$data->email ?? old('email')}}">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="InputEmailAlt" class="col-sm-2 control-label">Email Alternativo</label>
                                                    <div class="col-md-4">
                                                        <input type="text" class="form-control" id="InputEmailAlt" name="email_a" placeholder="Email Alternativo" value="{{$data->email_a ?? old('email_a')}}">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="InputFonePrincipal" class="col-sm-2 control-label">Telefone Principal</label>
                                                    <div class="col-md-4">
                                                        <input type="text" class="form-control fone" id="InputFonePrincipal" name="fone_principal" placeholder="Telefone Principal" value="{{$data->fone_principal ?? old('fone_principal')}}">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="InputFoneCell1" class="col-sm-2 control-label">Telefone Celula 1</label>
                                                    <div class="col-md-4">
                                                        <input type="text" class="form-control cell" id="InputFoneCell1" name="fone_cell_1" placeholder="Telefone Celular 1" value="{{$data->fone_cell_1 ?? old('fone_cell_1')}}">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="InputFoneCell2" class="col-sm-2 control-label">Telefone Celula 2</label>
                                                    <div class="col-md-4">
                                                        <input type="text" class="form-control cell" id="InputFoneCell2" name="fone_cell_2" placeholder="Telefone Celular 2" value="{{$data->fone_cell_2 ?? old('fone_cell_2')}}">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="InputFoneComercial" class="col-sm-2 control-label">Telefone Comercial</label>
                                                    <div class="col-md-4">
                                                        <input type="text" class="form-control fone" id="InputFoneComercial" name="fone_comercial" placeholder="Telefone Comercial" value="{{$data->fone_comercial ?? old('fone_comercial')}}">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="InputFoneFax" class="col-sm-2 control-label">Telefone Fax</label>
                                                    <div class="col-md-4">
                                                        <input type="text" class="form-control fone" id="InputFoneFax" name="fone_fax" placeholder="Telefone Fax" value="{{$data->fone_fax ?? old('fone_fax')}}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <!-- /.tab-pane -->
                                    <div class="tab-pane" id="diversos">
                                        <div class="row">
                                            <div class="form-group col-md-12">
                                                <div class="checkbox">
                                                    <label>
                                                        <input type="checkbox" name="featured" @if(isset($data)&& $data->featured == 1) checked @endif> Destaque?
                                                    </label>
                                                </div>
                                                <div class="checkbox">
                                                    <label>
                                                        <input type="checkbox" name="colaborador" @if(isset($data)&& $data->colaborador == 1) checked @endif> Colaborador?
                                                    </label>
                                                </div>
                                                <div class="checkbox">
                                                    <label>
                                                        <input type="checkbox" name="fornecedor" @if(isset($data)&& $data->fornecedor == 1) checked @endif> Fornecedor?
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-6">
                                                <label for="InputFile">Imagem Principal</label>
                                                <input type="file" id="InputFile" name="image">

                                                <p class="help-block">Utlize um imagem de no máximo 2 MB.</p>
                                            </div>
                                            <div class="form-group col-md-6">
                                                @if (isset($data->image))
                                                    <img src="{{ asset("storage/pessoas/{$data->image}") }}" alt="{{$data->name ?? '' }}" class="img-responsive img-rounded img-bordered">
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.tab-pane -->

                                </div>
                                <!-- /.tab-content -->
                            </div>
                            <!-- /.nav-tabs-custom -->



                        </div>
                        <!-- /.col -->

                    </div>
                    <!-- /.box-body -->

                    <div class="box-footer">
                        <div class="form-group col-md-4">
                            <button type="submit" class="btn btn-success">Enviar</button>
                            <button type="reset" class="btn btn-danger">Limpar</button>
                            <a href="{{route('pessoas.index')}}" class="btn btn-info"><i class="fa fa-undo"></i>  Voltar</a>
                        </div>
                    </div>
                </form>
            </div>
            <!-- /.box -->
@stop
@section('js')

<script type="text/javascript">

    $(document).ready(function() {

        // $('.cpf').mask('000.000.000-00');
        $('.cep').mask('00.000-000');
        $('.fone').mask('(00) 0000-0000');
        $('.cell').mask('(00) 00000-0000');

        var cpfMascara = function (val) {
                return val.replace(/\D/g, '').length > 11 ? '00.000.000/0000-00' : '000.000.000-009';
            },
            cpfOptions = {
                onKeyPress: function(val, e, field, options) {
                    field.mask(cpfMascara.apply({}, arguments), options);
                }
            };
        $('.cpf').mask(cpfMascara, cpfOptions);
        @if (isset($data['tipo_pessoa']))
        document.getElementById("radio_pf").disabled = true;
        document.getElementById("radio_pj").disabled = true;

        @if($data['tipo_pessoa'] == 0)
        document.getElementById("radio_pf").checked = true;
        checkRadio('pf');
        @else
        document.getElementById("radio_pj").checked = true;
        checkRadio('pj');
                @endif
                @endif

        var checkedPF = document.getElementById("radio_pf").checked;
        if ( checkedPF ){
            checkRadio('pf');
        } else {
            checkRadio('pj');
        }

    });

</script>



<script type="text/javascript" src="{{url('assets/js/jquery.mask.js')}}"></script>
<script type="text/javascript" src="{{url('assets/js/cep.js')}}"></script>
<script type="text/javascript" src="{{url('assets/js/helper.js')}}"></script>


@stop