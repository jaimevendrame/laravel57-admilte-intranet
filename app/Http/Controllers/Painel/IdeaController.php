<?php

namespace App\Http\Controllers\Painel;

use App\Http\Controllers\StandardController;
use App\Models\Category;
use App\Models\Idea;
use App\Models\Pessoa;
use App\Models\Sector;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class IdeaController extends StandardController
{
    protected $model;
    protected $view = 'painel.ideas';
    protected $nameSmall = 'ideia';
    protected $upload = ['image'=> 'file', 'path' => 'ideas'];
    protected $route = 'ideas';

    public function __construct(Idea $idea)
    {
        $this->model = $idea;
        $this->middleware('can:ideas');

    }

    public function index()
    {


        $datas = $this->model->paginate($this->totalPage);

        $title = "Listagem {$this->nameSmall}";

        return view("{$this->view}.index", compact('datas', 'title'));
    }


    public function create()
    {


        $title = "Cadastrar {$this->nameSmall}";

        $categories = Category::get();

        $sectories = Sector::get();


        return view("{$this->view}.create-edit", compact('data', 'title', 'categories', 'sectories'));
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

        $title = "Analisar {$this->nameSmall}s";

        $categories = Category::get();


        return view("{$this->view}.create-edit", compact('data', 'title', 'categories'));
    }

    public function update(Request $request, $id)
    {


        //pegar id assessor
        $request[ 'assessor_id'] = Auth::id();

        //pegar id sector
        $request[ 'sector_id'] = Auth::user()->sector_id;


        //valida dados
        $this->validate($request, $this->model->rules($id));


        $dataForm = $request->all();


    //    dd($dataForm);

        //Criar objeto categorias
        $data = $this->model->find($id);

        //pegar valor do checkbox featured (destaque)
        $dataForm['featured'] = isset( $dataForm['featured']) ? true : false;

    

       

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


    public function show($id)
    {


        //Recuperar usuário
        $data = $this->model->find($id);
//        dd($data->assessor_id);

        $valor = Pessoa::where('user_id', $data->assessor_id)->first();

//        dd($valor);

        $title = "Visualizar {$this->nameSmall}";

        return view("{$this->view}.show", compact('data', 'title'));
    }


    public function search(Request $request)
    {
        //Recupera os dados do formulário
        $dataForm = $request->except('_token');

        $title = "Listagem {$this->nameSmall}s";

    
        //Filtra os dados
        
        if ( $dataForm['pesquisa'] != '' ){
            $datas = $this->model
                ->select(['ideas.*','users.name as name_user'])
                ->join('users','ideas.user_id','=','users.id')
                ->where('title', 'LIKE', "%{$dataForm}%")
                ->orWhere('description', 'LIKE', "%{$dataForm}%")
                ->orWhere('tags', 'LIKE', "%{$dataForm}%")
                ->orWhere('users.name', 'LIKE', "%{$dataForm}%")
                ->orWhere('status',  $dataForm['status'])
                ->paginate($this->totalPage);

        }
        else if ( $dataForm['status'] == null ) {

            $datas = $this->model->paginate($this->totalPage);

        }
        else {
            $datas = $this->model
                ->where('status', $dataForm['status'])
                ->paginate($this->totalPage);
        }

        // dd($datas);
        return view("{$this->view}.index", compact('datas', 'dataForm', 'title'));
    }




}
