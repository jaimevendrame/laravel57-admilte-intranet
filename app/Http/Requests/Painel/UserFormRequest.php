<?php

namespace App\Http\Requests\Painel;

use Illuminate\Foundation\Http\FormRequest;

class UserFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'      => 'required|min:3|max:100',
            'email'     => "required|min:3|max:100|email|unique:users,email,{$this->segment(3)},id",
            'password'  => 'required|min:3|max:200|confirmed',
            'facebook'  => 'required|min:3|max:100',
            'twitter'   => 'required|min:3|max:100',
            'github'    => 'required|min:3|max:100',
            'site'      => 'required|min:3|max:200',
            'biography' => 'required|min:3|max:1000',
            'image'     => 'image',
        ];
    }
}
