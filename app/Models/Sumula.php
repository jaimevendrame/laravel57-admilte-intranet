<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Sumula extends Model
{
    protected $fillable = [
        'nr_protocolo',
        'description',
        'date_protocolo',
        'hour_protocolo',
        'date_start',
        'image',
        'parlamentar_id',
        'user_id',
        'status',
    ];

    public function rules()
    {
        return [
            'nr_protocolo'     => 'required',
            'description'      => 'required|min:10|max:3000',
            'date_protocolo'   => 'required|date',
            'hour_protocolo'   => 'required',
            'status'           =>'required|in:A,P,C,F',
            'image'            => 'mimes:jpeg,png,jpg,zip,pdf|max:2048',
            'parlamentar_id'   => 'required'
        ];
    }

   
    public function parlamentar()
    {
        return $this->belongsTo(Parlamentar::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
