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
      <h1>応募フォーム</h1>
      <p>こちらの募集に応募します</p>
    </section>

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
        </tr>
        <tr>
        <?php $_SESSION['RECRUIT'] = $result['id'];
        $_SESSION['RECRUITPJ'] = $result['project_name']?>
          <td><?php if(isset($result['user_name'])) echo($result['user_name']); ?></td>
          <td><?php if(isset($result['entry_start'])) echo($result['entry_start']); ?></td>
          <td><?php if(isset($result['entry_end'])) echo($result['entry_end']);?></td>
          <td><?php if(isset($result['variation'])) echo($result['variation']);?></td>
          <td><?php if(isset($result['project_name'])) echo($result['project_name']);?></td>
          <td><?php if(isset($result['skill'])) echo($result['skill']);?></td>
          <td><?php if(isset($result['location'])) echo($result['location']);?></td>
          <td><?php if(isset($result['working_day'])) echo($result['working_day']);?></td>
          <td><?php if(isset($result['working_time'])) echo($result['working_time']);?></td>
          <td><?php if(isset($result['staff_money'])) echo($result['staff_money']);?></td>
          <td><?php if(isset($result['traffic_cost'])) echo($result['traffic_cost']);?></td>
          <td><?php if(isset($result['comment'])) echo($result['comment']);?></td>
        </tr>
      </table>
    </section> <!--一覧テーブルEND-->


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
      <form name="form" action="entrycomp.php" method="post" enctype="multipart/form-data" onsubmit="return submitChk()">
        <input type="hidden" name="id">
        <!-- usersテーブルのidも一緒に送らないとrecruitsテーブルのuser_idに反映されない -->
        <input type="hidden" name="user_id" value="<?= $_SESSION["User"]["id"]; ?>">

<input type="hidden" name="id" >
        <dl class="clearfix">
          <dt>貴社名<span class="red">*</span></dt>
            <dd><input type="text" name="company_name" class="required" id="company">
              <span class="error_required"></span> <!--入力必須です-->
              <span class="error_name"></span><!--error時の-->
            </dd>

          <dt>貴社営業担当者名<span class="red">*</span></dt>
            <dd><input type="text" name="companyuser_name" class="required" id="name">
              <span class="error_required"></span> <!--入力必須です-->
              <span class="error_name"></span><!--error時の-->
            </dd>

          <dt>貴社営業担当メールアドレス<span class="red">*</span></dt>
            <dd><input type="text" name="mail" class="required" id="mail">
              <span class="error_required"></span> <!--入力必須です-->
              <span class="error_mail"></span><!--error時の-->
            </dd>

          <dt>就業予定者氏名<span class="red">*</span></dt>
            <dd><input type="text" name="entry_name" class="required" id="enname">
              <span class="error_required"></span> <!--入力必須です-->
              <span class="error_enname"></span><!--error時の-->
            </dd>

          <dt>就業予定者フリガナ<span class="red">*</span></dt>
            <dd><input type="text" name="entry_huri" class="required" id="huri">
              <span class="error_required"></span> <!--入力必須です-->
              <span class="error_huri"></span><!--error時の-->
            </dd>

          <dt>就業予定者電話番号<span class="red">*</span></dt>
            <dd><input type="text" name="tel" class="required" id="tel">
              <span class="error_required"></span> <!--入力必須です-->
              <span class="error_tel"></span><!--error時の-->
            </dd>

          <dt>就業予定者生年月日<span class="red">*</span></dt>
            <dd><input type="text" name="birth" class="required" >
              <span class="error_required"></span> <!--入力必須です-->
            </dd>

          <dt>就業予定者現住所<span class="red">*</span></dt>
            <dd><input type="text" name="address" class="required">
              <span class="error_required"></span> <!--入力必須です-->
            </dd>

          <dt>稼働可能日<span class="red">*</span></dt>
            <dd><input type="text" name="work_start" class="required">
              <span class="error_required"></span> <!--入力必須です-->
            </dd>

          <dt>面接可能日<span class="red">*</span></dt>
            <dd><input type="text" name="interviewday" class="required">
              <span class="error_required"></span> <!--入力必須です-->
            </dd>

          <dt>所持スキル<span class="red">*</span></dt>
            <dd><input type="text" name="skill" class="required">
              <span class="error_required"></span> <!--入力必須です-->
            </dd>

          <dt>就業予定者写真<span class="red">*</span></dt>
            <dd><input type="file" name="up_file" class="required"></dd>
            <span class="error_required"></span> <!--入力必須です-->

          <dt class="long">自己PRがありましたらご記入ください</dt>
            <dd><textarea class="big" name="pr"></textarea></dd>
          <dt class="long">その他気になりました点がありましたらご記入ください</dt>
            <dd><textarea class="big" name="comment"></textarea></dd>
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
