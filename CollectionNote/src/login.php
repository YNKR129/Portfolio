<?php
session_start();  // セッションを開始

// データベース接続情報
$dsn = '';
$user = '';
$password = '';
$pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));

// フォームから送信されたデータを取得
$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';

// ユーザー名とパスワードの検証
if (!empty($username) && !empty($password)) {
    // ユーザー名に一致するレコードを取得
    $stmt = $pdo->prepare('SELECT * FROM users WHERE username = :username');
    $stmt->execute(['username' => $username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        // ログイン成功
        // セッションにユーザー情報を保存
        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['user_name'] = $user['username'];

        // index.phpにリダイレクト
        header('Location: index.php');
        exit;  // リダイレクト後に処理が続かないようにする
    } else {
        // ログイン失敗
        echo "ユーザー名またはパスワードが間違っています。";
    }
} else {
    echo "ユーザー名とパスワードを入力してください。";
}
?>
