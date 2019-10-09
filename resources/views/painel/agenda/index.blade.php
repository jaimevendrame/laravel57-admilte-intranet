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
                            <td>{{ $data->sector->name }}</td>
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
            <div class="modal-content bg-gray-light ">
{{--                <div class="modal-header">--}}
{{--                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>--}}
{{--                    <h4 class="modal-title" id="myModalLabel">Ramal</h4>--}}
{{--                </div>--}}
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <!-- Widget: user widget style 1 -->
                            <div class="box box-widget widget-user-2">
                                <!-- Add the bg color to the header using any of the bg-* classes -->
                                <div class="widget-user-header bg-light-blue-gradient">
                                    <div class="widget-user-image" >

                                        <img class="img-circle" src="{{asset('storage/imgs/avatar.png')}}" alt="User Avatar" id="_image" style="width: 65px !important; height: 65px !important;">
                                    </div>
                                    <!-- /.widget-user-image -->
                                    <h3 class="widget-user-username" id="_nome"></h3>
                                    <h5 class="widget-user-desc" id="_ramal"></h5>
                                </div>
                                <div class="box-footer no-padding">
                                    <ul class="nav nav-stacked">
                                        <li><a href="#">Email <span class="pull-right text-bold" id="_email">...</span></a></li>
                                        <li><a href="#">Telefone <span class="pull-right text-bold" id="_telefone">...</span></a></li>
                                        <li><a href="#">Celular 1 <span class="pull-right text-bold" id="_cell1">...</span></a></li>
                                        <li><a href="#">Celular 2 <span class="pull-right text-bold" id="_cell2">...</span></a></li>
                                        <li><a href="#">Aniversário <span class="pull-right text-bold" id="_niver">...</span></a></li>

                                    </ul>
                                </div>
                            </div>
                            <!-- /.widget-user -->
                        </div>
                    </div>
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

               document.getElementById("_ramal").innerHTML = "Ramal: "+data.ramal;
               document.getElementById("_nome").innerHTML = ""+data.nome_razao+ " "+data.sobrenome_fantasia;
               document.getElementById("_email").innerHTML = data.email;
               document.getElementById("_telefone").innerHTML = data.fone_principal;
               document.getElementById("_cell1").innerHTML = data.fone_cell_1;
               document.getElementById("_cell2").innerHTML = data.fone_cell_2;
               document.getElementById("_niver").innerHTML = data.birth_date_fundacao;
               if(data.image != null){
                   document.getElementById("_image").src = '/storage/pessoas/'+data.image+'';
               } else {
                   document.getElementById("_image").src = "{{URL::asset('/assets/uploads/users/no-image.png')}}";

               }

           });



        jQuery("#myModal").modal("show");

           return false
       }

    </script>

@stop