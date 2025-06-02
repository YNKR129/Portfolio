@extends('layout')

@section('content')
    <h1>コメント編集</h1>

    @if ($errors->any())
        <div style="color:red;">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <form action="{{ route('comments.update', $comment->id) }}" method="POST">
        @csrf
        @method('PUT')

        <textarea name="content" rows="4" cols="50">{{ old('content', $comment->content) }}</textarea><br>

        <button type="submit">更新</button>
    </form>

    <a href="{{ route('article.show', $comment->article_id) }}">戻る</a>
@endsection
