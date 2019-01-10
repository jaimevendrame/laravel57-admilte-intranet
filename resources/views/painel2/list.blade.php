@extends('painel2.template')
@section('conteudo')
    <div class="title-pg">
        <h1 class="title-pg">Listagem dos Itens</h1>
    </div>

    <div class="content-din bg-white">

        <div class="form-search">
            <form class="form form-inline">
                <input type="text" name="nome" placeholder="Nome:" class="form-control">
                <input type="text" name="email" placeholder="E-mail:" class="form-control">

                <button class="btn btn-search">Pesquisar</button>
            </form>
        </div>

        <div class="class-btn-insert">
            <a href="?pag=forms" class="btn-insert">
                <span class="glyphicon glyphicon-plus"></span>
                Cadastrar
            </a>
        </div>

        <table class="table table-striped">
            <tr>
                <th>Nome</th>
                <th>E-mail</th>
                <th>Facebook</th>
                <th>Twitter</th>
                <th>GitHub</th>
                <th width="150">Ações</th>
            </tr>
            @forelse($users as $user)
                <tr>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->facebook}}</td>
                    <td>{{$user->twitter}}</td>
                    <td>{{$user->github}}</td>
                    <td>
                        <a href='{{route('usuarios.edit', $user->id)}}' class="btn btn-success btn-xs"><i class="fa fa-edit"></i></a>
                        <a href="{{route('usuarios.show', $user->id)}}" class="btn btn-info btn-xs"><i class="fa fa-eye"></i></a>

                    </td>
                </tr>
            @empty
                <div class="box-body">
                    Nenhum usuário cadastrado
                </div>
            @endforelse
        </table>

        <nav aria-label="Page navigation">
            <ul class="pagination">
                <li>
                    <a href="#" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>
                <li><a href="#">1</a></li>
                <li><a href="#">2</a></li>
                <li><a href="#">3</a></li>
                <li><a href="#">4</a></li>
                <li><a href="#">5</a></li>
                <li>
                    <a href="#" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            </ul>
        </nav>

    </div><!--Content Dinâmico-->
@endsection