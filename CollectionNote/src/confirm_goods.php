<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>登録内容の確認</title>
    <link rel="stylesheet" href="../public/css/style.css">
</head>
<body>
    

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // POSTデータを取得
        $goods_name = $_POST['goods_name'] ?? '';
        $category = $_POST['category'] ?? '';
        $quantity = $_POST['quantity'] ?? '';
        $image_tmp = $_FILES['image']['tmp_name'] ?? '';
        $image_name = $_FILES['image']['name'] ?? '';
        
        include 'header.php';
        echo "<h2>登録内容の確認</h2>";

        // ファイルはまだアップロードしない
        $image_data = base64_encode(file_get_contents($image_tmp));

        echo "<p style='text-align: center;'>グッズ名: " . htmlspecialchars($goods_name) . "</p>";
        echo "<p style='text-align: center;'>カテゴリー: " . htmlspecialchars($category) . "</p>";
        echo "<p style='text-align: center;'>数量: " . htmlspecialchars($quantity) . "</p>";
        echo "<p style='text-align: center;'>画像:</p><div style='text-align: center;'><img src='data:image/jpeg;base64," . $image_data . "' alt='goods image' style='max-width: 100px; height: auto;'></div>";

        // 確認フォーム（hiddenフィールドに値を保持して送信）
        echo '<form action="complete_goods.php" method="post" enctype="multipart/form-data">';
        echo '<input type="hidden" name="goods_name" value="' . htmlspecialchars($goods_name) . '">';
        echo '<input type="hidden" name="category" value="' . htmlspecialchars($category) . '">';
        echo '<input type="hidden" name="quantity" value="' . htmlspecialchars($quantity) . '">';
        echo '<input type="hidden" name="image_name" value="' . htmlspecialchars($image_name) . '">';
        echo '<input type="hidden" name="image_tmp" value="' . $image_data . '">';
        echo '<button type="submit">登録を確定</button>';
        echo '</form>';
    } else {
        echo "不正なアクセスです。";
    }
    ?>
</body>
</html>
