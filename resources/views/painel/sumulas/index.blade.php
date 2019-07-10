@extends('adminlte::page')

@section('title', 'Gestão de súmulas')

@section('content_header')
    <h1>Gestão de súmulas <small>{{$title}}</small></h1>

    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>Dashboard</a></li>
        <li><a href="#">Súmulas</a></li>

    </ol>
@stop

@section('content')
    <div class="box box-primary">
        <div class="box-header">
            <h3 class="box-title">
                <a href="{{route('sumulas.create')}}" class="btn btn-primary btn-lg"><i class="fa fa-plus"></i> NOVA SÚMULA</a>
            </h3>
            {{-- <div class="box-tools pull-right">
                    <form class="form-inline" role="form" method="post" action="{{url('painel/sumulas/pesquisar')}}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="input-group input-group-sm" style="width: 100px;">
                            <select class="form-control select2" name="status" id="status">
                                <option value="T" @if( isset($dataForm['status'])) {{$dataForm['status'] == 'T'? 'selected':''}} @else @endif >Todas</option>
                                <option value="A" @if( isset($dataForm['status'])) {{$dataForm['status'] == 'A'? 'selected':''}} @else @endif >Ativo</option>
                                <option value="P" @if( isset($dataForm['status'])) {{$dataForm['status'] == 'P'? 'selected':''}} @else @endif >Pendente</option>
                                <option value="C" @if( isset($dataForm['status'])) {{$dataForm['status'] == 'C'? 'selected':''}} @else @endif >Contrário</option>
                            </select>
                        </div>
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <input type="text" name="pesquisa" class="form-control pull-right" placeholder="Pesquisar">
                            <div class="input-group-btn">
                                <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                    </form>
            </div> --}}
        </div>

        <!-- /.box-header -->
        <div class="box-body table-responsive">
            @if( Session::has('success'))
                <div class="col-md-12">
                    <div class="alert alert-success alert-dismissible hide-msg">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h4><i class="icon fa fa-warning"></i> {{Session::get('success')}}</h4>

                    </div>
                </div>
            @endif
            <table class="table table-hover display" id="tabela">
                <thead>
                    <tr>
                        <th>Nº Protocolo</th>
                        <th>Data/Hora </th>
                        <th>Autor</th>
                        <th>Data início</th>
                        <th>Data fim</th>
                        <th>Expira em</th>
                        <th>Status</th>
                        <th width="150">Ações</th>
                    </tr>
                </thead>
                <tbody>
                        @forelse($datas as $data)
                        <tr {{ Helper::calcularDiasRestantesSumula($data->date_start) == 'VENCIDA'? 'class=danger': '' }}>
                            <td>{{$data->nr_protocolo}}</td>
                            <td>{{ \Carbon\Carbon::parse($data->date_protocolo)->format('d/m/Y'). " - " . \Carbon\Carbon::parse($data->hour_protocolo)->format('H:i') }}</td>
                            <td cla>{{$data->parlamentar->nome_parlamentar}}</td>
                            <td>{{ \Carbon\Carbon::parse($data->date_start)->format('d/m/Y') }}</td>
    
                            <td>
                                {{ \Carbon\Carbon::parse(Helper::calcularDataEndSumula($data->date_start,90))->format('d/m/Y') }}
                            </td>
                            <td>
                                {{ Helper::calcularDiasRestantesSumula($data->date_start)}}
                            </td>
    
                            <td>{{$data->status == 'A'? 'ATIVO': ($data->status == 'P'? 'PENDENTE': 'CONTRÁRIO')}} </td>
    
    
                            <td>
                                <a href='{{route('sumulas.edit', $data->id)}}' class="btn btn-success btn-xs"><i class="fa fa-edit"></i></a>
                                <a href="{{route('sumulas.show', $data->id)}}" class="btn btn-info btn-xs"><i class="fa fa-eye"></i></a>
                            </td>
                        </tr>
                        @empty
                        <div class="box-body">
                            Nenhuma súmula cadastrada
                        </div>
                        @endforelse
                </tbody>  
            </table>

            {{-- <div class="box-footer">
                @if(isset($dataForm))
                    {{$datas->appends(Request::only(['pesquisa','status']))->links()}}
                @else
                    {{$datas->links()}}
                @endif
            </div> --}}
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

    <script>


$(document).ready(function() {
    $('#tabela').DataTable({
        "order": [[ 0, "desc" ]]
        "language": {
            "sEmptyTable": "Nenhum registro encontrado",
            "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
            "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
            "sInfoFiltered": "(Filtrados de _MAX_ registros)",
            "sInfoPostFix": "",
            "sInfoThousands": ".",
            "sLengthMenu": "_MENU_ resultados por página",
            "sLoadingRecords": "Carregando...",
            "sProcessing": "Processando...",
            "sZeroRecords": "Nenhum registro encontrado",
            "sSearch": "Pesquisar",
            "oPaginate": {
                "sNext": "Próximo",
                "sPrevious": "Anterior",
                "sFirst": "Primeiro",
                "sLast": "Último"
            },
        "oAria": {
            "sSortAscending": ": Ordenar colunas de forma ascendente",
            "sSortDescending": ": Ordenar colunas de forma descendente"
            }
        }
    });
} );
    </script>
@stop