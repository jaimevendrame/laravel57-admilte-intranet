<?php

namespace App\Http\Controllers\Painel;

use App\Http\Controllers\StandardController;
use App\Models\Funcionario;
use App\Models\Pessoa;
use App\Models\Sector;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FuncionarioController extends StandardController
{
    protected $model;
    protected $view = 'painel.funcionarios';
    protected $nameSmall = 'Funcionário';
//    protected $upload = ['image'=> 'file', 'path' => 'funcionarios'];
    protected $route = 'funcionarios';

    public function __construct(Funcionario $funcionario)
    {
        $this->model = $funcionario;
        $this->middleware('can:funcionarios');

    }

    public function create()
    {
        $title = "Cadastrar {$this->nameSmall}";

//        $pessoas = Pessoa::where('colaborador',true)->pluck('id')->toArray();

        $funcionarios = $this->model->pluck('pessoa_id')->toArray();

//        dd($funcionarios);

        $pessoas = Pessoa::where('colaborador',true)->whereNotIn('id', $funcionarios)->get();

//        dd($pessoas);

        $sectores = Sector::get();


        return view("{$this->view}.create-edit", compact('title', 'pessoas', 'sectores'));
    }

    public function edit($id)
    {
        $title = "Editar {$this->nameSmall}";

        $data = $this->model->find($id);

//        $funcionarios = $this->model->pluck('pessoa_id')->toArray();

//        dd($funcionarios);

//        $pessoas = Pessoa::where('colaborador',true)->whereNotIn('id', $funcionarios)->get();

        $pessoas = Pessoa::where('colaborador',true)->get();

//        dd($resultado);

        $sectores = Sector::get();


        return view("{$this->view}.create-edit", compact('title', 'pessoas', 'sectores','data'));
    }

    public function search(Request $request)
    {
        //Recupera os dados do formulário
        $dataForm = $request->get('pesquisa');

//        dd($dataForm);
        $title = "Listagem {$this->nameSmall}s";

        //Filtra os usuários
        $datas = $this->model
            ->select(['funcionarios.*','pessoas.id as id_pessoa'])
            ->join('pessoas', 'funcionarios.pessoa_id', 'pessoas.id')
            ->where('pessoas.nome_razao', 'LIKE', "%{$dataForm}%")
            ->paginate($this->totalPage);


//        dd($datas);

        return view("{$this->view}.index", compact('datas', 'dataForm', 'title'));
    }


}
