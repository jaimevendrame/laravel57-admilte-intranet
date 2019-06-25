<?php

namespace App\Http\Controllers\Painel;

use App\Http\Controllers\StandardController;
use App\Models\Parlamentar;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ParlamentarController extends StandardController
{
    protected $model;
    protected $view = 'painel.parlamentares';
    protected $nameSmall = 'Parlamentar';
    protected $upload = ['image'=> 'file', 'path' => 'parlamentares'];
    protected $route = 'parlamentares';

    public function __construct(Parlamentar $parlamentar)
    {
        $this->model = $parlamentar;
        $this->middleware('can:parlamentares');

    }

    public function create()
    {
        $title = "Cadastrar {$this->nameSmall}";
        $dataUsers = User::get();

        return view("{$this->view}.create-edit", compact('data', 'title', 'dataUsers'));
    }

    public function edit($id)
    {
        //Recuperar usuário pelo id
        $data = $this->model->find($id);

        $dataUsers = User::get();

        $title = "Editar {$this->nameSmall}s";

        return view("{$this->view}.create-edit", compact('data', 'title', 'dataUsers'));
    }
}
