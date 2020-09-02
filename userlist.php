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
    <link rel="stylesheet" href="css/userlist.css">
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

<!-- <section id="wrrap"> -->
  <div class="contents_wrap">
      <div class="contents_area">
          <div class="content_block">
<!-- 削除しますか？ -->
     <script>
         /*** 確認ダイアログの返り値によりフォーム送信*/
         function submitChk () {
             /* 確認ダイアログ表示 */
             var flag = confirm ( "削除してもよろしいですか？");
             /* TRUEなら送信、FALSEなら送信しない */
             return flag;
         }
     </script>

      <section class="subtitle">
        <h1>登録中の協力会社ユーザ一覧</h1>
      </section>

      <section class="ichiran">
        <table class="table_box">
          <!-- 項目 -->
          <tr>
            <th>登録会社名</th>
            <th>登録者氏名</th>
            <th>所属区分</th>
            <th>登録者連絡先</th>
            <th>メールアドレス</th>
            <th>設定パスワード</th>
            <th></th>
          </tr>


          <!-- 中身 -->
          <!-- DB情報をとってループ表示-->
          <?php
          try {
            /////データーベースに接続（オブジェクト指向で）
            $user = new User($host,$dbname,$user,$pass);
            $user->connectDb();

            /////参照select
            $result = $user->userlist();

            //foreachでデータベースから取得したデータを1行ずつループ処理

            foreach ($result as $row){?>
            <tr id="userdell_<?=$row['id']?>" data-id="<?=$row['id']?>">
              <td><?=$row['company_name']?></td>
              <td><?=$row['user_name']?></td>
              <td><?=$row['division']?></td>
              <td><?=$row['tel']?></td>
              <td><?=$row['mail']?></td>
              <td><?=$row['password']?></td>
              <td><a id="userdelete" class="btn btn--red btn--cubic">削除</a></td> <!--テスト-->
          </tr>
            <?php
          }//tryおわり
          } catch (Exception $e) {
            echo   'エラーが発生しました。:' . $e->getMessage();
          }//catchおわり
            ?>
        </table>
  </section> <!--一覧テーブルEND-->


    </div>
</div>
</div>

<!-- フッター -->
<div class="footer_area">
    <div class="footer_block">
        <div class="footer_box">
            <section class="btns">
                <a href="tirtop.php" id="submit_btn">TOPへ</a>
                <a href="userlist_regist.php" id="submit_btn">追加</a>
            </section><!--ボタン終わり-->
      <!-- フッター導入 -->
        <?php
        require("require/footer.php")
         ?>
       </div>
   </div>
</div>
 </section> <!--wrrapEND-->

     <!-- delete削除 -->
          <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script> -->
          <script src="js/topdelete.js"></script>
  </body>

</html>
