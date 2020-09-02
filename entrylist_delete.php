<?php
session_start();

//config.php,use.phpを読み込み（インクルード）
  require_once("config/config.php");
  require_once("model/User.php");


  //接続エラーをキャッチできるようにtry&catch
    try {
        /////データーベースに接続（オブジェクト指向で）
        $user = new User($host,$dbname,$user,$pass);
        $user->connectDb();

        //削除処理
        //entry.idが飛んでくる
        if (isset($_GET['id'])) {
         $user->delete($_GET['id']);
        }


  } catch (Exception $e) {
    echo   'エラーが発生しました。:' . $e->getMessage();
  }//catchおわり
   ?>




<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>株式会社ティーアイアール案件共有サイト「つなぐ」</title>
    <link rel="stylesheet" href="css/base.css">
    <link rel="stylesheet" href="css/comp.css">
    <link rel="icon" href="img/favicon.ico">
    <script type="text/javascript" src="js/jquery.js"></script>

  </head>

  <body>
    <?php
    require("require/bg.php")
     ?>

<section id="wrrap">

<!-- 株式会社○○、○○様 -->
  <?php
  require("require/from.php")
   ?>

    <section class="subtitle">
      <h1>削除が完了いたしました</h1>
    </section>


    <section class="entryform">
      <!-- <h2>下記の項目をご記入の上確認ボタンを押してください。</h2> -->
      <p class="text">応募者を削除いたしました</p>

      <a href="entrylist.php" id="entrylist_btn">応募者一覧へ</a>
    </section>

    <!-- フッター導入 -->
    <?php
    require("require/footer.php")
     ?>
     </section> <!--wrrapEND-->
  </body>

</html>
