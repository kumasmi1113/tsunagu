<?php
session_start();

//config.phpを読み込み（インクルード）
require_once("config/config.php");
require_once("model/User.php");


  //接続エラーをキャッチできるようにtry&catch
    try {
        /////データーベースに接続（オブジェクト指向で）
        $user = new User($host,$dbname,$user,$pass);
        $user->connectDb();

        //参照処理
        if(isset($_GET['id'])){
          $result = $user->findById($_GET['id']);
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
    <link rel="stylesheet" href="css/entryform.css">
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
      <h1>募集編集フォーム</h1>
      <p>募集内容の編集をおこないます</p>
    </section>


    <!-- 確認ダイアログ -->
        <script>
            /*** 確認ダイアログの返り値によりフォーム送信*/
            function submitChk () {
                /* 確認ダイアログ表示 */
                var flag = confirm ( "送信してもよろしいですか？");
                /* TRUEなら送信、FALSEなら送信しない */
                return flag;
            }
        </script>

    <section class="entryform">
      <h2>下記の項目をご記入の上確認ボタンを押してください。</h2>
      <p class="text"><span class="red">*</span>は必須項目になります。</p>
      <form name="form" action="recruitcomp_edit.php" method="post" onsubmit="return submitChk()">
        <!-- usersテーブルのidも一緒に送らないとrecruitsテーブルのuser_idに反映されない -->
        <input type="hidden" name="user_id" value="<?= $_SESSION["User"]["id"]; ?>">
        <input type="hidden" name="id" value="<?php if (isset($result['id'])) echo($result['id']);?>">

        <dl class="clearfix">
          <dt style="width:140px">募集者氏名<span class="red">*</span></dt>
            <dd><input type="text" name="user_name" value="<?php if(isset($result['user_name'])) echo($result['user_name']); ?>" ></dd>
          <dt style="width:140px">募集開始日<span class="red">*</span></dt>
            <dd><input type="text" name="entry_start" value="<?php if(isset($result['entry_start'])) echo($result['entry_start']); ?>"></dd>
          <dt style="width:140px">募集終了日<span class="red">*</span></dt>
            <dd><input type="text" name="entry_end" value="<?php if(isset($result['entry_end'])) echo($result['entry_end']);?>"></dd>
          <dt style="width:140px">案件名<span class="red">*</span></dt>
            <dd><input type="text" name="project_name" value="<?php if(isset($result['project_name'])) echo($result['project_name']);?>"></dd>
          <dt style="width:140px">必要スキル<span class="red">*</span></dt>
            <dd><input type="text" name="skill" value="<?php if(isset($result['skill'])) echo($result['skill']);?>"></dd>
          <dt style="width:140px">勤務地<span class="red">*</span></dt>
            <dd><input type="text" name="location" value="<?php if(isset($result['location'])) echo($result['location']);?>"></dd>
          <dt style="width:140px">勤務日数<span class="red">*</span></dt>
            <dd><input type="text" name="working_day" value="<?php if(isset($result['working_day'])) echo($result['working_day']);?>"></dd>
          <dt style="width:140px">勤務時間<span class="red">*</span></dt>
            <dd><input type="text" name="working_time" value="<?php if(isset($result['working_time'])) echo($result['working_time']);?>"></dd>
          <dt style="width:140px">単金<span class="red">*</span></dt>
            <dd><input type="text" name="staff_money" value="<?php if(isset($result['staff_money'])) echo($result['staff_money']);?>"></dd>
          <dt style="width:140px">交通費<span class="red">*</span></dt>
            <dd><input type="text" name="traffic_cost" value="<?php if(isset($result['traffic_cost'])) echo($result['traffic_cost']);?>"></dd>
          <dt style="width:140px">備考</dt>
          <dd><textarea name="comment" ><?php if(isset($result['comment'])) echo($result['comment']);?></textarea></dd>
      </dl>

<!-- 確認ボタン -->
        <input type="submit" name="submit" value="確&emsp;認" id="submit_btn">
    </section>

    <!-- フッター導入 -->
    <?php
    require("require/footer.php")
     ?>
     </section> <!--wrrapEND-->
  </body>

</html>
