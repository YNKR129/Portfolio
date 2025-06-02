<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>グッズ新規登録</title>
    <link rel="stylesheet" href="../public/css/style.css">
</head>
<body>
    <?php
        include 'header.php';

    ?>
    <h2>新規グッズ登録</h2>
    <form action="confirm_goods.php" method="post" enctype="multipart/form-data">
        <div>
            <label for="goods_name">グッズ名:</label>
            <input type="text" id="goods_name" name="goods_name" required>
        </div>
        <div>
            <label for="category">カテゴリー:</label>
            <select id="category" name="category" required>
                <option value="">--選択してください--</option>
                <?php
                // データベース接続情報
                $dsn = '';
                $user = '';
                $password = '';
                $pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));

                // categoryテーブルからカテゴリー名を取得
                $stmt = $pdo->query('SELECT * FROM category');
                $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
                
                
                foreach ($categories as $category) {
                    echo '<option value="' . htmlspecialchars($category['category_name']) . '">' . htmlspecialchars($category['category_name']) . '</option>';
                }
                ?>
            </select>
        </div>
        <div>
            <label for="quantity">数量:</label>
            <input type="number" id="quantity" name="quantity" required min="1">
        </div>
        <div>
            <label for="image">画像:</label>
            <input type="file" id="image" name="image" accept="image/*" required>
        </div>
        <div>
            <button type="submit">確認</button>
            <a href="index.php" class="button">戻る</a>
        </div>
    </form>
</body>
</html>
