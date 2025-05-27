@extends('layout')

@section('content')

<!-- 記事の内容 -->
<h1>{{ $article['title'] }}</h1>
<p>{{ $article['body'] }}</p>

<h2>コメント一覧</h2>

@foreach ($comments as $comment)
    <div style="display: flex; align-items: center; margin-bottom: 10px;">
        <p style="margin-right: 20px;">・{{ $comment->content }}</p>

        @if (Auth::id() === $comment->user_id)
        <form action="{{ route('comments.edit', $comment->id) }}" method="GET" style="margin-right: 5px;">
            @csrf
            <button type="submit" class="btn btn-primary">編集</button>
        </form>

        <form action="{{ route('comments.destroy', $comment->id) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">削除</button>
        </form>
        @endif
    </div>
@endforeach

<!-- コメント投稿フォーム -->
@auth
<form action="{{ route('comments.store', $article['id']) }}" method="POST">
    @csrf
    <textarea name="content" rows="4" placeholder="コメントを入力"></textarea>
    <button type="submit">コメント投稿</button>
</form>
@endauth

<div style="margin-top: 2em;">
    <a href="{{ route('articles.index') }}">← 記事一覧に戻る</a>
</div>
@endsection