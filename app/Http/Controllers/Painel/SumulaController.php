<?php

namespace App\Http\Controllers\Painel;

use App\Http\Controllers\StandardController;
use App\Models\Parlamentar;
use App\Models\Sumula;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SumulaController extends StandardController
{
    protected $model;
    protected $view = 'painel.sumulas';
    protected $nameSmall = 'Súmulas';
    protected $upload = ['image'=> 'image', 'path' => 'sumulas'];
    protected $route = 'sumulas';
    protected $diasPrazoSumula = 90;

    /**
     * SumulaController constructor.
     * @param Sumula $sumula
     */
    public function __construct(Sumula $sumula)
    {
        /** @var TYPE_NAME $sumula */
        $this->model = $sumula;
        $this->middleware('can:sumulas');

    }


    public function index()
    {

        $datas = $this->model->orderBy('nr_protocolo', 'desc')->orderBy('date_protocolo', 'asc')->get();

        $title = "Listagem {$this->nameSmall}";

        return view("{$this->view}.index", compact('datas', 'title'));
    }

    public function create()
    {
        $title = "Cadastrar {$this->nameSmall}";
        $dataParlamentar = Parlamentar::get();

        return view("{$this->view}.create-edit", compact('title', 'dataParlamentar'));
    }


    public function store(Request $request)
    {
        //valida os dados
        $this->validate($request, $this->model->rules());
        //pegar todos dados do formulário
        $dataForm = $request->all();

        //pegar usuário logado
        $dataForm[ 'user_id'] = auth()->user()->id;


//        dd($dataForm);


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

        $dataParlamentar = Parlamentar::get();

        $title = "Editar {$this->nameSmall}";

        return view("{$this->view}.create-edit", compact('data', 'title', 'dataParlamentar'));
    }


    public function search(Request $request)
    {

        // dd($request);

        //Recupera os dados do formulário
        $dataForm = $request->except('_token');

        $title = "Listagem {$this->nameSmall}s";

        $status = $dataForm['status'];

        // dd($status);

        $pesquisa = $dataForm['pesquisa'];

        // dd($pesquisa);


        //Filtra os dados


        $datas = $this->model
                ->join('parlamentars', 'sumulas.parlamentar_id','=','parlamentars.id')
                // ->orWhere('nr_protocolo', 'LIKE', "%{$pesquisa}%")
                // ->orWhere('description', 'LIKE', "%{$pesquisa}%")
                // ->orWhere('parlamentars.nome_parlamentar', 'LIKE', "%{$pesquisa}%")
                // ->orWhere('date_protocolo', 'LIKE', "%{$pesquisa}%")
                // ->orWhere('hour_protocolo', 'LIKE', "%{$pesquisa}%")
                // ->orWhere('date_start', 'LIKE', "%{$pesquisa}%")
                // // ->whereIn('sumulas.status',  $status)
                ->paginate($this->totalPage);

                
                // dd( $datas );

        return view("{$this->view}.index", compact('datas', 'dataForm', 'title'));
    }


    public function sqlSearch($pesquisa, $status){


        $data = $this->model
        ->join('parlamentars', 'sumulas.parlamentar_id','=','parlamentars.id')
        ->orWhere('nr_protocolo', 'LIKE', "%{$pesquisa}%")
        ->orWhere('description', 'LIKE', "%{$pesquisa}%")
        ->orWhere('parlamentars.nome_parlamentar', 'LIKE', "%{$pesquisa}%")
        ->orWhere('date_protocolo', 'LIKE', "%{$pesquisa}%")
        ->orWhere('hour_protocolo', 'LIKE', "%{$pesquisa}%")
        ->orWhere('date_start', 'LIKE', "%{$pesquisa}%")
        ->whereIn('sumulas.status',  $status)
        ->paginate($this->totalPage);


        dd($data);
        return $data;
    }

   
}
