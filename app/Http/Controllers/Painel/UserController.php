<?php

namespace App\Http\Controllers\Painel;

use App\Http\Controllers\StandardController;
use App\Http\Requests\Painel\UserFormRequest;
use App\Models\Profile;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use phpDocumentor\Reflection\Types\This;

class UserController extends StandardController
{

    protected $model;
    protected $view = 'painel.users';
    protected $nameSmall = 'usuario';
    protected $upload = ['name'=> 'image', 'path' => 'users'];
    protected $route = 'usuarios';

    public function __construct(User $user)
    {
        $this->model = $user;
        $this->middleware('can:update_profile')->only(['update-profile']);
//        $this->middleware('can:users');



    }

    public function index()
    {

        $this->authorize('can:users');


        $datas = $this->model->paginate($this->totalPage);

        $title = "Listagem {$this->nameSmall}";

        return view("{$this->view}.index", compact('datas', 'title'));
    }

    public function create()
    {

        $this->authorize('can:users');

        $title = "Cadastrar {$this->nameSmall}";

        return view("{$this->view}.create-edit", compact('data', 'title'));
    }
    public function store(Request $request)
    {

        $this->authorize('can:users');

        //valida os dados
        $this->validate($request, $this->model->rules());
        //pegar todos dados do formulário
        $dataForm = $request->all();

        //Criptografar a senha
        $dataForm['password'] = bcrypt($dataForm['password']);

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

    public function show($id)
    {

        $this->authorize('can:users');

        //Recuperar usuário
        $data = $this->model->find($id);

        $title = "Visualizar {$this->nameSmall}";

        return view("{$this->view}.show", compact('data', 'title'));
    }

    public function edit($id)
    {

        $this->authorize('can:users');


        //Recuperar usuário pelo id
        $data = $this->model->find($id);

        $title = "Editar {$this->nameSmall}s";

        return view("{$this->view}.create-edit", compact('data', 'title'));
    }

    public function update(Request $request, $id)
    {

        $this->authorize('can:users');

        //valida dados
        $this->validate($request, $this->model->rulesEdit($id));

        $dataForm = $request->all();


        //Criar objeto categorias
        $data = $this->model->find($id);


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

    public function editProfile()
    {
        //Recuperar usuário
        $data = auth()->user();
        //Recuperar usuário pelo id


        $title = "Editar {$this->nameSmall}s";

        return view("{$this->view}.create-edit-profile", compact('data', 'title'));
    }


    public function updateProfile(Request $request)
    {

        $id = auth()->user()->id;


        //valida dados
        $this->validate($request, $this->model->rulesEdit($id));

        $dataForm = $request->all();


        //Criptografar a senha
        $dataForm['password'] = bcrypt($dataForm['password']);

        //Criar objeto categorias
        $data = $this->model->find($id);



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
                    ->route("profile.update")
                    ->withErrors(['errors' => 'Erro no upload'])
                    ->withInput();

        }
        //Alterar os dados

        $update = $data->update($dataForm);


        if($update)
            return redirect()
                ->route("profile.show")
                ->with(['success'=>'Alteração realizada com sucesso!']);
        else
            return redirect()
                ->route("profile.update")
                ->withErrors(['errors' => 'Falha ao editar'])
                ->withInput();
    }

    public function showProfile()
    {
        //Recuperar usuário
        $data = auth()->user();

        $title = "Visualizar perfil";

        return view("{$this->view}.show-profile", compact('data', 'title'));
    }

    public function profiles($id){

        $this->authorize('can:users');

        $user = $this->model->find($id);

        $profiles = $user->profiles()->distinct('profile_id')->paginate($this->totalPage);

        $title = "perfis do usuário: {$user->name}";

        return view('painel.users.profiles', compact('profiles', 'user', 'title'));
    }

    public function profilesAdd($id)
    {
        $this->authorize('can:users');

        $user = $this->model->find($id);


//       Retorna os usuário que não estão viculados com o perfil selecionado.
//       Usando subquery.
        $profiles = Profile::whereNotIn('id', function ($query) use ($user){
            $query->select("profile_user.profile_id");
            $query->from("profile_user");
            $query->whereRaw("profile_user.user_id = {$user->id}");
        })->get();

        $title = "Adicionar perfis ao usuário: {$user->name}";

        return view('painel.users.profiles-add', compact('profiles','user', 'title'));

    }

    public function profilesAddUser(Request $request, $id)
    {
        $this->authorize('can:users');

        $user = $this->model->find($id);

        $user->profiles()->attach($request->get('profiles'));

        return redirect()->route('user.profiles', $id)->with(['success' => 'Vinculo realizado com sucesso']);
    }

    public function deleteProfile($id, $profileId)
    {
        $this->authorize('can:users');

        $user = $this->model->find($id);

        $user->profiles()->detach($profileId);

        return redirect()->route('user.profiles', $id)->with(['success' => 'Removido com sucesso!']);

    }

    public function searchProfile(Request $request, $id)
    {
        $this->authorize('can:users');

        $dataForm = $request->except('_+token');

        $user = $this->model->find($id);


        //FiTra os dados
        $profiles = $user
            ->profiles()
            ->where('name', 'LIKE',"%{$dataForm['pesquisa']}%")
            ->orWhere('profiles.label', 'LIKE', "%{$dataForm['pesquisa']}%")
            ->paginate($this->totalPage);

        $title = "usuários com o perfil: {$user->name}";

        return view('painel.users.profiles', compact('user', 'dataForm', 'profiles', 'title'));

    }
}

