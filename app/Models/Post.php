<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use App\Models\PostView;
use App\Models\Comment;

class Post extends Model
{
    protected $fillable = [
        'title',
        'user_id',
        'category_id',
        'description',
        'date',
        'hour',
        'featured',
        'status',
        'image',
        'url',
        'descriptionfull',
        'calltext',
        'tags'
    ];

    public function rules($id = ''){
        return [
            'title'             => 'required|min:3|max:250',
            'url'               => "required|min:3|max:100|unique:posts,url,{$id},id",
            'category_id'       => 'required',
            'description'       => 'required|min:10|max:6000',
            'descriptionfull'   => 'required|min:10|max:6000',
            'calltext'          => 'required|min:3|max:250',
            'tags'              => 'required|min:3|max:250',
            'date'              => 'required|date',
            'hour'              => 'required',
            'status'            => 'required|in:A,R',
            'image'             => 'image',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function views()
    {
        return $this->hasMany(PostView::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class)
            ->join('users', 'users.id', '=', 'comments.user_id')
            ->select('comments.id', 'comments.description', 'comments.name', 'users.image as image_user')
            ->where('comments.status', 'A');
    }

}
