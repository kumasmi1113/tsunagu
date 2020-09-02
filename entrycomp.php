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
           if (empty($_POST["company_name"])) {
                 echo "貴社名は入力必須です。";
                 echo "<br>";
                 echo "入力画面に戻り、貴社名を入力してください";
                 return false;
             }
           if (empty($_POST["companyuser_name"])) {
                   echo "貴社営業担当者名は入力必須です。";
                   echo "<br>";
                   echo "入力画面に戻り、貴社営業担当者名を入力してください";
                   return false;
               }
           if (empty($_POST["mail"])) {
                  echo "貴社営業担当メールアドレスは入力必須です。";
                  echo "<br>";
                  echo "入力画面に戻り、貴社営業担当メールアドレスを入力してください";
                  return false;
                  }
           if (empty($_POST["entry_name"])) {
                   echo "就業予定者氏名は入力必須です。";
                   echo "<br>";
                   echo "入力画面に戻り、就業予定者氏名を入力してください";
                   return false;
               }
           if (empty($_POST["entry_huri"])) {
                   echo "就業予定者フリガナは入力必須です。";
                   echo "<br>";
                   echo "入力画面に戻り、就業予定者フリガナを入力してください";
                   return false;
               }
           if (empty($_POST["tel"])) {
                   echo "就業予定者電話番号は入力必須です。";
                   echo "<br>";
                   echo "入力画面に戻り、就業予定者電話番号を入力してください";
                   return false;
               }
           if (empty($_POST["birth"])) {
                   echo "就業予定者生年月日は入力必須です。";
                   echo "<br>";
                   echo "入力画面に戻り、就業予定者生年月日を入力してください";
                   return false;
               }
          if (empty($_POST["address"])) {
                   echo "就業予定者現住所は入力必須です。";
                   echo "<br>";
                   echo "入力画面に戻り、就業予定者現住所を入力してください";
                   return false;
               }
            if (empty($_POST["work_start"])) {
                     echo "稼働可能日は入力必須です。";
                     echo "<br>";
                     echo "入力画面に戻り、稼働可能日を入力してください";
                     return false;
                     }
            if (empty($_POST["interviewday"])) {
                    echo "面接可能日は入力必須です。";
                    echo "<br>";
                    echo "入力画面に戻り、面接可能日を入力してください";
                    return false;
                    }
            if (empty($_POST["skill"])) {
                    echo "所持スキルは入力必須です。";
                    echo "<br>";
                    echo "入力画面に戻り、所持スキルを入力してください";
                    return false;
                    }

          /////////////ファイルアップロード///////////////
          //一字ファイルができているか（アップロードされているか）チェック
          if(is_uploaded_file($_FILES['up_file']['tmp_name'])){
              //一字ファイルを保存ファイルにコピーできたか
              if(move_uploaded_file($_FILES['up_file']['tmp_name'],"./images/".$_FILES['up_file']['name'])){
                  //正常
                  // echo "uploaded";
              }else{
                  //コピーに失敗（ディレクトリがないか、パーミッションエラー）
                  // echo "error while saving.";
                  }
          }else{
              //そもそもファイルが来ていない。
               echo "就業予定者写真は入力必須です。";
               echo "<br>";
               echo "入力画面に戻り、就業予定者写真を入力してください";
               return false;
          }

         /////データーベースに接続（オブジェクト指向で）
         $user = new User($host,$dbname,$user,$pass);
         $user->connectDb();

         /////登録処理（ポストが飛んで来たら）
         if($_POST){
         $user->entryadd($_POST);
         }

     }//tryおわり
        //DBに異常があった場合検知（キャッチ）できるようにしておく
   catch (PDOException $e) { // PDOExceptionをキャッチする
        print "エラー!: " . $e->getMessage() . "<br/gt;";
         die();
     }


   ////////自動返信メール/////////
   // 変数とタイムゾーンを初期化
     $header = null;
     $body = null; //写真
   	$auto_reply_subject = null;
   	$auto_reply_text = null;
     $admin_reply_subject = null;
     $admin_reply_text = null;
   	date_default_timezone_set('Asia/Tokyo');

     //日本語の使用宣言
   mb_language("ja");//写真
   mb_internal_encoding("UTF-8");//写真

     // //写真について
     // $file_path = $_FILES['up_file']['tmp_name'];
     // $file_name = $_FILES['up_file']['name'];

     // ヘッダー情報を設定
     $header = "MIME-Version: 1.0\n";
     // $header = "Content-Type: multipart/mixed;boundary=\"__BOUNDARY__\"\n";//写真
     $header .= "From: TIRつなぐ事務局 <kumasmi1113@gmail.com>\n";
     $header .= "Reply-To: TIRつなぐ事務局 <kumasmi1113@gmail.com>\n";

     // 件名を設定
     	$auto_reply_subject = 'ご応募ありがとうございます。';

       // 本文を設定
     	$auto_reply_text = "この度は、ご応募頂き誠にありがとうございます。
     下記の内容で受け付けました。\n\n";
     	$auto_reply_text .= "ご応募日時：" . date("Y-m-d H:i") . "\n";
     	$auto_reply_text .= "貴社名：" . $_POST['company_name']. "\n";
     	$auto_reply_text .= "貴社営業担当者：" . $_POST['companyuser_name'] . "\n\n";
      $auto_reply_text .= "案件名：" . $_SESSION['RECRUITPJ']. "\n";
       $auto_reply_text .= "就業予定者氏名：" . $_POST['entry_name'] . "\n\n";
       $auto_reply_text .= "就業予定者フリガナ：" . $_POST['entry_huri'] . "\n\n";
       $auto_reply_text .= "就業予定者電話番号：" . $_POST['tel'] . "\n\n";
       $auto_reply_text .= "就業予定者生年月日：" . $_POST['birth'] . "\n\n";
       $auto_reply_text .= "就業予定者現住所：" . $_POST['address'] . "\n\n";
       $auto_reply_text .= "就業予定者メールアドレス：" . $_POST['mail'] . "\n\n";
       $auto_reply_text .= "稼働可能日：" . $_POST['work_start'] . "\n\n";
       $auto_reply_text .= "面接可能日：" . $_POST['interviewday'] . "\n\n";
       $auto_reply_text .= "所持スキル：" . $_POST['skill'] . "\n\n";
       $auto_reply_text .= "自己PR：" . $_POST['pr'] . "\n\n";
       $auto_reply_text .= "その他：" . $_POST['comment'] . "\n\n";
     	$auto_reply_text .= "株式会社ティーアイアール 案件共有サイト「つなぐ」運営局";


       // メール送信
       	mb_send_mail( $_POST['mail'], $auto_reply_subject,$auto_reply_text, $header);


           // 運営側へ送るメールの件名
           	$admin_reply_subject = "応募を受け付けました";

           	// 本文を設定
           	$admin_reply_text = "下記の内容で応募がありました。\n\n";
             $admin_reply_text .= "ご応募日時：".date("Y-m-d H:i") ."\n";
             $admin_reply_text .= "貴社名：" .$_POST['company_name']."\n";
             $admin_reply_text .= "貴社営業担当者：" . $_POST['companyuser_name']."\n\n";
             $admin_reply_text .= "案件名：" . $_SESSION['RECRUITPJ']. "\n\n";
             $admin_reply_text .= "就業予定者氏名：" . $_POST['entry_name'] . "\n\n";
             $admin_reply_text .= "就業予定者フリガナ：" . $_POST['entry_huri'] . "\n\n";
             $admin_reply_text .= "就業予定者電話番号：" . $_POST['tel'] . "\n\n";
             $admin_reply_text .= "就業予定者生年月日：" . $_POST['birth'] . "\n\n";
             $admin_reply_text .= "就業予定者現住所：" . $_POST['address'] . "\n\n";
             $admin_reply_text .= "就業予定者メールアドレス：" . $_POST['mail'] . "\n\n";
             $admin_reply_text .= "稼働可能日：" . $_POST['work_start'] . "\n\n";
             $admin_reply_text .= "面接可能日：" . $_POST['interviewday'] . "\n\n";
             $admin_reply_text .= "所持スキル：" . $_POST['skill'] . "\n\n";
             $admin_reply_text .= "自己PR：" . $_POST['pr'] . "\n\n";
             $admin_reply_text .= "その他：" . $_POST['comment'] . "\n\n";
             $admin_reply_text .= "株式会社ティーアイアール 案件共有サイト「つなぐ」運営局";


             // 運営側へメール送信
             mb_send_mail( 'c.kumagai@tir-group.jp', $admin_reply_subject,$admin_reply_text, $header);
   ///////////自動送信メールおわり//////////////////////

    ?>

    <section class="subtitle">
      <h1>応募が完了いたしました</h1>
    </section>


    <section class="entryform">
      <!-- <h2>下記の項目をご記入の上確認ボタンを押してください。</h2> -->
      <p class="text">応募内容は貴社営業担当者様のメールアドレスに送信致しました。<br>
        担当者からの連絡をお待ちください。</p>

        <!-- TIRユーザの場合はtirtopに画面遷移 -->
        <?php if($_SESSION['User']['division_id']==2):?>
          <a href="tirtop.php" id="submit_btn">TOPへ</a>
        <?php else: ?>
        <!-- 協力会社ユーザの場合はtirtopに画面遷移 -->
          <a href="top.php" id="submit_btn">TOPへ</a>
        <?php endif; ?>

    </section>

    <!-- フッター導入 -->
    <?php
    require("require/footer.php")
     ?>
     </section> <!--wrrapEND-->
  </body>
</html>
