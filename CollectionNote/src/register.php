<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>会員登録</title>
    <link rel="stylesheet" href="../public/css/style.css">
</head>
<body>
    <?php
        include 'header.php';
    ?>
    <h2>会員登録</h2>
    <form action="register.php" method="post">
        <div>
            <label for="username">ユーザー名:</label>
            <input type="text" id="username" name="username" required>
        </div>
        <div>
            <label for="email">メールアドレス:</label>
            <input type="email" id="email" name="email" required>
        </div>
        <div>
            <label for="password">パスワード:</label>
            <input type="password" id="password" name="password" required>
        </div>
        <div>
            <button type="submit">登録</button>
        </div>
        <div style='text-align: center;'>アカウントをすでにお持ちの方は、<a href="login_form.php">こちらからログインへ</a></div>
    </form>

    <?php
    // DB接続設定
    $dsn = '';
    $user = '';
    $password = '';
    $pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
    

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $username = $_POST['username'] ?? '';
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';

        if (!empty($username) && !empty($email) && !empty($password)) {
            // メールアドレスが既に存在するか確認
            $stmt = $pdo->prepare('SELECT COUNT(*) FROM users WHERE email = :email');
            $stmt->execute(['email' => $email]);
            $count = $stmt->fetchColumn();

            if ($count == 0) {
                // パスワードをハッシュ化
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);

                // 新しいユーザーをデータベースに挿入
                $stmt = $pdo->prepare('INSERT INTO users (username, password, email, created_at) VALUES (:username, :password, :email, NOW())');
                $stmt->execute(['username' => $username, 'password' => $hashed_password, 'email' => $email]);

                echo "会員登録が完了しました。";
                // 会員登録が完了したら、ログインフォームにリダイレクト
                header('Location: login_form.php');
            } else {
                echo "そのメールアドレスは既に使用されています。";
            }
        } else {
            echo "全てのフィールドを入力してください。";
        }
    }
    ?>
</body>
</html>