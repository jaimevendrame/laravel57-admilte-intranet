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
    protected $upload = ['name'=> 'image', 'path' => 'pessoas'];
    protected $route = 'pessoas';
    protected $disk = 'public';


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

        //Converte data DD/MM/YYY para YYYY-MM-DD
        $origDate = $request['birth_date_fundacao'];

        $date = str_replace('/', '-', $origDate );
        $newDate = date("Y-m-d", strtotime($date));

        $request['birth_date_fundacao'] = $newDate;

        //Remover mascara cpf
        $cpf_cnpj = array(".","-","/");
        $request['cpf_cnpj']= str_replace($cpf_cnpj,"", $request['cpf_cnpj']);

        //Remover mascara cep_res
        $cep_res = array(".","-","/");
        $request['cep_res']= str_replace($cep_res,"", $request['cep_res']);

        //Remover mascara cep_com
        $cep_com = array(".","-","/");
        $request['cep_com']= str_replace($cep_com,"", $request['cep_com']);

        //Remover mascara cep_cor
        $cep_cor = array(".","-","/");
        $request['cep_cor']= str_replace($cep_cor,"", $request['cep_cor']);

        //pegar valor do checkbox featured (destaque)
        $request['featured'] = isset( $request['featured']) ? 1 : 0;

        //pegar valor do checkbox featured (destaque)
        $request['colaborador'] = isset( $request['colaborador']) ? 1 : 0;

        //pegar valor do checkbox featured (destaque)
        $request['fornecedor'] = isset( $request['fornecedor']) ? 1 : 0;

//        dd($request);

        //valida os dados
        $this->validate($request, $this->model->rules());
        //pegar todos dados do formulário
        $dataForm = $request->all();

        //Verificar se existe a imagem
        if ( $this->upload && $request->hasFile($this->upload['name'])){
            //pegar a imagem
            $image = $request->file($this->upload['name']);

            //Definir no nome da imagem
            $nameFile = uniqid(date('YmdHis')).'.'.$image->getClientOriginalExtension();

            $upload = $image->storeAs($this->upload['path'], $nameFile, $this->disk ?? 'local');

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
    public function update(Request $request, $id)
    {

        //Criar objeto pessoa
        $data = $this->model->find($id);

        $origDate = $request['birth_date_fundacao'];

        $date = str_replace('/', '-', $origDate );
        $newDate = date("Y-m-d", strtotime($date));

        $request['birth_date_fundacao'] = $newDate;

        //Remover mascara cpf
        $cpf_cnpj = array(".","-","/");
        $request['cpf_cnpj']= str_replace($cpf_cnpj,"", $request['cpf_cnpj']);

        //Remover mascara cep_res
        $cep_res = array(".","-","/");
        $request['cep_res']= str_replace($cep_res,"", $request['cep_res']);

        //Remover mascara cep_com
        $cep_com = array(".","-","/");
        $request['cep_com']= str_replace($cep_com,"", $request['cep_com']);

        //Remover mascara cep_cor
        $cep_cor = array(".","-","/");
        $request['cep_cor']= str_replace($cep_cor,"", $request['cep_cor']);

        //pegar valor do checkbox featured (destaque)
        $request['featured'] = isset( $request['featured']) ? 1 : 0;


        //pegar valor do checkbox featured (destaque)
        $request['colaborador'] = isset( $request['colaborador']) ? 1 : 0;

        //pegar valor do checkbox featured (destaque)
        $request['fornecedor'] = isset( $request['fornecedor']) ? 1 : 0;

        //pegar valor do checkbox tipo_pessoa (destaque)
        $request['tipo_pessoa'] = $data['tipo_pessoa'];


        //valida dados
        $this->validate($request, $this->model->rules($id));

        $dataForm = $request->all();




        //Verificar se existe a imagem

        if ( $this->upload && $request->hasFile($this->upload['name'])){
            //pegar a imagem
            $image = $request->file($this->upload['name']);


            //Definir no nome da imagem
            if ($data->image == ''){
                $nameImage = uniqid(date('YmdHis')).'.'.$image->getClientOriginalExtension();
                $dataForm[$this->upload['name']] = $nameImage;
            } else {
                $nameImage = $data->image;

            }

            $upload = $image->storeAs($this->upload['path'], $nameImage, $this->disk ?? 'local');


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

}
