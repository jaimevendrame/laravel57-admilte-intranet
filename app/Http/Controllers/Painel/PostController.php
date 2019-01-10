<?php

namespace App\Http\Controllers\Painel;

use App\Http\Controllers\StandardController;
use App\Models\Category;
use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends StandardController
{
    protected $model;
    protected $view = 'painel.posts';
    protected $nameSmall = 'Post';
    protected $upload = ['name'=> 'image', 'path' => 'posts'];
    protected $route = 'posts';

    public function __construct(Post $post)
    {
        $this->model = $post;

        $this->middleware('can:posts');

//        $this->middleware('can:update_post')->only(['edit', 'update']);

    }

    public function create()
    {
        $title = "Cadastrar {$this->nameSmall}";

        $categories = Category::get();


        return view("{$this->view}.create-edit", compact('data', 'title', 'categories'));
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


        //Verificar se existe a imagem
        if ( $this->upload && $request->hasFile($this->upload['name'])){
            //pegar a imagem
            $image = $request->file($this->upload['name']);

            //Definir no nome da imagem
            $nameFile = uniqid(date('YmdHis')).'.'.$image->getClientOriginalExtension();

            $upload = $image->storeAs($this->upload['path'], $nameFile);

            if ( $upload )
                $dataForm[$this->upload['name']] = $nameFile;
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
                ->route("{$this->route}.index")
                ->with(['success'=>'Cadastro realizado com sucesso!']);
        else
            return redirect()
                ->route("{$this->route}.create")
                ->withErrors(['errors' => 'Falha ao cadastrar'])
                ->withInput();
    }

    public function edit($id)
    {
        //Recuperar usuário pelo id
        $data = $this->model->find($id);

        $title = "Editar {$this->nameSmall}s";

        $categories = Category::get();

        return view("{$this->view}.create-edit", compact('data', 'title', 'categories'));
    }

    public function update(Request $request, $id)
    {
        //valida dados
        $this->validate($request, $this->model->rules($id));

        $dataForm = $request->all();


        //Criar objeto categorias
        $data = $this->model->find($id);

        //pegar valor do checkbox featured (destaque)
        $dataForm['featured'] = isset( $dataForm['featured']) ? true : false;

        //Verificar se existe a imagem
        if ( $this->upload && $request->hasFile($this->upload['name'])){
            //pegar a imagem
            $image = $request->file($this->upload['name']);

//            dd($image);

            //Definir no nome da imagem
            if ($data->image == ''){
                $nameImage = uniqid(date('YmdHis')).'.'.$image->getClientOriginalExtension();
                $dataForm[$this->upload['name']] = $nameImage;
            } else {
                $nameImage = $data->image;
            }

            $upload = $image->storeAs($this->upload['path'], $nameImage);


            if ($upload )
                $dataForm[$this->upload['name']] = $nameImage;

            else
                return redirect()
                    ->route("{$this->route}.edit", ['id' => $id])
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
                ->route("{$this->route}.edit", ['id' => $id])
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
            ->paginate($this->totalPage);

        return view("{$this->view}.index", compact('datas', 'dataForm', 'title'));
    }

}
