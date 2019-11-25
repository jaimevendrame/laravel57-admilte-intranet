<?php

namespace App\Models;

use App\User;
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
    public function rulesPublic($id = ''){
        return [
            'title'         => 'required|min:3|max:250',
            'category_id'   => 'required',
            'date'          => 'required',
            'hour'          => 'required',
            'description'   => 'required',
            'tags'          => 'required',
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



    public function dataFunci()
    {
        $data = $this->user()
            ->join('pessoas', 'users.id','=', 'pessoas.user_id')
            ->join('funcionarios', 'pessoas.id', '=', 'funcionarios.pessoa_id')
            ->join('sectors', 'funcionarios.sector_id', '=', 'sectors.id')
            ->first();

        return $data;

    }
}
