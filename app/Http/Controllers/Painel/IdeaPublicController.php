<?php

namespace App\Http\Controllers\Painel;

use App\Http\Controllers\StandardController;
use App\Models\Category;
use App\Models\Idea;
use App\Models\Sector;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;


class IdeaPublicController extends StandardController
{
    protected $model;
    protected $view = 'painel.ideas.public';
    protected $nameSmall = 'ideia';
    protected $upload = ['image'=> 'file', 'path' => 'ideas'];
    protected $route = 'ideas-public';

    public function __construct(Idea $idea)
    {
        $this->model = $idea;
//        $this->middleware('can:ideas_public');
//        $this->middleware('can:update_idea')->only(['update']);



    }

    public function create()
    {

        $title = "Cadastrar {$this->nameSmall}";

        $categories = Category::get();

        $sectories = Sector::get();


        return view("{$this->view}.create-edit", compact('title', 'categories', 'sectories'));
    }

    public function store(Request $request)
    {

        //valida os dados
        $this->validate($request, $this->model->rules());
        //pegar todos dados do formulário
        $dataForm = $request->all();

//        dd($dataForm);
        //pegar valor do checkbox featured (destaque)
        $dataForm['featured'] = isset( $dataForm['featured']) ? true : false;

        //pegar usuário logado
        $dataForm[ 'user_id'] = auth()->user()->id;

        //pegar data atual
        $dataForm[ 'date'] = Carbon::now()->format('Y-m-d');

        //pegar hora atual
        $dataForm[ 'hour'] = Carbon::now()->format('H:i:s');


        //Verificar se existe a imagem
        if ( $this->upload && $request->hasFile($this->upload['image'])){
            //pegar a imagem
            $image = $request->file($this->upload['image']);

            //Definir no nome da imagem
            $nameFile = uniqid(date('YmdHis')).'.'.$image->getClientOriginalExtension();

            $upload = $image->storeAs($this->upload['path'], $nameFile);

            if ( $upload )
                $dataForm[$this->upload['image']] = $nameFile;
            else
                return redirect()
                    ->route("{$this->route}.create")
                    ->withErrors(['errors' => 'Erro no upload da imagem'])
                    ->withInput();
        }


        //inserir os dados
        $insert = $this->model->create($dataForm);

        if($insert)
            return redirect()
                ->route("{$this->route}.public")
                ->with(['success'=>'Cadastro realizado com sucesso!']);
        else
            return redirect()
                ->route("{$this->route}.public.create")
                ->withErrors(['errors' => 'Falha ao cadastrar'])
                ->withInput();
    }

    public function show($id)
    {
        //Recuperar usuário
        $data = $this->model->find($id);

        //Permissao para edicao
        $this->authorize('owner', $data);

        $title = "Visualizar {$this->nameSmall}";

        return view("{$this->view}.show", compact('data', 'title'));
    }

    public function edit($id)
    {

        //Recuperar usuário pelo id
        $data = $this->model->find($id);

        //Permissao para edicao
        $this->authorize('owner', $data);
        $title = "Editar {$this->nameSmall}s";

        $categories = Category::get();


        return view("{$this->view}.create-edit", compact('data', 'title', 'categories'));
    }

    public function update(Request $request, $id)
    {


        $this->validate($request, $this->model->rules($id));


        $dataForm = $request->all();


//        dd($dataForm);

        //Criar objeto categorias
        $data = $this->model->find($id);

        //Permissao para edicao
        $this->authorize('owner', $data);

        //pegar valor do checkbox featured (destaque)
        $dataForm['featured'] = isset( $dataForm['featured']) ? true : false;

        //pegar usuário logado
        $dataForm[ 'user_id'] = $data->user_id;

        //pegar data atual
        $dataForm[ 'date'] = $data->date;

        //pegar hora atual
        $dataForm[ 'hour'] = $data->hour;


        //pegar hora atual
        $dataForm[ 'assessor_id'] = Auth::id();

        //Verificar se existe a imagem
        if ( $this->upload && $request->hasFile($this->upload['image'])){
            //pegar a imagem
            $image = $request->file($this->upload['image']);

//            dd($image);

            //Definir no nome da imagem
            if ($data->image == ''){
                $nameImage = uniqid(date('YmdHis')).'.'.$image->getClientOriginalExtension();
                $dataForm[$this->upload['image']] = $nameImage;
            } else {
                $nameImage = $data->image;
            }

            $upload = $image->storeAs($this->upload['path'], $nameImage);


            if ($upload )
                $dataForm[$this->upload['image']] = $nameImage;

            else
                return redirect()
                    ->route("{$this->route}.public.edit", ['id' => $id])
                    ->withErrors(['errors' => 'Erro no upload'])
                    ->withInput();

        }
        //Alterar os dados

        $update = $data->update($dataForm);


        if($update)
            return redirect()
                ->route("{$this->route}.index")
                ->with(['success'=>'Alteração realizada com sucesso!']);
        else
            return redirect()
                ->route("{$this->route}.public.edit", ['id' => $id])
                ->withErrors(['errors' => 'Falha ao editar'])
                ->withInput();
    }


    public function search(Request $request)
    {
        //Recupera os dados do formulário
        $dataForm = $request->get('pesquisa');

        $title = "Listagem {$this->nameSmall}s";

        //Filtra os usuários
        $datas = $this->model
            ->where('title', 'LIKE', "%{$dataForm}%")
            ->orWhere('description', 'LIKE', "%{$dataForm}%")
            ->orWhere('date', 'LIKE', "%{$dataForm}%")
            ->orWhere('hour', 'LIKE', "%{$dataForm}%")
            ->paginate($this->totalPage);

        return view("{$this->view}.index", compact('datas', 'dataForm', 'title'));
    }
}
