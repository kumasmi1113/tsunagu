<?php
session_start();

//config.phpを読み込み（インクルード）
require_once("config/config.php");
require_once("model/User.php");

try{

    // 1.MYSQLへの接続(オブジェクト指向で)
    $user = new User($host,$dbname,$user,$pass);
    $user->connectDb();

// ログイン//
  if ($_POST) {
    $result = $user->login($_POST);
    if(!empty($result)){  //$resultの中身が空ではない場合（中身がある場合）
      if ($result['division_id'] == 2 && $result['delid'] == 0) {  //division_idが自社2の場合かつ生存者の場合
        $_SESSION['User'] = $result; //$result（ユーザー情報）の内容をsessionに保存
        header('Location: /php_tirxamp/tirtop.php');  //session情報を保持してtirtopへ行く
        exit; //必ず入れないと不具合起きる
      }elseif ($result['division_id'] == 1 && $result['delid'] == 0) { //division_idが協力会社の場合かつ生存者の場合
        $_SESSION['User'] = $result; //$result（ユーザー情報）の内容をsessionに保存
        header('Location: /php_tirxamp/top.php');  //tirtopへ行く
        exit; //必ず入れないと不具合起きる
      }
    }else{
      $messeage ="ログインできませんでした";
    } //elseend
}
}//tryおわり

  catch (PDOException $e) { // PDOExceptionをキャッチする
  print "エラー!: " . $e->getMessage();
 }

 ?>



<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>株式会社ティーアイアール案件共有サイト「つなぐ」</title>
    <link rel="stylesheet" href="css/base.css">
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/geometric.css">
    <link rel="icon" href="img/favicon.ico">
    <script type="text/javascript" src="js/jquery.js"></script>
  </head>

  <body>

    <header></header>

    <div id="particles-js"></div>
    <script src="js/particles.js"></script>
    <script src="js/geometric.js"></script>

<div class="wrap">

    <h1 class="toptitle">株式会社ティーアイアール案件共有サイト</h1>
    <img class="imgtop" src="img/logo.png" alt="ロゴ" width="300">


<form action="" method="post">
  <div class="login">
    <!-- エラーの場合メッセージだす -->
    <?php if(isset($messeage)) echo "<p class='error'>" . $messeage . "</p>" ?>

    <input type="text" placeholder="mail" name="mail" ><br>
    <input type="password" placeholder="password" name="password"><br>
    <input type="submit" value="Login">
  </div>
</form>

<!-- フッター導入 -->
  <?php
  require("require/footer.php")
   ?>
   </div><!--wrap-->
  </body>

</html>
