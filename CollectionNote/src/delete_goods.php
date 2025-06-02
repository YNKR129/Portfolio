<?php
session_start();
// DB接続設定
$dsn = '';
$user = '';
$password = '';
$pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));

$goods_id = $_GET['goods_id'] ?? null;

?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>グッズ削除</title>
    <link rel="stylesheet" href="../public/css/style.css">
    <style>
        .message {
            text-align: center;
            color: #333;
            font-size: 18px;
            margin-top: 50px;
        }
        .button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #333; /* ボタンをダークグレーに変更 */
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-size: 16px;
            margin-top: 20px;
            text-align: center;
        }
        .button:hover {
            background-color: #666; /* ホバー時にライトグレーに変更 */
        }
        .container {
            max-width: 600px;
            margin: 100px auto;
            padding: 20px;
            background-color: #f4f4f9;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            color: #333;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>グッズ削除</h2>
        <?php
        if ($goods_id) {
            // グッズをデータベースから削除
            $stmt = $pdo->prepare('DELETE FROM goods WHERE goods_id = :goods_id');
            $stmt->execute([':goods_id' => $goods_id]);

            echo "<p class='message'>グッズが削除されました。</p>";
            echo "<div style='text-align: center;'><a href='index.php' class='button'>トップページへ戻る</a></div>";
        } else {
            echo "<p class='message'>無効なグッズIDです。</p>";
            echo "<div style='text-align: center;'><a href='index.php' class='button'>トップページへ戻る</a></div>";
        }
        ?>
    </div>
</body>
</html>
