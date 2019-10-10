<?php

namespace App\Http\Controllers\Painel;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Funcionario;
use App\Models\Idea;
use App\Models\Permission;
use App\Models\Pessoa;
use App\Models\Post;
use App\Models\Profile;
use App\Models\Sumula;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;

class PainelController extends Controller
{

    public function __construct()
    {
        $this->middleware('can:view_painel');

    }
    public function index()
    {


        $totalUser = User::count();
        $totalCategories = Category::count();
        $totalPosts = Post::count();
        $totalComments = Comment::count();
        $totalProfiles = Profile::count();
        $totalPermissions = Permission::count();
        $totalSumulas = Sumula::count();
        $totalIdeas = Idea::count();
        $niver = $this->returnNiver();



        return view('painel.home.index',
            compact(
                'totalUser',
                'totalCategories',
                'totalPosts',
                'totalComments',
                'totalProfiles',
                'totalPermissions',
                'totalSumulas',
                'totalIdeas',
                'niver'
            )
        );
    }

    public function agenda()
    {
        $datas = Funcionario::get();

        $title = "Agenda";

        return view("painel.agenda.index", compact('title', 'datas'));
    }


    public function show($id)
    {
        $agenda = Funcionario::
            select(['funcionarios.*','pessoas.*', 'pessoas.id as id_pessoa'])
            ->join('pessoas','funcionarios.pessoa_id', 'pessoas.id')
            ->find($id);

        $agenda['birth_date_fundacao'] = date("d/m", strtotime($agenda['birth_date_fundacao']));

        return Response::json($agenda);
    }


    public function returnNiver()
    {

        $data = Funcionario::
            select(['funcionarios.*','pessoas.*', 'pessoas.id as id_pessoa'])
            ->join('pessoas','funcionarios.pessoa_id', 'pessoas.id')
            ->whereMonth('birth_date_fundacao', Carbon::now()->month)
            ->orderbyRaw("DAY (birth_date_fundacao)", 'desc')
            ->get();

    return $data;
    }

}
