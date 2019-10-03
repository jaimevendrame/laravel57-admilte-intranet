<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Pessoa;

class Funcionario extends Model
{

    protected $fillable = [
        'pessoa_id',
        'sector_id',
        'cargo',
        'ramal',
        'status',


    ];

    public function rules($id = '')
    {
        return [
            'pessoa_id'     => 'required',
            'sector_id'     => 'required',
            'cargo'         => 'required|min:3|max:250',
            'ramal'         => 'required|min:3|max:10',
            'status'        => 'required|in:A,I',

        ];
    }


    public function pessoa()
    {
        return $this->belongsTo(Pessoa::class);
    }

    public function sector()
    {
        return $this->belongsTo(Sector::class);
    }
}
