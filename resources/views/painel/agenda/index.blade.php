@extends('adminlte::page')

@section('title', 'Agenda')

@section('content_header')
    <h1>Agenda Corporativa<small>{{$title}}</small></h1>

    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>Dashboard</a></li>
        <li><a href="#">Agenda</a></li>

    </ol>
@stop

@section('content')
    <div class="box box-primary">
        <div class="box-header">


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
                        <th>Nome</th>
                        <th>Setor </th>
                        <th>Ramal</th>
                        <th width="150">Ações</th>
                    </tr>
                </thead>
                <tbody>
                        @forelse($datas as $data)
                        <tr>
                            <td>{{ Helper::shout( $data->pessoa->nome_razao. " " .$data->pessoa->sobrenome_fantasia) }}</td>
                            <td>{{ $data->sector->label }}</td>
                            <td>{{ $data->ramal }}</td>

                            <td>
                                <a href="#" class="btn btn-info btn-xs" onclick='show("/painel/agenda/show/{{$data->id}}")'>
                                    <i class="fa fa-eye"></i>
                                </a>

                            </td>
                        </tr>
                        @empty
                        <div class="box-body">
                            Nenhum registro cadastrada
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

    <!-- Button trigger modal -->
{{--    <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">--}}
{{--        Abrir modal de demonstração--}}
{{--    </button>--}}

    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Ramal</h4>
                </div>
                <div class="modal-body">
                    <form id="modalFormData" name="modalFormData" class="form-horizontal" novalidate="">

                        <div class="form-group">
                            <label for="nome" class="col-sm-2 control-label">Nome </label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="nome" name="nome">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email" class="col-sm-2 control-label">Email </label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="email" name="email">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="niver" class="col-sm-2 control-label">Aniversário </label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="niver" name="niver">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="fone_principal" class="col-sm-2 control-label">Telefone Principal </label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="fone_principal" name="fone_principal">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="fone_cell1" class="col-sm-2 control-label">Celular 1 </label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="fone_cell1" name="fone_cell1">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="fone_cell2" class="col-sm-2 control-label">Celular 2 </label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="fone_cell2" name="fone_cell2">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>


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
        "order": [[ 2, "desc" ], [ 0, "desc"]],
        "lengthMenu": [[15, 30, 50, -1], [15, 30, 50, "Todos"]],
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

    <script>
       function show(url) {
           // alert(url);

           $.getJSON(url, function (data) {

               document.getElementById("myModalLabel").innerHTML = "Ramal "+data.ramal;
               // jQuery('#myModalLabel').innerHTML(data.ramal);

               jQuery('#nome').val(data.nome_razao+ " "+data.sobrenome_fantasia);
               jQuery('#niver').val(data.birth_date_fundacao);
               jQuery('#email').val(data.email);
               jQuery('#fone_principal').val(data.fone_principal);
               jQuery('#fone_cell1').val(data.fone_cell_1);
               jQuery('#fone_cell2').val(data.fone_cell_2);



           });



        jQuery("#myModal").modal("show");

           return false
       }

    </script>

@stop