<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Parlamentar extends Model
{
    protected $fillable = [
        'user_id',
        'nome_parlamentar',
        'nome_partido',
        'sigla_partido',
        'status',
        'more_emails',
    ];

    public function rules()
    {
        return [
            'nome_parlamentar' => 'required|min:3|max:200',
            'nome_partido'     => 'required|min:3|max:200',
            'sigla_partido'     => 'required|min:2|max:20',
            'status'            => 'required|in:A,I',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
