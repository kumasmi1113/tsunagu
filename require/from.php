
<section class="from">

  <div class="fromline">
<?php
if ($_SESSION['User']['division_id']==1) {  //セッションのdivision_idが協力会社の場合
  print_r($_SESSION['User']['company_name'] . '&nbsp;' . '&nbsp;' .$_SESSION['User']['user_name']."様");//セッション情報の表示
}
if($_SESSION['User']['division_id']==2){ //2だったら自社社員名を表示
  print_r($_SESSION['User']['company_name'] . '&nbsp;' . '&nbsp;' .$_SESSION['User']['user_name']);
}

//ログアウト処理
if(isset($_GET['logout'])){
  $_SESSION = array();  //セッションに入っているユーザ情報を破棄する
  session_destroy();//すべてのセッションを破棄する
}

// // //ログイン画面を軽経由していなかったら
if(!isset($_SESSION['User'])){
  header('Location: login.php');  //login画面にもどる
  exit;
}

 ?>
  </div>

  <div class="logout">
    <a href="?logout=1" style="color: #fff;">ログアウト</a>
  </div>

</section>
