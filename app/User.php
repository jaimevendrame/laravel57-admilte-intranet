<?php

namespace App;

use App\Models\Idea;
use App\Models\Permission;
use App\Models\Pessoa;
use App\Models\Profile;
use App\Models\Sector;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'last_name', 'email', 'password','rg', 'cpf', 'birth_date','sex','marital_status', 'image','sector_id'

    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function rules($id = '')
    {
        return [
            'name'          => 'required|min:3|max:255',
            'last_name'     => 'required|min:3|max:255',
            'email'         => "required|min:3|max:100|email|unique:users,email,{$id},id",
            'password'      => "required|min:3|max:200",
            'rg'            => 'required|max:14',
            'cpf'           => "required|cpf|unique:users,cpf,{$id},id",
            'birth_date'    => 'required|date',
            'sex'           => 'required',
            'marital_status'=> 'required',
            'sector_id'     => 'required',
            'image'         => 'image|max:2048',
        ];
    }

    public function rulesCustom($id = '')
    {
        return [
            'name'          => 'required|min:3|max:255',
            'last_name'     => 'required|min:3|max:255',
            'email'         => "required|min:3|max:100|email|unique:users,email,{$id},id",
            'password'      => "required|min:3|max:200|confirmed",
            'rg'            => 'required|max:14',
            'cpf'           => "required|cpf|unique:users,cpf,{$id},id",
            'birth_date'    => 'required|date',
            'sex'           => 'required',
            'marital_status'=> 'required',
//            'sector_id'     => 'required',
            'image'         => 'image|max:2048',
        ];
    }

    public function profiles(){

        return $this->belongsToMany(Profile::class);

    }

    public function hasPermission(Permission $permission)
    {
        return $this->hasProfile($permission->profiles);
    }

    public function hasProfile($profile)
    {
        if ( is_string($profile) ) {
            return $this->profiles->contains('name', $profile);
        }

        return !! $profile->intersect($this->profiles)->count();

    }

    public function sector()
    {
        return $this->belongsTo(Sector::class, 'id');
    }

    public function sectorid()
    {
        return $this->belongsTo(Sector::class, 'sector_id');
    }

    public function pessoa()
    {
        return $this->hasOne(Pessoa::class,'user_id');
    }





}


