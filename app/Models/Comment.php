<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use App\Models\CommentAnswer;

class Comment extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function answers()
    {
        return $this->hasOne(CommentAnswer::class)
            ->join('users', 'users.id', '=', 'comment_answers.user_id')
            ->select('comment_answers.id','comment_answers.description', 'users.name', 'users.image as image_user', 'comment_answers.date', 'comment_answers.hour');

    }

    public function rulesAnswercomment()
    {
        return ['description' => 'required|min:3|max:1000'];
    }

    public function rules()
    {
        return [
            'name'          =>  'required|min:3|max:100',
            'email'         => 'required|email|min:3|max:100',
            'description'   => 'required|min:3|max:1000',
        ];
    }

    public function newComment($dataForm)
    {
        $this->user_id              = (  auth()->check() ) ? auth()->user()->id : 11; //sempre verificar o id do user anominio.
        $this->post_id              = $dataForm['post'];
        $this->name                 = $dataForm['name'];
        $this->email                = $dataForm['email'];
        $this->description          = $dataForm['description'];
        $this->date                 = date('Y-m-d ');
        $this->hour                 = date('H:i:s');
        $this->status               = 'R';

        return $this->save();
    }
}
