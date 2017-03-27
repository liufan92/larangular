<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Comment;
use App\Article;
use Auth;

class CommentController extends Controller
{
	public function index()
    {
    	$comments = Comment::paginate(10);
    	//return response()->json(Comment::where('article_id',$article_id)->oldest()->get());
    	return response()->json($comments);
    }

    public function store(Request $request)
    {   
        //Submit by form
    	//Comment::create($request->all());
        //return redirect()->back();

        //Submit by AJAX
        $user = Auth::user();
        $article_id = $request['articleId'];
        $article = Article::find($article_id);
        if(!$article){
            return null;
        }

        $text = $request['text'];

        $comment = new Comment();
        $comment->user_id = $user->id;
        $comment->article_id = $article->id;
        $comment->text = $request['text'];
        $comment->save();

    	return response()->json([
            'username' => Auth::user()->name,
            'created_at'=> $comment->created_at->diffForHumans()
        ]);
    }

    public function destroy($id)
    {
    	Comment::destroy($id);
    	return response()->json(array('success' => true));
    }
}
