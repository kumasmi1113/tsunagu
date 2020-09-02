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
    <div class="deletearea"></div>

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
         <p>検索したい案件の名前を入力してください</p>
         <input type="search" name="searchname" class="searchsize" placeholder="キーワードを入力"
         value="<?php
             if (!empty($_POST['searchname'])) {
                 echo $_POST['searchname'];
             }
         ?>">
         <input type="submit" name="submit" class="searchsizebtn" value="検索">
         </form>


      <section class="ichiran">
        <table class="table_box">
          <tr>
            <th>案件<br>担当者</th>
            <th class="shape">募集<br>開始日</th>
            <th class="shape">募集<br>終了日</th>
            <th>種別</th>
            <th>案件名</th>
            <th>必要<br>スキル</th>
            <th>勤務地</th>
            <th class="shape2">勤務<br>日数</th>
            <th>勤務時間</th>
            <th>単金</th>
            <th>交通費</th>
            <th>備考</th>
            <th></th>
            <th></th>
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

          /////案件名検索
          if (!empty($_POST['searchname'])) {
            $result = $user->searchname();
          }


          //foreachでデータベースから取得したデータを1行ずつループ処理
          foreach ($result as $row):?>
            <tr id="dell_<?=$row['id']?>" data-id="<?=$row['id']?>">
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
            <td><a href="recruitform_edit.php?id= <?=$row['id']?>" class="btn btn--green btn--cubic">編集</a></td>
            <!-- <td><a href="" class="btn btnred btncubic">削除</a></td> -->
            <td><a id="topdelete" class="btn btn--red btn--cubic">削除</a></td> <!--テスト-->
            </tr>
    <?php endforeach;
    } catch (Exception $e) {
      echo   'エラーが発生しました。:' . $e->getMessage();
    }//catchおわり
     ?>
        </table>
      </section> <!--一覧テーブルEND-->

      <section class="recruit">
        <td><a href="recruitform.php" class="btn btn--yellow btn--cubic">案件募集をする</a></td>
      </section>

      <section class="userlist">
        <td><a href="userlist.php" class="btn btn--tir btn--cubic">協力会社登録ユーザ一覧</a></td>
      </section>

      <section class="recruitlist">
        <td><a href="entrylist.php" class="btn btn--tir btn--cubic">応募を見る</a></td>
      </section>


      <!-- フッター導入 -->
        <?php
        require("require/footer.php")
         ?>

     </section> <!--wrrapEND-->

<!-- delete削除 -->
     <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script> -->
     <script src="js/topdelete.js"></script>
  </body>

</html>
