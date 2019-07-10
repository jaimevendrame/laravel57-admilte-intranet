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
        'sector_id',
    ];

    public function rules(){
        return [
            'status'            => 'required|in:P,A,R',
            'answer_status'     => 'required|min:3|max:250',
            'assessor_id'       => 'required',
            'sector_id'         => 'required',
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

    public function sector()
    {
        return $this->belongsTo(Sector::class);
    }

}
