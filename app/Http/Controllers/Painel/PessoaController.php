<?php

namespace App\Http\Controllers\Painel;

use App\Models\PessoaFisica;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\StandardController;
use App\Models\Pessoa;

class PessoaController extends StandardController
{
    protected $model;
    protected $view = 'painel.pessoas';
    protected $nameSmall = 'Pessoa';
    protected $upload = ['image'=> 'image', 'path' => 'pessoas'];
    protected $route = 'pessoas';

    public function __construct(Pessoa $pessoa)
    {
        $this->model = $pessoa;
        $this->middleware('can:pessoas');
    }

    public function create()
    {
        $title = "Cadastrar {$this->nameSmall}";
        $dataUsers = User::get();

        return view("{$this->view}.create-edit", compact('title', 'dataUsers'));
    }

    public function store(Request $request)
    {

//        dd($request);


        //valida os dados
        $this->validate($request, $this->model->rules());
        //pegar todos dados do formulário
        $dataForm = $request->all();

        //Verificar se existe a imagem
        if ( $this->upload && $request->hasFile($this->upload['image'])){
            //pegar a imagem
            $image = $request->file($this->upload['image']);

            //Definir no nome da imagem
            $nameFile = uniqid(date('YmdHis')).'.'.$image->getClientOriginalExtension();

            $upload = $image->storeAs($this->upload['path'], $nameFile,$this->disk ?? 'local');

            if ( $upload )
                $dataForm[$this->upload['image']] = $nameFile;
            else
                return redirect()
                    ->route("{$this->route}.create")
                    ->withErrors(['errors' => 'Erro no upload da imagem'])
                    ->withInput();
        }


        //inserir os dados generico de pessoa
        $insert = $this->model->create($dataForm);

        if($insert)
            return redirect()
                ->route("{$this->route}.index")
                ->with(['success'=>'Cadastro realizado com sucesso!']);
        else
            return redirect()
                ->route("{$this->route}.create")
                ->withErrors(['errors' => 'Falha ao cadastrar'])
                ->withInput();
    }

}
