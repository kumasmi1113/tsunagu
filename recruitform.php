<?php
session_start();
?>


<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>株式会社ティーアイアール案件共有サイト「つなぐ」</title>
    <link rel="stylesheet" href="css/base.css">
    <link rel="stylesheet" href="css/entryform.css">
    <link rel="stylesheet" href="css/validation.css">
    <link rel="icon" href="img/favicon.ico">
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/validation.js"></script>
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
      <h1>募集入力フォーム</h1>
      <p>募集をおこないます</p>
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
      <form name="form" action="recruitcomp.php" method="post" onsubmit="return submitChk()">
        <!-- usersテーブルのidも一緒に送らないとrecruitsテーブルのuser_idに反映されない -->
        <input type="hidden" name="user_id" value="<?= $_SESSION["User"]["id"]; ?>">

        <dl class="clearfix">
          <!-- inputtypeのnameをなおして！！ -->
          <dt style="width:140px">案件担当者<span class="red">*</span></dt>
            <dd><input type="text" name="user_name" placeholder="高砂紀彦" class="required" id="name">
              <span class="error_required"></span> <!--入力必須です-->
            </dd>

          <dt style="width:140px">募集開始日<span class="red">*</span></dt>
            <dd><input type="text" name="entry_start" placeholder="2020/1/1" class="required">
              <span class="error_required"></span> <!--入力必須です-->
            </dd>

          <dt style="width:140px">募集終了日<span class="red">*</span></dt>
            <dd><input type="text" name="entry_end" placeholder="2020/1/10" class="required">
              <span class="error_required"></span> <!--入力必須です-->
            </dd>

          <dt style="width:140px">種別<span class="red">*</span></dt>
            <dd><select name="variation_id" class="variation">
              <option value="1">通信</option>
              <option value="2">SES</option>
              <option value="3">その他</option>
            </select>
            </dd>

          <dt style="width:140px">案件名<span class="red">*</span></dt>
            <dd><input type="text" name="project_name" placeholder="ソフトバンク○○常勤スタッフ" class="required">
              <span class="error_required"></span> <!--入力必須です-->
            </dd>

          <dt style="width:140px">必要スキル<span class="red">*</span></dt>
            <dd><input type="text" name="skill" placeholder="ジニー操作経験、店長経験" class="required">
              <span class="error_required"></span> <!--入力必須です-->
            </dd>

          <dt style="width:140px">勤務地<span class="red">*</span></dt>
            <dd><input type="text" name="location" placeholder="神奈川県横浜市" class="required">
              <span class="error_required"></span> <!--入力必須です-->
            </dd>

          <dt style="width:140px">勤務日数<span class="red">*</span></dt>
            <dd><input type="text" name="working_day" placeholder="21日/月" class="required">
              <span class="error_required"></span> <!--入力必須です-->
            </dd>

          <dt style="width:140px">勤務時間<span class="red">*</span></dt>
            <dd><input type="text" name="working_time" placeholder="8時間/日(うち休憩1時間)" class="required">
              <span class="error_required"></span> <!--入力必須です-->
            </dd>

          <dt style="width:140px">単金<span class="red">*</span></dt>
            <dd><input type="text" name="staff_money" placeholder="300,000円/月" class="required">
              <span class="error_required"></span> <!--入力必須です-->
            </dd>

          <dt style="width:140px">交通費<span class="red">*</span></dt>
            <dd><input type="text" name="traffic_cost" placeholder="単金に含まれる" class="required">
              <span class="error_required"></span> <!--入力必須です-->
            </dd>

          <dt style="width:140px">備考</dt>
          <dd><textarea name="comment" placeholder="必要な方は社宅を用意します"></textarea></dd>
      </dl>

<!-- 確認ボタン -->
        <input type="submit" name="submit" value="確&emsp;認" id="submit_btn">

    </form>
    </section>

    <!-- フッター導入 -->
    <?php
    require("require/footer.php")
     ?>
     </section> <!--wrrapEND-->
  </body>

</html>
