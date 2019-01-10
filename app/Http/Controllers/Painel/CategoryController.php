<?php

namespace App\Http\Controllers\Painel;

use App\Http\Controllers\StandardController;
use App\Models\Category;
use App\Http\Controllers\Controller;

class CategoryController extends StandardController
{
    protected $model;
    protected $view = 'painel.categories';
    protected $nameSmall = 'categoria';
    protected $upload = ['image'=> 'image', 'path' => 'categories'];
    protected $route = 'categorias';

    public function __construct(Category $category)
    {
        $this->model = $category;
        $this->middleware('can:categories');

    }

}
