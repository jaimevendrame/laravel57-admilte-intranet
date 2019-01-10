<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Profile extends Model
{

    protected $fillable = ['name','label'];

    public function rules()
    {
        return [
            'name' => 'required|min:3|max:60',
            'label' => 'required|min:3|max:200',
        ];
    }

//    Relacionamento Muitos para Muitos
    public function users()
    {
        return $this->belongsToMany(User::class);
    }


    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }
}
