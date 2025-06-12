# ポートフォリオ

---

## 目次

- [私のスキルセット](#私のスキルセット)
- [プロジェクト一覧](#プロジェクト一覧)
  - [1. CollectionNote: グッズ管理Webアプリケーション](#1-collectionnote-グッズ管理webアプリケーション)
  - [2. MyNewsBoard: ニュースコメントWebアプリケーション](#2-mynewsboard-ニュースコメントwebアプリケーション)
- [お問い合わせ](#お問い合わせ)

---

## 私のスキルセット

私が主に扱える技術スタックです。

### 主要言語
`PHP` `Java` `C` `Python`

### フレームワーク/ライブラリ
`Laravel`

### データベース
`MySQL`

### その他ツール・技術
`SQL`

### 技術スタック
<p>
  <img src="https://img.shields.io/badge/-PHP-777BB4?style=flat-square&logo=php&logoColor=white"/>
  <img src="https://img.shields.io/badge/-Java-007396?style=flat-square&logo=java&logoColor=white"/>
  <img src="https://img.shields.io/badge/-C-A8B9CC?style=flat-square&logo=c&logoColor=white"/>
  <img src="https://img.shields.io/badge/-Python-3776AB?style=flat-square&logo=python&logoColor=white"/>
  <img src="https://img.shields.io/badge/-Laravel-FF2D20?style=flat-square&logo=laravel&logoColor=white"/>
  <img src="https://img.shields.io/badge/-MySQL-4479A1?style=flat-square&logo=mysql&logoColor=white"/>
</p>

---

## プロジェクト一覧

### 1. CollectionNote: グッズ管理Webアプリケーション

![CollectionNoteのスクリーンショット](https://github.com/YNKR129/Portfolio/tree/main/images/CollectionNote/index.png)

-   **概要:** 4週間のインターンでPHPを学び、その学習成果として作成したグッズ管理Webアプリケーションです。
    ログイン、会員登録、ログアウトといったユーザー認証機能を実装し、グッズの登録・閲覧・更新・削除（CRUD）が可能です。
-   **使用技術:** PHP, MySQL
-   **GitHubリポジトリ:** [https://github.com/YNKR129/Portfolio/tree/main/CollectionNote](https://github.com/YNKR129/Portfolio/tree/main/CollectionNote) 

#### 工夫した点 / 苦労した点と解決策 / 学び

初めてのWebアプリケーション開発で、**CollectionNote**の構築は多くの学びをもたらしました。

* **基本的なWebアプリケーションの仕組みの理解:**
    * PHPで開発したことで、フレームワークが提供する機能の裏側にある、**リクエストとレスポンスの処理、セッション管理、ユーザー認証フロー**といったWebアプリケーションの根幹を、手作業で実装しながら深く理解することができました。
    * 特に、**データベースとアプリケーションのデータのやり取り**、そして**ログイン、会員登録、ログアウト、CRUD（作成、読み取り、更新、削除）といった各画面間でのデータの連携や状態管理**には苦労しましたが、一つずつコードを書き、挙動を確認することで、Webアプリケーション全体の「つながり」を肌で感じることができました。

* **データベースへの理解深化:**
    * MySQLを使用したことで、テーブル設計からデータの操作（SELECT, INSERT, UPDATE, DELETE）まで、**データベースの基礎**を実践的に学びました。アプリケーションのデータ永続化において、どのようにデータが保存され、取得されるのか、その一連の流れを体験することで、データベースの重要性を深く認識しました。

---

### 2. MyNewsBoard: ニュースコメントWebアプリケーション

![CollectionNoteのスクリーンショット⓵](https://github.com/YNKR129/Portfolio/tree/main/images/MyNewsBoard/index.png)
![CollectionNoteのスクリーンショット⓶](https://github.com/YNKR129/Portfolio/tree/main/images/MyNewsBoard/show.png)

-   **概要:** Laravel学習のために独学で作成したニュースコメントWebアプリケーションです。`https://jsonplaceholder.typicode.com/posts/`のAPIを利用してニュース一覧を表示し、ログイン・会員登録・ログアウトなどのユーザー認証機能と、ニュースに対するコメントのCRUD機能を実装しました。
-   **使用技術:** PHP (Laravel), MySQL, 外部API (`jsonplaceholder.typicode.com`)
-   **GitHubリポジトリ:** [https://github.com/YNKR129/Portfolio/tree/main/MyNewsBoard](https://github.com/YNKR129/Portfolio/tree/main/MyNewsBoard)

#### 工夫した点 / 苦労した点と解決策 / 学び

**MyNewsBoard**の開発は、Laravelを独学で学ぶという挑戦であり、その過程で多くの発見がありました。

* **Laravelによる開発効率の向上とMVCの理解:**
    * 独学でのモチベーション維持には苦労しましたが、Laravelを使うことで、CollectionNoteで苦労したログインやCRUD機能の**実装が格段に容易になる**ことを実感しました。これは、Laravelが提供するルーティング、Bladeテンプレートといった機能の恩恵によるものでした。
    * 特に、Laravelの採用により、**MVC（Model-View-Controller）アーキテクチャ**の概念と、それがどのようにコードの構造化と保守性向上に寄与するのかを実践的に理解することができました。各要素が明確に分離されていることで、開発の見通しが良くなり、PHPでの記述量も大幅に削減できることを学びました。

* **外部API連携の経験:**
    * `https://jsonplaceholder.typicode.com/posts/`というAPIを利用してニュース一覧を表示したことで、**外部サービスとの連携方法**を実践的に学ぶことができました。APIからのデータ取得、アプリケーション内でのデータの整形、そして表示に至るまでの一連の流れを経験し、実際の開発におけるAPI利用の基礎を身につけました。

---

## お問い合わせ 

-   **Mail:** [ynkr129@gmail.com](ynkr129@gmail.com)
-   **GitHub:** [https://github.com/YNKR129](https://github.com/YNKR129)
-   **Wantedly:** [https://www.wantedly.com/id/YNKR129](https://www.wantedly.com/id/YNKR129)

---