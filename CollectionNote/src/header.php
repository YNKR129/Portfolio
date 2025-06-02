<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>グッズ管理サイト</title>
    <link id="theme-style" rel="stylesheet" href="../public/css/style.css"> <!-- 初期状態でstyle.cssを読み込む -->
</head>
<body>
    <header>
        <div class="header-container">
            <h1 class="site-title"><a href="index.php" id="site-title-link">グッズ管理サイト</a></h1>
            <!--
            <div class="theme-toggle">
                <label class="switch">
                    <input type="checkbox" id="theme-toggle">
                    <span class="slider"></span>
                </label>
                <span>Dark Mode</span>
            </div>-->
            <nav class="nav-right">
                <?php if (isset($_SESSION['user_id'])): ?>
                    <a href="logout.php" class="logout-btn">ログアウト</a>
                <?php endif; ?>
            </nav>
        </div>
    </header>

    <script>
        // トグルスイッチの状態に応じてテーマを切り替える
        document.getElementById('theme-toggle').addEventListener('change', function() {
            if (this.checked) {
                document.getElementById('theme-style').setAttribute('href', '../public/css/darkmode.css'); // Dark Mode
                document.getElementById('site-title-link').classList.add('dark-mode'); // Dark mode クラスを追加
                localStorage.setItem('theme', 'dark'); // ローカルストレージに保存
            } else {
                document.getElementById('theme-style').setAttribute('href', '../public/css/style.css'); // Light Mode
                document.getElementById('site-title-link').classList.remove('dark-mode'); // Dark mode クラスを削除
                localStorage.setItem('theme', 'light'); // ローカルストレージに保存
            }
        });

        // ページが読み込まれたときに、保存されたテーマ設定を適用する
        window.addEventListener('load', function() {
            const savedTheme = localStorage.getItem('theme');
            if (savedTheme === 'dark') {
                document.getElementById('theme-style').setAttribute('href', '../public/css/darkmode.css');
                document.getElementById('site-title-link').classList.add('dark-mode'); // ダークモードクラスを追加
                document.getElementById('theme-toggle').checked = true;
            }
        });
    </script>
</body>
</html>
