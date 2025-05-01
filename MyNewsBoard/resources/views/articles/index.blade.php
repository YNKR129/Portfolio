@extends('layout')

@section('content')
    <h1>記事一覧</h1>
    <ul>
        @foreach ($articles as $article)
            <li>
                <a href="{{ route('article.show', $article['id']) }}">
                    {{ $article['title'] }}
                </a>
            </li>
        @endforeach
    </ul>
@endsection
