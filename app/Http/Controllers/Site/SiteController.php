<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Mail\SendRotinaSumulas;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use App\Models\Sumula;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendContact;



class SiteController extends Controller
{

    private $post;
    private $category;
    private $user;
    protected $totalPage = 15;
    protected $nameSmall = 'Aluno';
    protected $upload = ['image'=> 'image', 'path' => 'leads'];

    /**
     * Create a new controller instance.
     *
     * @return void
     */


    /**
     * Show the application painel.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(Post $post, Category $category, User $user)
    {
        $this->post = $post;
        $this->category = $category;
        $this->user = $user;
    }

    public function index()
    {
        $title = 'Educação para Todos - SPARK CURSOS';

        return view('site.index', compact('title'));
    }

    public function blog()
    {
        $title = 'Blog - SPARK CURSOS';

        $categories = Category::get();

        $postFeatured = $this->post
                                ->where('featured', true)
                                ->limit(3)
                                ->get();

        $posts = $this->post->orderBy('date','DESC')->paginate(4);

        $postsTotal = $this->post->get();


        return view('site.blog', compact('title','categories', 'postFeatured', 'posts', 'postsTotal'));
    }

    public function contato()
    {
        $title = 'Contato - SPARK CURSOS';

        return view('site.contato', compact('title'));
    }

    public function blogpost($url)
    {
        $post = $this->post->where('url', $url)->get()->first();

        $title = $post->title;

        $categories = Category::get();

        $postsTotal = $this->post->get();

        $postFeatured = $this->post
            ->where('featured', true)
            ->limit(3)
            ->get();

        //Evento count visualizacao do Post, com registro do user.
        event(new \App\Events\PostViewed($post));

        return view('site.blog-post', compact('post','title', 'categories', 'postsTotal', 'postFeatured'));
    }

    public function category(Category $category, $url)
    {
        $category = $category->where('url', $url)->get()->first();

        $title = 'Blog - SPARK CURSOS';

        $categories = Category::get();

        $postFeatured = $this->post
            ->where('featured', true)
            ->limit(3)
            ->get();

        $posts = $category->posts()->orderBy('date','DESC')->paginate(4);

        $postsTotal = $this->post->get();

        return view('site.blog-category', compact('title','categories', 'postFeatured', 'posts', 'postsTotal'));

    }
    public function commentPost(Request $request)
    {
        $comment = new Comment;

        $dataForm = $request->all();

        $validate = validator($dataForm, $comment->rules());
        if ($validate->fails()) {

            return implode($validate->messages()->all("<p>:message</p>"));
        }


        if( $comment->newComment($dataForm))
            return '1';
        else
            return 'Falha ao cadastrar comentário.';
    }

    public function sendContact(Request $request)
    {

        $this->validate($request, [
            'name' => 'required|min:3|max:100',
            'email' => 'required|email|min:3|max:100',
            'subject' => 'required|min:3|max:100',
            'message' => 'required|min:3|max:1000',
        ]);

        $dataForm = $request->all();

        Mail::send(new SendContact($dataForm));

        return redirect('/contato')
                    ->with(['success' => 'E-mail enviado com sucesso, em breve entraremos em contato.']);

    }


    public function search(Request $request)
    {

        $title = 'Blog - SPARK CURSOS';

        $categories = Category::get();

        $postFeatured = $this->post
            ->where('featured', true)
            ->limit(3)
            ->get();

        $postsTotal = $this->post->get();

        $dataForm = $request->except('_token');



        $posts = $this
                    ->post
                    ->where('title', 'LIKE', "%{$dataForm['key-search']}%")
                    ->orWhere('description', 'LIKE', "%{$dataForm['key-search']}%")
                    ->orderBy('date', 'ASC')
                    ->paginate($this->totalPage);

        return view('site.search.blog-search', compact('title','categories', 'postFeatured', 'posts', 'postsTotal'));
    }

    public function create()
    {
        $title = "Cadastrar {$this->nameSmall}";

        return view("site.create-edit-lead", compact('data', 'title'));
    }


    public function store(Request $request)
    {
        //valida os dados
        $this->validate($request, $this->user->rules());
        //pegar todos dados do formulário
        $dataForm = $request->all();

        //Criptografar a senha
        $dataForm['password'] = bcrypt($dataForm['password']);

        //Verificar se existe a imagem
        if ( $this->upload && $request->hasFile($this->upload['image'])){
            //pegar a imagem
            $image = $request->file($this->upload['image']);

            //Definir no nome da imagem
            $nameFile = uniqid(date('YmdHis')).'.'.$image->getClientOriginalExtension();

            $upload = $image->storeAs($this->upload['path'], $nameFile);

            if ( $upload )
                $dataForm[$this->upload['image']] = $nameFile;
            else
                return redirect()
                    ->route("site")
                    ->withErrors(['errors' => 'Erro no upload da imagem'])
                    ->withInput();
        }


        //inserir os dados
        $insert = $this->model->create($dataForm);

        if($insert)
            return redirect()
                ->route("site")
                ->with(['success'=>'Cadastro realizado com sucesso!']);
        else
            return redirect()
                ->route("site.create")
                ->withErrors(['errors' => 'Falha ao cadastrar'])
                ->withInput();
    }


    public function sendMail()
    {

        foreach ($this->rerturnParlamentaresSumulas() as $parlamentar) {

            echo 'Parlamentar ID: '.$parlamentar->parlamentar_id."<br/>";
            echo 'Email: '.$parlamentar->email."<br/>";

            $data = $this->returnSumulasParlamentares($parlamentar->parlamentar_id);


            // dd( explode(',', $parlamentar->more_emails) );


            if($parlamentar->more_emails != null){
                Mail::to($parlamentar->email)
                ->cc(explode(',', $parlamentar->more_emails))
                ->send(new SendRotinaSumulas($data));
            } else {
                Mail::to($parlamentar->email)
                ->send(new SendRotinaSumulas($data));
            }


           

            foreach ($this->returnSumulasParlamentares($parlamentar->parlamentar_id) as $sumula) {

                echo 'Nr protocolo: '.$sumula->nr_protocolo."<br/>";
                echo 'Nome Parlamentar: '.$sumula->nome_parlamentar."<br/>";
                echo 'Partido: '.$sumula->sigla_partido."-".$sumula->nome_partido."<br/>";
                echo 'Data Pro: '.$sumula->date_protocolo."<br/>";
                echo 'Hora Pro: '.$sumula->hour_protocolo."<br/>";
                echo 'Hora Pro: '.$sumula->email."<br/>";
                echo 'Descrição: '.$sumula->description."<br/><br/><br/>";
            }

        }




    }


    public function rerturnParlamentaresSumulas()
    {
        $data = DB::table('sumulas')
            ->select('sumulas.parlamentar_id','users.email', 'parlamentars.more_emails')
            ->join('parlamentars', 'sumulas.parlamentar_id', '=', 'parlamentars.id')
            ->join('users', 'parlamentars.user_id', '=', 'users.id')
            ->where([
                ['sumulas.date_start', '!=', null],
                ['sumulas.status', '=', 'A']
            ])
            ->groupBy('sumulas.parlamentar_id')
            ->get();


        return $data;
    }

    public function returnSumulasParlamentares($parlamentar)
    {
        $data = DB::table('sumulas')
            ->join('parlamentars', 'sumulas.parlamentar_id', '=', 'parlamentars.id')
            ->join( 'users', 'parlamentars.user_id', '=', 'users.id')
            ->where([
                ['sumulas.date_start', '!=', null],
                ['sumulas.status', '=', 'A'],
                ['sumulas.parlamentar_id', '=', $parlamentar]
            ])
            ->orderBy('sumulas.date_start', 'ASC')
            ->get();

        return $data;
    }

}
