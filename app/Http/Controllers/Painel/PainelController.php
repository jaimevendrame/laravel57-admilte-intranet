<?php

namespace App\Http\Controllers\Painel;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Idea;
use App\Models\Permission;
use App\Models\Post;
use App\Models\Profile;
use App\Models\Sumula;
use App\User;

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



        return view('painel.home.index',
            compact(
                'totalUser',
                'totalCategories',
                'totalPosts',
                'totalComments',
                'totalProfiles',
                'totalPermissions',
                'totalSumulas',
                'totalIdeas'
            )
        );
    }

}
