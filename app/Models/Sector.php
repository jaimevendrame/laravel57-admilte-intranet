<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sector extends Model
{
    protected $fillable = ['name', 'label', 'initials', 'image','status', 'description'];

    public function rules()
    {
        return [
            'name'          => 'required|min:3|max:200',
            'label'         => 'required|min:3|max:200',
            'initials'      => 'required|min:2|max:100',
            'image'         => 'image',
            'status'        => 'required|in:A,I,R',
            'description'   => 'required|min:3|max:200',
        ];
    }
}
