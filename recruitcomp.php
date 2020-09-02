<?php
session_start();

//config.php,use.phpを読み込み（インクルード）
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
    <link rel="stylesheet" href="css/comp.css">
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

<?php
   //接続エラーをキャッチできるようにtry&catch
   try {
     /////////入力必須のecho(empty空かどうか)
           if (empty($_POST["user_name"])) {
                 echo "募集者氏名は入力必須です。";
                 echo "<br>";
                 echo "入力画面に戻り、募集者氏名を入力してください";
                 return false;
             }
           if (empty($_POST["entry_start"])) {
                   echo "募集開始日は入力必須です。";
                   echo "<br>";
                   echo "入力画面に戻り、募集開始日を入力してください";
                   return false;
               }
           if (empty($_POST["entry_end"])) {
                   echo "募集終了日は入力必須です。";
                   echo "<br>";
                   echo "入力画面に戻り、募集終了日を入力してください";
                   return false;
               }
           if (empty($_POST["project_name"])) {
                   echo "案件名は入力必須です。";
                   echo "<br>";
                   echo "入力画面に戻り、案件名を入力してください";
                   return false;
               }
           if (empty($_POST["skill"])) {
                   echo "必要スキルは入力必須です。";
                   echo "<br>";
                   echo "入力画面に戻り、必要スキルを入力してください";
                   return false;
               }
           if (empty($_POST["location"])) {
                   echo "勤務地は入力必須です。";
                   echo "<br>";
                   echo "入力画面に戻り、勤務地を入力してください";
                   return false;
               }
          if (empty($_POST["working_day"])) {
                   echo "勤務日数は入力必須です。";
                   echo "<br>";
                   echo "入力画面に戻り、勤務日数を入力してください";
                   return false;
               }
           if (empty($_POST["working_time"])) {
                    echo "勤務時間は入力必須です。";
                    echo "<br>";
                    echo "入力画面に戻り、勤務時間を入力してください";
                    return false;
                    }
            if (empty($_POST["staff_money"])) {
                     echo "単金は入力必須です。";
                     echo "<br>";
                     echo "入力画面に戻り、単金を入力してください";
                     return false;
                     }
            if (empty($_POST["traffic_cost"])) {
                    echo "交通費は入力必須です。";
                    echo "<br>";
                    echo "入力画面に戻り、交通費を入力してください";
                    return false;
                    }


         /////データーベースに接続（オブジェクト指向で）
         $user = new User($host,$dbname,$user,$pass);
         $user->connectDb();

         /////登録処理（ポストが飛んで来たら）
         if($_POST){
           $user->add($_POST);
         }

         ///メール
         $result = $user->userMail();



     }//tryおわり
        //DBに異常があった場合検知（キャッチ）できるようにしておく
   catch (PDOException $e) { // PDOExceptionをキャッチする
        print "エラー!: " . $e->getMessage() . "<br/gt;";
         die();
     }


     ////////自動返信メール/////////
     // 変数とタイムゾーンを初期化
       $header = null;
     	$auto_reply_subject = null;
     	$auto_reply_text = null;
       $admin_reply_subject = null;
       $admin_reply_text = null;
     	date_default_timezone_set('Asia/Tokyo');

       //日本語の使用宣言
     mb_language("ja");//写真
     mb_internal_encoding("UTF-8");//写真

       // ヘッダー情報を設定
       $header = "MIME-Version: 1.0\n";
       $header .= "From: TIRつなぐ事務局 <kumasmi1113@gmail.com\nBcc: {$result}\n";
       $header .= "Reply-To: TIRつなぐ事務局 <kumasmi1113@gmail.com>\n";

       // 件名を設定
       	$auto_reply_subject = '新着募集案件のおしらせ';

         // 本文を設定
       	 $auto_reply_text = "お世話になっております。株式会社ティーアイアールです。\n\n";
         $auto_reply_text = "新しい案件の募集が始まりましたのでお知らせいたします。\n\n";
      	 $auto_reply_text .= "配信日時：" . date("Y-m-d H:i") . "\n";
      	 $auto_reply_text .= "案件担当者：" . $_POST['user_name']. "\n";
       	 $auto_reply_text .= "募集開始日：" . $_POST['entry_start'] . "\n\n";
         $auto_reply_text .= "募集終了日：" . $_POST['entry_end'] . "\n\n";
         $auto_reply_text .= "案件名：" . $_POST['project_name'] . "\n\n";
         $auto_reply_text .= "必要スキル：" . $_POST['skill'] . "\n\n";
         $auto_reply_text .= "勤務地：" . $_POST['location'] . "\n\n";
         $auto_reply_text .= "勤務日数：" . $_POST['working_day'] . "\n\n";
         $auto_reply_text .= "勤務時間：" . $_POST['working_time'] . "\n\n";
         $auto_reply_text .= "単金：" . $_POST['staff_money'] . "\n\n";
         $auto_reply_text .= "交通費：" . $_POST['traffic_cost'] . "\n\n";
         $auto_reply_text .= "備考：" . $_POST['comment'] . "\n\n";
         $auto_reply_text .= "※募集内容は変更の可能性があります"."\n\n";
         $auto_reply_text .= "詳しくは当サイトをご確認ください". "\n\n";
       	 $auto_reply_text .= "株式会社ティーアイアール 案件共有サイト「つなぐ」運営局";
         // メール送信
         	mb_send_mail('kumasmi1113@gmail.com',$auto_reply_subject,$auto_reply_text, $header);

     ///////////自動送信メールおわり//////////////////////


    ?>


    <section class="subtitle">
      <h1>募集が完了いたしました</h1>

    </section>


    <section class="entryform">
      <!-- <h2>下記の項目をご記入の上確認ボタンを押してください。</h2> -->
      <p class="text">募集内容は登録している各協力会社担当者の<br>
        メールアドレスに送信致しました。</p>

      <a href="tirtop.php" id="submit_btn">TOPへ</a>
    </section>

    <!-- フッター導入 -->
    <?php
    require("require/footer.php")
     ?>
     </section> <!--wrrapEND-->
  </body>

</html>
