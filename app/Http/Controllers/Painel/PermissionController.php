<?php

namespace App\Http\Controllers\Painel;

use App\Http\Controllers\StandardController;
use App\Models\Permission;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Profile;

class PermissionController extends StandardController
{
    protected $model;
    protected $view = 'painel.permissions';
    protected $nameSmall = 'permissões';
//    protected $upload = ['name'=> 'image', 'path' => 'permissions'];
    protected $route = 'permissoes';

    public function __construct(Permission $permission)
    {
        $this->model = $permission;
        $this->middleware('can:permissions');

    }

    public function profiles($id)
    {
        $permission = $this->model->find($id);

        $profiles = $permission->profiles()->paginate($this->totalPage);

        $title = "Perfis com a permissão: {$permission->name}";

        return view('painel.permissions.profiles', compact('profiles', 'permission', 'title'));
    }

    public function profilesAdd($id)
    {
        $permission = $this->model->find($id);


        $profiles = Profile::whereNotIn('id', function ($query) use ($permission){
            $query->select("permission_profile.profile_id");
            $query->from("permission_profile");
            $query->whereRaw("permission_profile.permission_id = {$permission->id}");
        })->get();

        $title = "Adicionar Perfil a Permissão: {$permission->name}";

        return view('painel.permissions.profiles-add', compact('profiles','permission', 'title'));
    }

    public function profilesAddPermission(Request $request, $id)
    {
        $permission = $this->model->find($id);

        $permission->profiles()->attach($request->get('profiles'));

        return redirect()->route('permission.profiles', $id)->with(['success' => 'Vinculo realizado com sucesso']);
    }

    public function deleteProfile($id, $profileId)
    {
        $permission = $this->model->find($id);

        $permission->profiles()->detach($profileId);

        return redirect()->route('permission.profiles', $id)->with(['success' => 'Removido com sucesso!']);

    }

    public function searchProfile(Request $request, $id)
    {
        $dataForm = $request->except('_+token');

        $permission = $this->model->find($id);


        //FiTra os dados
        $profiles = $permission
            ->profiles()
            ->where('profiles.name', 'LIKE',"%{$dataForm['pesquisa']}%")
            ->orWhere('profiles.label', 'LIKE',"%{$dataForm['pesquisa']}%")
            ->paginate($this->totalPage);

        $title = "perfil com a permissão: {$permission->name}";

        return view('painel.permissions.profiles', compact('profiles', 'dataForm', 'permission', 'title'));

    }
}
