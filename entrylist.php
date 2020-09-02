<?php
session_start();

//config.phpを読み込み（インクルード）
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
    <link rel="stylesheet" href="css/entrylist.css">
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

     <!-- <section id="wrrap"> -->
       <div class="contents_wrap">
           <div class="contents_area">
               <div class="content_block">
    <section class="subtitle">
      <h1>応募情報一覧</h1>
    </section>

    <section class="ichiran">
      <table class="table_box">
        <!-- 項目 -->
        <tr>
          <th>案件募集者</th>
          <th>案件名</th>
          <th>協力会社名</th>
          <th>営業担当者名</th>
          <th>就業予定者名</th>
          <th></th>
        </tr>

        <?php
  //接続エラーをキャッチできるようにtry&catch
    try {
        /////データーベースに接続（オブジェクト指向で）
        $user = new User($host,$dbname,$user,$pass);
        $user->connectDb();

        /////参照select
          $result = $user->entrylist();


        //foreachでデータベースから取得したデータを1行ずつループ処理
        foreach ($result as $row):?>
          <tr>
              <td><?=$row['user_name']?></td>
              <td><?=$row['project_name']?></td>
              <td><?=$row['company_name']?></td>
              <td><?=$row['companyuser_name']?></td>
              <td><?=$row['entry_name']?></td>
              <td><a href="entrylist_detail.php?id= <?=$row['id']?>" class="btn btn--yellow btn--cubic">詳細</a></td>
          </tr>
        <?php endforeach;

  } catch (Exception $e) {
    echo   'エラーが発生しました。:' . $e->getMessage();
  }//catchおわり
   ?>
      </table><!--一覧テーブルEND-->
      </section><!--ichiranend-->

      <div class="footer_area">
          <div class="footer_block">
              <div class="footer_box">
                    <!-- TOPへ -->
                      <a href="tirtop.php" id="submit_btn">TOPへ</a>
                      <!-- フッター導入 -->
                      <?php
                      require("require/footer.php")
                      ?>
             </div>
          </div>
        </div>
     </section> <!--wrrapEND-->
  </body>
</html>
