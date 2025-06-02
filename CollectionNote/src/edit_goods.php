<?php
session_start();
// DB接続設定
$dsn = '';
$user = '';
$password = '';
$pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));

$goods_id = $_GET['goods_id'] ?? null;

include 'header.php';

if ($goods_id) {
    // 編集対象のグッズ情報を取得
    $stmt = $pdo->prepare('SELECT * FROM goods WHERE goods_id = :goods_id');
    $stmt->execute([':goods_id' => $goods_id]);
    $goods = $stmt->fetch(PDO::FETCH_ASSOC);
} else {
    echo "無効なグッズIDです。";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // フォームから送信されたデータを取得
    $goods_name = $_POST['goods_name'] ?? '';
    $category = $_POST['category'] ?? '';
    $quantity = $_POST['quantity'] ?? 0;

    // 画像のアップロード処理
    $image_path = "../" . $goods['image_path']; // 既存の画像パスをデフォルトに設定

    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $image_tmp_path = $_FILES['image']['tmp_name'];
        $image_name = 'goods_' . uniqid() . '.' . pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
        $image_dest_path = realpath(__DIR__ . '/../public/images') . '/' . $image_name;

        // 新しい画像をアップロード
        if (move_uploaded_file($image_tmp_path, $image_dest_path)) {
            // 古い画像を削除（存在する場合）
            if (file_exists($goods['image_path'])) {
                unlink($goods['image_path']);
            }
            $image_path = 'public/images/' . $image_name; // 新しい画像パスに更新
        }
    }

    // データベースを更新
    $stmt = $pdo->prepare('UPDATE goods SET goods_name = :goods_name, category = :category, quantity = :quantity, image_path = :image_path, updated_at = NOW() WHERE goods_id = :goods_id');
    $stmt->execute([
        ':goods_name' => $goods_name,
        ':category' => $category,
        ':quantity' => $quantity,
        ':image_path' => $image_path,
        ':goods_id' => $goods_id
    ]);

    echo "グッズ情報が更新されました。";
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>グッズ編集</title>
    <link rel="stylesheet" href="../public/css/style.css">
</head>
<body>
    <div class="container">
        <h2>グッズ編集</h2>
        <form action="edit_goods.php?goods_id=<?php echo $goods_id; ?>" method="post" enctype="multipart/form-data">
            <div>
                <label for="goods_name">グッズ名:</label>
                <input type="text" id="goods_name" name="goods_name" value="<?php echo htmlspecialchars($goods['goods_name']); ?>" required>
            </div>
            <div>
                <label for="category">カテゴリー:</label>
                <select id="category" name="category" required>
                    <option value="">--選択してください--</option>
                    <?php
                    // categoryテーブルからカテゴリー名を取得
                    $stmt = $pdo->query('SELECT * FROM category');
                    $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    // 既存のカテゴリーを選択済みにする
                    foreach ($categories as $category) {
                        $selected = ($goods['category'] == $category['category_name']) ? 'selected' : '';
                        echo '<option value="' . htmlspecialchars($category['category_name']) . '" ' . $selected . '>' . htmlspecialchars($category['category_name']) . '</option>';
                    }
                    ?>
                </select>
            </div>
            <div>
                <label for="quantity">数量:</label>
                <input type="number" id="quantity" name="quantity" value="<?php echo htmlspecialchars($goods['quantity']); ?>" required>
            </div>
            <div>
                <label>現在の画像:</label><br>
                <img src="<?php echo "../" . htmlspecialchars($goods['image_path']); ?>" alt="goods image" style="max-width: 100px; height: auto;"><br>
                <label for="image">新しい画像（変更する場合のみ）:</label>
                <input type="file" id="image" name="image" accept="image/*">
            </div>
            <div>
                <button type="submit">更新</button>
            </div>    
            <div style="text-align: center;">
                <a href="index.php" class="button">戻る</a>
            </div>
        </form>
    </div>
</body>
</html>
