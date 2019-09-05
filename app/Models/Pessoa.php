<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Pessoa extends Model 
{
    protected $fillable = [
        'nome_razao',
        'sobrenome_fantasia',
        'user_id',
        'cpf_cnpj',
        'rg_ie',
        'tipo_pessoa',
        'status',
        'marital_status',
        'birth_date_fundacao',
        'sex',
        'cep_res', 'uf_res', 'cidade_res', 'bairro_res', 'lougradouro_res', 'numero_res','complemento_res', 'ponto_referencia_rs',
        'cep_com', 'uf_com', 'cidade_com', 'bairro_com', 'lougradouro_com', 'numero_com','complemento_com', 'ponto_referencia_com',
        'cep_com', 'uf_cor', 'cidade_cor', 'bairro_cor', 'lougradouro_cor', 'numero_cor','complemento_cor', 'ponto_referencia_cor',
        'email', 'email_a', 'fone_principal','fone_cell_1', 'fone_cell_2', 'fone_comercial', 'fone_fax',
    ];


    public function rules($id = '')
    {
        return [
            'nome_razao'          => 'required|min:3|max:250',
            'sobrenome_fantasia'  => 'required|min:3|max:250',
            'cpf_cnpj'            => "required|cpf_cnpj|unique:pessoas,cpf_cnpj,{$id},id",
            'rg'                  => 'required|min:3|max:20',
            'tipo_pessoa'         => 'required|in:0,1',
            'status'              => 'required|in:A,I',
            'marital_status'      => 'in:0,1,2,3,4,5,6',
            'birth_date_fundacao' => 'date',
            'sex'                 => 'in:N,M,F',
            'email'               => 'email:rfc,dns',
            'email_a'             => 'email:rfc,dns'

        ];
    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }


}
