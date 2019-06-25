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

        $datas = $this->model->orderBy('nr_protocolo', 'desc')->orderBy('date_protocolo', 'asc')->paginate($this->totalPage);

        $title = "Listagem {$this->nameSmall}";

        return view("{$this->view}.index", compact('datas', 'title'));
    }

    public function create()
    {
        $title = "Cadastrar {$this->nameSmall}";
        $dataParlamentar = Parlamentar::get();

        return view("{$this->view}.create-edit", compact('data', 'title', 'dataParlamentar'));
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

        $title = "Editar {$this->nameSmall}s";

        return view("{$this->view}.create-edit", compact('data', 'title', 'dataParlamentar'));
    }

    public function show($id)
    {
        //Recuperar usuário
        $data = $this->model->find($id);

        $title = "Visualizar {$this->nameSmall}";

        $dataEndSumula = $this->calcularDataEndSumula($data->date_start);
        $dias = $this->calcularDiasRestantesSumula($data->date_start);

        return view("{$this->view}.show", compact('data', 'title', 'dataEndSumula', 'dias'));
    }

    public function calcularDataEndSumula($data_start)
    {
        if ( $data_start != null )
        {
            $data_end = date('Y-m-d', strtotime("+" .$this->diasPrazoSumula. " days", strtotime($data_start)));

            return $data_end;

        } else {

            return null;
        }
    }

    public function calcularDiasRestantesSumula($data_start)
    {

        if ( $data_start != null ) {


            //pegar dat atual
            $data_atual = Carbon::now()->format('Y-m-d');

            try {

                $data1 = new DateTime($this->calcularDataEndSumula($data_start));

            } catch (\Exception $e) {

            }
            try {
                $data2 = new DateTime($data_atual);

            } catch (\Exception $e) {

            }

            $dias = $data1->diff($data2)->format("%a");


            return $dias;


        } else {
            return null;
        }

    }


    public function calcularPrazo($data_start){

        if ( $data_start != null ){

            $data_end = date('Y-m-d', strtotime('+90 days', strtotime($data_start)));



            $data1 = new DateTime( $data_start );
            $data2 = new DateTime( $data_end );

            $prazo = $data1->diff( $data2 )->format("%a");

            $retorno = [
                'prazo' => $prazo,
                'data_fim' => $data_end
            ];

            return $retorno;

        } else {
            $retorno = "";

            return $retorno;

        }

    }

}
