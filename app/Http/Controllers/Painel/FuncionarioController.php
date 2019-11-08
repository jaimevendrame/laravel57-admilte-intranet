<?php

namespace App\Http\Controllers\Painel;

use App\Http\Controllers\StandardController;
use App\Models\Funcionario;
use App\Models\Pessoa;
use App\Models\Sector;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Mime\RawMessage;

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



    public function users($pessoa_id){

//        $pessoa = $this->model->pessoa->find($pessoa_id);

        $pessoa = Pessoa::find($pessoa_id);


        $users = $pessoa->user()->distinct('user_id')->paginate($this->totalPage);

        $title = "usuário vinculado a colaborador: {$pessoa->nome_razao}  {$pessoa->sobrenome_fantasia}";

//        dd($users);

        return view('painel.funcionarios.users', compact('pessoa', 'users', 'title'));
    }

    public function usersAdd($pessoa_id)
    {

        $pessoa = Pessoa::find($pessoa_id);



        $users=DB::table('users')
            ->whereNotIn('id',function ($query) {
                $query->select('user_id')->from('pessoas')
                    ->Where('user_id','<>',null);
            })
            ->get();

        $title = "Adicionar usuários a pessoa: {$pessoa->nome_razao} {$pessoa->sobrenome_fantasia}";

        return view('painel.funcionarios.users-add', compact('pessoa','users', 'title'));

    }

    public function usersAddPessoa(Request $request, $id)
    {

        $user_id = implode("", $request->get('users'));

//        dd($user_id);
        $pessoa = Pessoa::find($id);

        $pessoa->user_id = $user_id;
        $pessoa->save();

        return redirect()->route('funcionario.user', $id)->with(['success' => 'Vinculo realizado com sucesso']);
    }

    public function deleteUser($id)
    {
        $pessoa = Pessoa::find($id);

        $pessoa->user_id =null;
        $pessoa->save();

        return redirect()->route('funcionario.user', $id)->with(['success' => 'Removido com sucesso!']);

    }

    public function createUser($id){

        $data = Pessoa::find($id);

        $rules =[
            'name'          => 'required|min:3|max:255',
            'last_name'     => 'required|min:3|max:255',
            'email'         => "required|min:3|max:100|email|unique:users,email",
            'password'      => "required|min:3|max:200",
            'rg'            => 'required|max:14',
            'cpf'           => "required|cpf|unique:users,cpf",
            'birth_date'    => 'required|date',
            'sex'           => 'required',
            'marital_status'=> 'required',
            'image'         => 'image|max:2048',
        ];

        $dataForm = [
            'name' => $data['nome_razao'],
            'last_name' => $data['sobrenome_fantasia'],
            'email' => $data['email'],
            'password' => bcrypt('Mudar123'),
            'rg' => $data['rg_ie'],
            'cpf' => $data['cpf_cnpj'],
            'birth_date' => $data['birth_date_fundacao'],
            'sex' => $data['sex'],
            'marital_status' => $data['marital_status'],
            ];



        $request = new Request($dataForm);


        $this->validate($request, $rules);

        //inserir os dados
        $insert = User::create($dataForm);

        if($insert)
            return redirect()
                ->route("funcionario.users.add", $id)
                ->with(['success'=>'Cadastro realizado com sucesso!']);
        else
            return redirect()
                ->route("funcionario.users.add", $id)
                ->withErrors(['errors' => 'Falha ao cadastrar'])
                ->withInput();


    }
}
