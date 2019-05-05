<?php

namespace App\Http\Controllers\Painel;

use App\Http\Controllers\StandardController;
use App\Models\Sector;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SectorController extends StandardController
{
    protected $model;
    protected $view = 'painel.sectors';
    protected $nameSmall = 'setor';
    protected $upload = ['image'=> 'image', 'path' => 'sectors'];
    protected $route = 'sectors';

    public function __construct(Sector $sector)
    {
        $this->model = $sector;
        $this->middleware('can:sectors');

    }
}
