<?php

namespace App\Models;

use App\User;
use App\Models\Category;
use Illuminate\Database\Eloquent\Model;

class Idea extends Model
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
        'answer_status',
        'comments',
        'tags',
        'file',
        'assessor_id',
    ];

    public function rules(){
        return [
            'title'             => 'required|min:3|max:250',
            'category_id'       => 'required',
            'description'       => 'required|min:10|max:6000',
            'tags'              => 'required|min:3|max:250',
            'file'              => 'mimes:jpeg,png,jpg,zip,pdf|max:2048',
        ];
    }

    public function rules_view_ideas(){
        return [
            'status'            => 'required|in:A,R',
            'answer_status'     => 'required|min:3|max:250',
//            'assessor_id'     => 'required|min:3|max:250',
        ];
    }



    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function assessor()
    {
        return $this->belongsTo(User::class, 'assessor_id');
    }



}
