<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>News Board</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <header>
        <nav style="display: flex; justify-content: space-between; align-items: center;">
            <a href="{{ route('articles.index') }}">MyNewsBoard</a>

            <div>
                @auth
                    <!-- ログイン状態: ログアウトボタン表示 -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit">ログアウト</button>
                    </form>
                @endauth

                @guest
                    <!-- 未ログイン状態: ログインボタン表示 -->
                    <a href="{{ route('login') }}">ログイン</a>
                    /<a href="{{ route('register') }}">会員登録</a>
                @endguest
            </div>
        </nav>
    </header>


    <main>
        @yield('content')
    </main>

    <footer>
        <p>&copy; 2025 News Board</p>
    </footer>
</body>
</html>
