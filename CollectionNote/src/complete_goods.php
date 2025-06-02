<?php
session_start(); // セッションを使用してログインユーザー情報を取得

// データベース接続情報
$dsn = '';
$user = '';
$password = '';
$pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));

include 'header.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // POSTデータを取得
    $goods_name = $_POST['goods_name'] ?? '';
    $category = $_POST['category'] ?? '';
    $quantity = $_POST['quantity'] ?? '';
    $image_name = $_POST['image_name'] ?? '';
    $image_tmp = base64_decode($_POST['image_tmp'] ?? '');
    
    // 画像の保存先パス
    $image_dest_path = realpath(__DIR__ . '/../public/images') . '/' . $image_name;
    file_put_contents($image_dest_path, $image_tmp);

    // データベースに新規グッズ情報を挿入
    $stmt = $pdo->prepare("INSERT INTO goods (user_id, goods_name, category, quantity, image_path, created_at, updated_at) VALUES (:user_id, :goods_name, :category, :quantity, :image_path, NOW(), NOW())");
    $stmt->execute([
        ':user_id' => $_SESSION['user_id'],
        ':goods_name' => $goods_name,
        ':category' => $category,
        ':quantity' => $quantity,
        ':image_path' => 'public/images/' . $image_name,
    ]);

    echo "グッズの登録が完了しました。";
    echo "<nav><a href='index.php'>トップページへ</a>";
} else {
    echo "不正なアクセスです。";
}
?>
