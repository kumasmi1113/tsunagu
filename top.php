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
    <link rel="stylesheet" href="css/top.css">
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
      <h1>募集中の案件一覧</h1>
    </section>

<!-- 検索機能 -->
    <form action="" method="post" class="searchform">
   <p>種別で絞り込み検索</p>
   <select class="searchsize" name="search">
     <option value="0">全件表示</option>
     <option value="1">通信</option>
     <option value="2">SES</option>
     <option value="3">その他</option>
   </select>
   <!-- <input type="search" name="search" class="searchsize" placeholder="キーワードを入力" value=" -->

   <input type="submit" name="submit" class="searchsizebtn" value="検索">
   </form>


    <section class="ichiran">
      <table class="table_box">
        <tr>
          <th>案件担当者</th>
          <th class="shape">募集開始日</th>
          <th class="shape">募集終了日</th>
          <th>種別</th>
          <th>案件名</th>
          <th>必要スキル</th>
          <th>勤務地</th>
          <th class="shape2">勤務日数</th>
          <th>勤務時間</th>
          <th>単金</th>
          <th>交通費</th>
          <th>備考</th>
          <th></th>
        </tr>

        <!-- DB情報をとってループ表示-->
        <?php
  //接続エラーをキャッチできるようにtry&catch
    try {
        /////データーベースに接続（オブジェクト指向で）
        $user = new User($host,$dbname,$user,$pass);
        $user->connectDb();

        /////参照select
        $result = $user->findAll();

       if (!empty($_POST['search'])) {
         $result = $user->search();
       }


        //foreachでデータベースから取得したデータを1行ずつループ処理
        foreach ($result as $row):?>
          <tr>
          <td><?=$row['user_name']?></td>
          <td><?=$row['entry_start']?></td>
          <td><?=$row['entry_end']?></td>
          <td><?=$row['variation']?></td>
          <td><?=$row['project_name']?></td>
          <td><?=$row['skill']?></td>
          <td><?=$row['location']?></td>
          <td><?=$row['working_day']?></td>
          <td><?=$row['working_time']?></td>
          <td><?=$row['staff_money']?></td>
          <td><?=$row['traffic_cost']?></td>
          <td><?=$row['comment']?></td>
          <td><a href="entryform.php?id= <?=$row['id']?>" class="btn btn--yellow btn--cubic">応募する</a></td>

          </tr>
          <?php endforeach;

  } catch (Exception $e) {
    echo   'エラーが発生しました。:' . $e->getMessage();
  }//catchおわり
   ?>
      </table>
    </section> <!--一覧テーブルEND-->


    <section class="subtitle">
      <h1>応募までの流れ</h1>
    </section>

    <div class="setsumei">
      <img src="img/setsumei.png" alt="応募までの流れ">
    </div>


    <!-- フッター導入 -->
      <?php
      require("require/footer.php")
       ?>
     </section> <!--wrrapEND-->
  </body>

</html>
