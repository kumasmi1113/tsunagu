<?php
session_start();

//config.php,use.phpを読み込み（インクルード）
require_once("config/config.php");
require_once("model/User.php");

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

  <?php
   //接続エラーをキャッチできるようにtry&catch
   try {

        /////////入力必須のecho(empty空かどうか)
              if (empty($_POST["user_name"])) {
                    echo "名前は入力必須です。";
                    echo "<br>";
                    echo "入力画面に戻り、名前を入力してください";
                    return false;
                }
              if (empty($_POST["company_name"])) {
                      echo "貴社名は入力必須です。";
                      echo "<br>";
                      echo "入力画面に戻り、フリガナを入力してください";
                      return false;
                  }
              if (empty($_POST["mail"])) {
                      echo "メールアドレスは入力必須です。";
                      echo "<br>";
                      echo "入力画面に戻り、お問い合わせ内容を入力してください";
                      return false;
                  }
              if (empty($_POST["tel"])) {
                      echo "電話番号は入力必須です。";
                      echo "<br>";
                      echo "入力画面に戻り、電話番号を入力してください";
                      return false;
                  }
              if (empty($_POST["password"])) {
                      echo "パスワードは入力必須です。";
                      echo "<br>";
                      echo "入力画面に戻り、パスワードを入力してください";
                      return false;
                  }





         /////データーベースに接続（オブジェクト指向で）
         $user = new User($host,$dbname,$user,$pass);
         $user->connectDb();

         /////登録処理（ポストが飛んで来たら）
         if($_POST){
           $user->useradd($_POST);
         }

     }//tryおわり
        //DBに異常があった場合検知（キャッチ）できるようにしておく
   catch (PDOException $e) { // PDOExceptionをキャッチする
        print "エラー!: " . $e->getMessage() . "<br/gt;";
         die();
     }
    ?>


    <section class="subtitle">
      <h1>登録が完了いたしました</h1>
    </section>


    <section class="entryform">
      <!-- <h2>下記の項目をご記入の上確認ボタンを押してください。</h2> -->
      <p class="text">ユーザーの新規登録が完了いたしました</p>

      <a href="login.php" id="submit_btn">ログインへ</a>
      <a href="tirtop.php" id="submit_btn">TOPへ</a>

    </section>

    <!-- フッター導入 -->
    <?php
    require("require/footer.php")
     ?>
     </section> <!--wrrapEND-->
  </body>

</html>
