<?php

namespace App\Http\Controllers\Painel;

use App\Http\Controllers\StandardController;
use App\Models\Permission;
use App\Models\Profile;
use App\User;
use Illuminate\Http\Request;

class ProfileController extends StandardController
{
    protected $model;
    protected $view = 'painel.profiles';
    protected $nameSmall = 'perfis';
//    protected $upload = ['name'=> 'image', 'path' => 'profiles'];
    protected $route = 'perfis';

    public function __construct(Profile $profile)
    {
        $this->model = $profile;
        $this->middleware('can:profiles');

    }

    public function users($id){

        $profile = $this->model->find($id);

        $users = $profile->users()->distinct('user_id')->paginate($this->totalPage);

        $title = "usuários com o perfil: {$profile->name}";

        return view('painel.profiles.users', compact('profile', 'users', 'title'));
    }

    public function usersAdd($id)
    {

        $profile = $this->model->find($id);


//       Retorna os usuário que não estão viculados com o perfil selecionado.
//       Usando subquery.
        $users = User::whereNotIn('id', function ($query) use ($profile){
            $query->select("profile_user.user_id");
            $query->from("profile_user");
            $query->whereRaw("profile_user.profile_id = {$profile->id}");
        })->get();



        $title = "Adicionar usuários ao perfil: {$profile->name}";

        return view('painel.profiles.users-add', compact('profile','users', 'title'));

    }

    public function usersAddProfile(Request $request, $id)
    {
        $profile = $this->model->find($id);

        $profile->users()->attach($request->get('users'));

        return redirect()->route('profile.users', $id)->with(['success' => 'Vinculo realizado com sucesso']);
    }

    public function deleteUser($id, $userId)
    {
        $profile = $this->model->find($id);

        $profile->users()->detach($userId);

        return redirect()->route('profile.users', $id)->with(['success' => 'Removido com sucesso!']);

    }

    public function searchUser(Request $request, $id)
    {
        $dataForm = $request->except('_+token');

        $profile = $this->model->find($id);


        //FiTra os dados
        $users = $profile
                    ->users()
                    ->where('name', 'LIKE',"%{$dataForm['pesquisa']}%")
                    ->orWhere('users.email', $dataForm['pesquisa'])
                    ->paginate($this->totalPage);

        $title = "usuários com o perfil: {$profile->name}";

        return view('painel.profiles.users', compact('users', 'dataForm', 'profile', 'title'));

    }

    public function permissions($id){

        $profile = $this->model->find($id);

        $permissions = $profile->permissions()->paginate($this->totalPage);

        $title = "Permissões com o perfil: {$profile->name}";

        return view('painel.profiles.permissions', compact('profile', 'permissions', 'title'));
    }

    public function permissionsAdd($id)
    {

        $profile = $this->model->find($id);


//       Retorna os usuário que não estão viculados com o perfil selecionado.
//       Usando subquery.
        $permissions = Permission::whereNotIn('id', function ($query) use ($profile){
            $query->select("permission_profile.profile_id");
            $query->from("permission_profile");
            $query->whereRaw("permission_profile.permission_id = {$profile->id}");
        })->get();

        $title = "Adicionar permissões ao perfil: {$profile->name}";

        return view('painel.profiles.permissions-add', compact('profile','permissions', 'title'));

    }

    public function permissionsAddProfile(Request $request, $id)
    {
        $profile = $this->model->find($id);

        $profile->permissions()->attach($request->get('permission'));

        return redirect()->route('profile.permissions', $id)->with(['success' => 'Vinculo realizado com sucesso']);
    }

    public function deletePermissions($id, $permissionId)
    {
        $profile = $this->model->find($id);

        $profile->permissions()->detach($permissionId);

        return redirect()->route('profile.permissions', $id)->with(['success' => 'Removido com sucesso!']);

    }

    public function searchPermissions(Request $request, $id)
    {
        $dataForm = $request->except('_+token');

        $profile = $this->model->find($id);


        //FiTra os dados
        $permissions = $profile
            ->permissions()
            ->where('name', 'LIKE',"%{$dataForm['pesquisa']}%")
            ->orWhere('permissions.label', 'LIKE',"%{$dataForm['pesquisa']}%")
            ->paginate($this->totalPage);

        $title = "usuários com o perfil: {$profile->name}";

        return view('painel.profiles.permissions', compact('permissions', 'dataForm', 'profile', 'title'));

    }
}
