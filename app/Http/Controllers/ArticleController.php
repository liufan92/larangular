<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article;
use App\Like;

class ArticleController extends Controller
{
    public function index()
    {
    	//$articles = Article::latest('created_at')->paginate(10);
    	$articles = Article::latest('created_at')->paginate(10);
    	return response()->json($articles);
    }

    public function store(Request $request)
    {
    	//Validate request
    	$this->validate($request,[
            'content' => 'required|max:1000',
        ]);

    	//Save new article to database
    	Article::create($request->all());

    	//redirect user back to previous page
    	return response()->json(array('success' => true));
    }

    public function update(Request $request, $id)
    {
    	//Validate update request
    	$this->validate($request,[
            'content' => 'required|max:1000',
        ]);

        $article = Article::findOrFail($id);
        $article->update($request->all());

        //return redirect('/articles');
        return response()->json(array('success' => true));
    }

    public function destroy($id)
    {
        //Prevent other users from submitted delete request
        $article = Article::where('id', $id)->first();
        if(Auth::user() != $article->user){
            return redirect()->back();
        }

        //Destroy: Soft delete, mark article as delete
        Article::destroy($id);

        return response()->json(array('success' => true));
    }

    public function postLikeArticle(Request $request)
    {
        $article_id = $request['articleId'];
        $article = Article::find($article_id);
        if(!$article){
            return null;
        }
        $user = Auth::user();
        $like = $user->likes()->where('article_id', $article_id)->first();
        if($like){
            $like->delete();
            return null;
        }else{
            $like = new Like();
            $like->like = true;
            $like->user_id = $user->id;
            $like->article_id = $article->id;
            $like->save();
        }
        return response()->json(array('success' => true));
    }
}
