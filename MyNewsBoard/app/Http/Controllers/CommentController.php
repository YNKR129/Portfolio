<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Article;
use Illuminate\Http\Request;


class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($articleId)
    {
        $comments = Comment::where('article_id', $articleId)->latest()->paginate(10);
        return response()->json($comments); // 必要に応じてJSONレスポンス
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    // app/Http/Controllers/CommentController.php

    public function __construct()
    {
        $this->middleware('auth')->only(['store', 'edit', 'update', 'destroy']);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Article $article)
    {
        $request->validate([
            'content' => 'required|max:1000',
        ]);

        // コメントを新規作成
        $comment = new Comment();
        $comment->content = $request->input('content');
        $comment->article_id = $article->id;  // 正しくarticle_idを設定
        $comment->user_id = auth()->id();
        $comment->save();

        return redirect()->route('article.show', $article->id)
            ->with('success', 'コメントが投稿されました');
    }







    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $comment = Comment::findOrFail($id);
        return view('comments.edit', compact('comment'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'content' => 'required|max:1000',
        ]);

        $comment = Comment::findOrFail($id);
        $comment->content = $request->input('content');
        $comment->save();

        return redirect()->route('article.show', $comment->article_id)
                        ->with('success', 'コメントを更新しました。');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        $articleId = $comment->article_id;
        $comment->delete();

        return redirect()->route('article.show', $articleId)
            ->with('success', 'コメントを削除しました！');
    }
}
