<?php

namespace App;

use App\Models\Permission;
use App\Models\Profile;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','facebook', 'twitter', 'github','site','biography', 'image'

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
            'name'      => 'required|min:3|max:100',
            'email'     => "required|min:3|max:100|email|unique:users,email,{$id},id",
            'password'  => 'required|min:3|max:200|confirmed',
            'facebook'  => 'required|min:3|max:100',
            'twitter'   => 'required|min:3|max:100',
            'github'    => 'required|min:3|max:100',
            'site'      => 'required|min:3|max:200',
            'biography' => 'required|min:3|max:1000',
            'image'     => 'image',
        ];
    }

    public function rulesEdit($id = '')
    {
        return [
            'name'      => 'required|min:3|max:100',
            'email'     => "min:3|max:100|email|unique:users,email,{$id},id",
            'password'  => 'required|min:3|max:200|confirmed',
            'facebook'  => 'required|min:3|max:100',
            'twitter'   => 'required|min:3|max:100',
            'github'    => 'required|min:3|max:100',
            'site'      => 'required|min:3|max:200',
            'biography' => 'required|min:3|max:1000',
            'image'     => 'image',
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
}


