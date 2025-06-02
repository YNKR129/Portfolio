<?php
session_start();
// DB接続設定
$dsn = '';
$user = '';
$password = '';
$pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));

$goods_id = $_GET['goods_id'] ?? null;

if ($goods_id) {
    // 対象のグッズ情報を取得
    $stmt = $pdo->prepare('SELECT * FROM goods WHERE goods_id = :goods_id');
    $stmt->execute([':goods_id' => $goods_id]);
    $goods = $stmt->fetch(PDO::FETCH_ASSOC);
} else {
    echo "無効なグッズIDです。";
    exit;
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>グッズ詳細情報</title>
    <link rel="stylesheet" href="../public/css/style.css">
</head>
<body>
    <h2>グッズ詳細情報</h2>
    <?php if ($goods): ?>
        <p style='text-align: center;'>グッズ名: <?php echo htmlspecialchars($goods['goods_name']); ?></p>
        <p style='text-align: center;'>カテゴリー: <?php echo htmlspecialchars($goods['category']); ?></p>
        <p style='text-align: center;'>数量: <?php echo htmlspecialchars($goods['quantity']); ?></p>
        <p style='text-align: center;'><img src="<?php echo "../" . htmlspecialchars($goods['image_path']); ?>" alt="goods image" style="max-width: 250px; height: auto;"></p>
    <?php else: ?>
        <p>グッズ情報が見つかりません。</p>
    <?php endif; ?>
    <div style="text-align: center;">
        <a href="index.php" class="button">戻る</a>
    </div>
</body>
</html>
