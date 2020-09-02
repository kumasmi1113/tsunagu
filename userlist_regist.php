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
      <h1>新規登録</h1>
      <p>新規ユーザー登録をおこないます</p>
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

      <form name="form" action="userlist_comp.php" method="post" onsubmit="return submitChk()">
        <dl class="clearfix">
          <!-- inputtypeのnameをなおして！！ -->
          <dt>登録者名<span class="red">*</span></dt>
            <dd><input type="text" name="user_name" class="required" id="name">
              <span class="error_required"></span> <!--入力必須です-->
              <span class="error_name"></span><!--error時の-->
            </dd>

          <dt>所属区分<span class="red">*</span></dt>
            <dd><select name="division_id">
              <option value="1">協力会社</option>
              <option value="2">TIR</option>
            </select></dd>

          <dt>会社名<span class="red">*</span></dt>
            <dd><input type="text" name="company_name" placeholder="株式会社ティーアイアール" class="required" id="company">
              <span class="error_required"></span>
              <span class="error_name"></span>
            </dd>

          <dt>登録者電話番号(ハイフン無)<span class="red">*</span></dt>
            <dd><input type="text" name="tel"  class="required" id="tel">
              <span class="error_required"></span>
              <span class="error_tel"></span>
            </dd>

          <dt>メールアドレス<span class="red">*</span></dt>
            <dd><input type="text" name="mail" class="required" id="mail">
              <span class="error_required"></span>
              <br>
              <span class="error_mail"></span>
            </dd>

          <dt>設定したいパスワード<span class="red">*</span></dt>
            <dd><input type="text" name="password"  class="required" id="pass">
              <span class="error_required"></span>
              <br>
              <span class="error_pass"></span>
            </dd>
            <!-- 削除フラグ（初期は0） -->
            <input type="hidden" name="delid" value="0">

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
