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

        //参照処理
        if (isset($_GET['id'])) {
          $result = $user->findByEntryId($_GET['id']);
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
    <link rel="stylesheet" href="css/entrylist_detail.css">
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
      <h1>応募者詳細</h1>
    </section>

    <section class="ichiran">
      <table class="table_box">
        <tr>
          <th>案件担当者名</th>
            <td><?php if(isset($result['user_name'])) echo($result['user_name']); ?></td>
        </tr>
        <tr>
          <th>案件名</th>
          <td><?php if(isset($result['project_name'])) echo($result['project_name']); ?></td>
        </tr>
      </table>
<br>
      <table class="table_box">
        <tr>
          <th>協力会社名</th>
            <td><?php if(isset($result['company_name'])) echo($result['company_name']); ?></td>
        </tr>
        <tr>
          <th>営業担当者名</th>
          <td><?php if(isset($result['companyuser_name'])) echo($result['companyuser_name']); ?></td>
        </tr>
        <tr>
          <th>営業担当者メールアドレス</th>
          <td><?php if(isset($result['mail'])) echo($result['mail']); ?></td>
        </tr>
      </table>
<br>
      <table class="table_box">
        <tr>
          <th>就業予定者氏名</th>
          <td><?php if(isset($result['entry_name'])) echo($result['entry_name']); ?></td>
        </tr>
        <tr>
          <th>就業予定者フリガナ</th>
          <td><?php if(isset($result['entry_huri'])) echo($result['entry_huri']); ?></td>
        </tr>
        <tr>
          <th>就業予定者電話番号</th>
          <td><?php if(isset($result['tel'])) echo($result['tel']); ?></td>
        </tr>
        <tr>
          <th>就業予定者生年月日</th>
          <td><?php if(isset($result['birth'])) echo($result['birth']); ?></td>
        </tr>
        <tr>
          <th>就業予定者現住所</th>
          <td><?php if(isset($result['address'])) echo($result['address']); ?></td>
        </tr>
        <tr>
          <th>稼働可能日</th>
          <td><?php if(isset($result['work_start'])) echo($result['work_start']); ?></td>
        </tr>
        <tr>
          <th>面接可能日</th>
          <td><?php if(isset($result['interviewday'])) echo($result['interviewday']); ?></td>
        </tr>
        <tr>
          <th>所持スキル</th>
          <td><?php if(isset($result['skill'])) echo($result['skill']); ?></td>
        </tr>
        <tr>
          <th>写真貼付</th>
          <td><img src="images/<?php if(isset($result['up_file'])) echo($result['up_file']); ?>"></td>
        </tr>
        <tr>
          <th>自己PR</th>
          <td><?php if(isset($result['pr'])) echo($result['pr']); ?></td>
        </tr>
        <tr>
          <th>その他問い合わせ事項</th>
          <td><?php if(isset($result['comment'])) echo($result['comment']); ?></td>
        </tr>
      </table>
    </section> <!--一覧テーブルEND-->

      <!-- 確認ダイアログ -->
          <script>
              /*** 確認ダイアログの返り値によりフォーム送信*/
              function submitChk () {
                  /* 確認ダイアログ表示 */
                  var flag = confirm ( "本当に削除しますか？");
                  /* TRUEなら送信、FALSEなら送信しない */
                  return flag;
              }
          </script>
<!-- ボタン -->
  <section class="btns">
        <a href="entrylist.php" id="yellow_btn">戻る</a>
        <a href="entrylist_delete.php?id= <?=$result['id']?>" id="red_btn"  onclick="return confirm('本当に削除しますか？')">削除</a>
  </section>

    <!-- フッター導入 -->
    <?php
    require("require/footer.php")
     ?>
     </section> <!--wrrapEND-->
  </body>

</html>
