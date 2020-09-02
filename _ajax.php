<?php

//config.phpを読み込み（インクルード）
require_once("config/config.php");
require_once("model/User.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') { //postされたときだけ
  try {
    /////データーベースに接続（オブジェクト指向で）
    $user = new User($host,$dbname,$user,$pass);
    $user->connectDb();
    $res = $user->post();

    header('Content-Type: application/json');
    echo json_encode($res);
    exit;
  } catch (Exception $e) {
    echo   'エラーが発生しました。:' . $e->getMessage();
  }

}

 ?>
