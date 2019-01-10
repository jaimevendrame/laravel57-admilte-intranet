<?php

namespace App\Http\Controllers\Painel;

use App\Events\CommentAnswered;
use App\Http\Controllers\StandardController;
use App\Models\Category;
use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\CommentAnswer;
use Illuminate\Http\Request;

class CommentController extends StandardController
{
    protected $model;
    protected $view = 'painel.comments';
    protected $nameSmall = 'comentários';
    protected $upload = ['name'=> 'image', 'path' => 'comments'];
    protected $route = 'comentarios';

    public function __construct(Comment $comment)
    {
        $this->model = $comment;
        $this->middleware('can:comments');

    }
    public function search(Request $request)
    {
        //Recupera os dados do formulário
        $dataForm = $request->except('_token');

        $title = "Listagem {$this->nameSmall}s";

        //Filtra os dados
        if ( $dataForm['pesquisa'] != '') {
            $datas = $this->model
                ->where('status', $dataForm['status'])
                ->where('name', 'LIKE', "%{$dataForm['pesquisa']}%")
                ->orWhere('description', 'LIKE', "%{$dataForm['pesquisa']}%")
                ->paginate($this->totalPage);
        } else {
            $datas = $this->model
                ->where('status', $dataForm['status'])
                ->paginate($this->totalPage);
        }


        return view("{$this->view}.index", compact('datas', 'dataForm', 'title'));
    }

    public function answers($id)
    {
        $comment = $this->model->find($id);

        $answers = $comment->answers()->paginate($this->totalPage);

        $title = "Respostas {$this->nameSmall}";

        return view("{$this->view}.answers", compact('comment', 'answers', 'title'));
    }

    /**
     * @param Request $request
     * @param $id
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function answersReply(Request $request, $id)
    {
        $this->validate($request, $this->model->rulesAnswerComment());

        $comment = $this->model->find($id);

        $dataForm = $request->all();
        $dataForm['user_id'] = auth()->user()->id;
        $dataForm['date'] = date('Y-m-d');
        $dataForm['hour'] = date('H:i:s');

        $reply = $comment->answers()->create($dataForm);

        if ($reply){
            event(new \App\Events\CommentAnswered($comment, $reply));
            return redirect()->back()->with([ 'success' => 'Comentário Enviado com Sucesso!']);
        }

        return redirect()->back()->withErrors(['errors' => 'Falha ao responder'])
            ->withInput();


    }

    public function destroy($id)
    {
        $data = $this->model->find($id);

        $delete = $data->delete();

        if ($delete) {
            return redirect()
                ->route("{$this->route}.index")
                ->with(['success'=>"Comentário excluido com sucesso!"]);
        } else {
            return redirect()
                ->back()
                ->withErrors(['errors'=>'Falha ao excluir!']);
        }

    }

    public function destroyAnswer($id, $idAnswer)
    {

        $answercomment = CommentAnswer::find($idAnswer);

        $delete = $answercomment->delete();

        if ($delete) {
            return redirect()
                ->back()
                ->with(['success'=>"Resposta excluido com sucesso!"]);
        } else {
            return redirect()
                ->back()
                ->withErrors(['errors'=>'Falha ao excluir!']);
        }
    }

}
