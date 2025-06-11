<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // 外部APIから記事データを取得
        $response = Http::get('https://jsonplaceholder.typicode.com/posts');

        // APIのレスポンスデータを配列に変換
        $articles = $response->json();

        // ビューに記事データを渡す
        return view('articles.index', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('articles.create'); // 記事作成フォームを表示
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);
    
        $article = new Article();
        $article->title = $request->input('title');
        $article->description = $request->input('description');
        $article->save();
    
        return redirect()->route('article.index')->with('success', '記事が作成されました');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // 外部APIから記事を取得
        $response = Http::get("https://jsonplaceholder.typicode.com/posts/{$id}");
        $articleData = $response->json();

        // データベースにも登録（ない場合は作成）
        $article = Article::updateOrCreate(
            ['id' => $articleData['id']],
            [
                'title' => $articleData['title'],
                'content' => $articleData['body'],
                'url' => '', // JSONPlaceholderにURLがないため仮で空欄
            ]
        );

        // コメント一覧を取得
        $comments = $article->comments()->latest()->get();

        // Bladeへデータを渡す
        return view('articles.show', [
            'article' => $articleData,  // APIから取得した表示用
            'comments' => $comments,    // コメント表示用
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Article $article)
    {
        return view('articles.edit', compact('article'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Article $article)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);
    
        $article->title = $request->input('title');
        $article->description = $request->input('description');
        $article->save();
    
        return redirect()->route('article.show', $article->id)->with('success', '記事が更新されました');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
    {
        $article->delete();
        return redirect()->route('article.index')->with('success', '記事が削除されました');
    }

}
