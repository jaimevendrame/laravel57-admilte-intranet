<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\App\Models\Post;

class Category extends Model
{
    protected $fillable = ['name', 'url', 'description', 'image'];

    public function rules($id = '')
    {
        return [
            'name'          => 'required|min:3|max:100',
            'url'           => "required|min:3|max:100|unique:categories,url,{$id},id",
            'description'   => 'required|min:3|max:200',
            'image'         => 'image',
        ];
    }

    public function posts()
    {
        return $this->hasMany('App\Models\Post');
    }

    public function ideas()
    {
        return $this->hasMany('App\Models\Idea');
    }
}
