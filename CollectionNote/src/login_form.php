<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ログインページ</title>
    <link rel="stylesheet" href="../public/css/style.css">
</head>
<body>
    <?php
        include 'header.php';
    ?>
    <h2>ログインページ</h2>
    <form action="login.php" method="post">
        <div>
            <label for="username">ユーザー名:</label>
            <input type="text" id="username" name="username" required>
        </div>
        <div>
            <label for="password">パスワード:</label>
            <input type="password" id="password" name="password" required>
        </div>
        <div>
            <button type="submit">ログイン</button>
        </div>
    </form>
    <div style='text-align: center;'>アカウントをお持ちでない場合は、<a href="register.php">こちらから登録</a></div>
</body>
</html>
