@extends('layout')

@section('content')

<!-- 記事の内容 -->
<h1>{{ $article['title'] }}</h1>
<p>{{ $article['body'] }}</p>

<h2>コメント一覧</h2>

@foreach ($comments as $comment)
    <p>・{{ $comment->content }}</p>
    <form action="{{ route('comments.edit', $comment->id) }}" method="GET">
        @csrf
        <button type="submit" class="btn btn-primary">編集</button>
    </form>

    <form action="{{ route('comments.destroy', $comment->id) }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit">削除</button>
    </form>
@endforeach

<!-- コメント投稿フォーム -->
<form action="{{ route('comments.store', $article['id']) }}" method="POST">
    @csrf
    <textarea name="content" rows="4" placeholder="コメントを入力"></textarea>
    <button type="submit">コメント投稿</button>
</form>

<div style="margin-top: 2em;">
    <a href="{{ route('articles.index') }}">← 記事一覧に戻る</a>
</div>
@endsection