<?php
session_start();
$_SESSION = array(); // セッションの中身をすべて削除
session_destroy();   // セッションを破壊
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ログアウト完了</title>
    <link rel="stylesheet" href="../public/css/style.css">
</head>
<body>
    <?php
        include 'header.php';
    ?>
    <div class="container">
        <h2>ログアウトしました</h2>
        <p style="text-align: center;">ご利用いただきありがとうございました。またのご利用をお待ちしております。</p>
        <div style="text-align: center; margin-top: 20px;">
            <a href="login_form.php" class="button">ログイン</a>  /  
            <a href="register.php" class="button">会員登録</a>
        </div>
    </div>
</body>
</html>
