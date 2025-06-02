<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>グッズ管理サイト</title>
    <!-- 外部CSS読み込み -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="../public/css/style.css">
</head>
<body>
    <div class="container">
        <?php
            session_start();

            // DB接続設定
            $dsn = '';
            $user = '';
            $password = '';
            $pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
            
            include 'header.php';
            
            // ログインしていない場合
            if (!isset($_SESSION['user_id'])) {
                echo "<h2>ようこそ！グッズ登録サイトへ！</h2>";
                echo "<p class='message'>「ログイン」もしくは「会員登録」してください。</p>";
                echo "<nav><a href='login_form.php'>ログイン</a> / <a href='register.php'>会員登録</a></nav>";
            } else {
                // ログインしている場合
                $username = $_SESSION['user_name'];
                $user_id = $_SESSION['user_id']; // ログイン中のユーザーIDを取得
                echo "<h3 style=text-align: left;>ようこそ、" . htmlspecialchars($username, ENT_QUOTES, 'UTF-8') . "さん！</h3>";

                echo "<h2>所持グッズ</h2>";

                // 現在ログイン中のユーザーのグッズを取得
                $stmt = $pdo->prepare('SELECT * FROM goods WHERE user_id = :user_id');
                $stmt->execute([':user_id' => $user_id]);
                $goods = $stmt->fetchAll();
                $row_count = $stmt->rowCount();

                if ($row_count > 0) {
                    echo "<table border='1'>";
                    echo "<tr>";
                    echo "<th>グッズ名</th>";
                    echo "<th>カテゴリー</th>";
                    echo "<th>数量</th>";
                    echo "<th>画像</th>";
                    echo "<th>操作</th>";
                    echo "</tr>";
                    foreach ($goods as $row) {
                        $image_path = "../" . $row['image_path'];
                        if (!file_exists($image_path)) {
                            $image_path = "../public/images/no_image_available.png";
                        }
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row['goods_name']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['category']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['quantity']) . "</td>";
                        // 画像をリンクにし、クリックすると詳細ページに遷移
                        echo "<td><a href='detail_goods.php?goods_id=" . htmlspecialchars($row['goods_id']) . "'><img src='" . htmlspecialchars($image_path) . "' alt='goods image' style='max-width: 250px; height: auto;'></a></td>";
                        echo "<td>";
                        // 編集ボタン
                        echo "<a href='edit_goods.php?goods_id=" . htmlspecialchars($row['goods_id']) . "' class='button'>編集</a> ";
                        echo "  /  ";
                        // 削除ボタン
                        echo "<a href='delete_goods.php?goods_id=" . htmlspecialchars($row['goods_id']) . "' class='button delete-btn' onclick='return confirm(\"本当に削除しますか？\");'>削除</a>";
                        echo "</td>";
                        echo "</tr>";
                    }
                    echo "</table>";
                    echo "<nav><a href='add_goods.php' class='button'>新規グッズ登録</a></nav>";
                } else {
                    echo "<p class='message'>-- グッズが登録されていません --</p>";
                    echo "<nav><a href='add_goods.php' class='button'>新規グッズ登録</a></nav>";
                }
            }
        ?>
    </div>
</body>
</html>
