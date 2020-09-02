<?php
require_once("DB.php");


class User extends DB{


////////////////////////////////////////////////////////
//検索
////////////////////////////////////////////////////////
  //案件名で検索
  public function searchname(){
     // $sql = 'SELECT * FROM recruits WHERE project_name LIKE :project_name';
     $sql = 'SELECT variations.variation,recruits.id,recruits.user_name,recruits.entry_start, recruits.entry_end, recruits.project_name ,recruits.skill,
             recruits.location, recruits.working_day, recruits.working_time, recruits.traffic_cost, recruits.staff_money, recruits.comment FROM recruits
             inner join variations on recruits.variation_id = variations.id WHERE project_name LIKE :project_name';
     $stmt = $this->connect->prepare($sql);
     $stmt->bindValue(":project_name", '%' . addcslashes($_POST['searchname'], '\_%') . '%');
     $stmt->execute();
     $result = $stmt->fetchAll();
     return $result;  //よびだしさきに参照結果をリターン
  }//参照 select

  //種別での絞り込み検索
  public function search(){
     $sql = 'SELECT variations.variation,recruits.id,recruits.user_name,recruits.entry_start, recruits.entry_end, recruits.project_name ,recruits.skill,
             recruits.location, recruits.working_day, recruits.working_time, recruits.traffic_cost, recruits.staff_money, recruits.comment FROM recruits
             inner join variations on recruits.variation_id = variations.id WHERE variation_id LIKE :variation_id';
     $stmt = $this->connect->prepare($sql);
     $stmt->bindValue(":variation_id", '%' . addcslashes($_POST['search'], '\_%') . '%');
     $stmt->execute();
     $result = $stmt->fetchAll();
     return $result;  //よびだしさきに参照結果をリターン
  }//参照 select


////////////////////////////////////////////////////////
//Ajax削除機能・論理削除機能
////////////////////////////////////////////////////////

public function post(){
  if (!isset($_POST['mode'])) {
    throw new \Exception("mode not set!");
  }
  switch ($_POST['mode']) {
    case 'delete':
      return $this->_delete();
    case 'update':
      return $this->_update();

  }
}

public function _delete() {
  if (!isset($_POST['id'])) {
    throw new \Exception('[delete] id not set!');
  }
  $sql = sprintf("delete from recruits where id = %d", $_POST['id']);
  $stmt = $this->connect->prepare($sql);
  $stmt->execute();
  return [];
}

public function _update() {
  $sql = sprintf("update users set updated = date('Y-m-d H:i:s'), delid = 1 where id = %d", $_POST['id']);
  $stmt = $this->connect->prepare($sql);
  $stmt->execute();
  return [];
}


////////////////////////////////////////////////////////
//ログイン
////////////////////////////////////////////////////////
  public function login($arr){
    $sql = 'SELECT * FROM users WHERE mail = :mail AND password =:password';
           // 'SELECT * FROM users division WHERE users.division_id=divisions.division_id';
    $stmt = $this->connect->prepare($sql);
    $params = array(':mail'=>$arr['mail'],':password'=>$arr['password']);
    $stmt->execute($params);
    $result = $stmt->fetch();//ユーザーの情報を探して取得
    return $result;
  }


////////////////////////////////////////////////////////
//参照 select
////////////////////////////////////////////////////////


  /////////////////////
  //募集中の案件一覧
  /////////////////////
  public function findAll(){
     $sql = 'SELECT variations.variation,recruits.id,recruits.user_name,recruits.entry_start, recruits.entry_end, recruits.project_name ,recruits.skill,
             recruits.location, recruits.working_day, recruits.working_time, recruits.traffic_cost, recruits.staff_money, recruits.comment FROM recruits
             inner join variations on recruits.variation_id = variations.id' ;
     // $sql = 'SELECT * FROM recruits order by id desc';  //order by id desc新しい順
     $stmt = $this->connect->prepare($sql);
     $stmt->execute();
     $result = $stmt->fetchAll();
     return $result;  //よびだしさきに参照結果をリターン
  }//参照 select


  /////////////////////
  //テストめーる
  /////////////////////
  public function userMail(){
     $sql = 'SELECT GROUP_CONCAT(mail) FROM users WHERE delid = 0';
     $stmt = $this->connect->prepare($sql);
     $stmt->execute();
     $result = $stmt->fetchColumn();
     return $result;  //よびだしさきに参照結果をリターン
  }//参照 select


  /////////////////////
  //応募フォーム（この案件に応募しますの表）
  /////////////////////
  public function findById($id){
    $sql = 'SELECT variations.variation,recruits.id,recruits.user_name,recruits.entry_start, recruits.entry_end, recruits.project_name ,recruits.skill,
            recruits.location, recruits.working_day, recruits.working_time, recruits.traffic_cost, recruits.staff_money, recruits.comment FROM recruits
            inner join variations on recruits.variation_id = variations.id WHERE recruits.id = :id' ;
    // $sql = 'SELECT * FROM recruits WHERE id = :id';
    $stmt = $this->connect->prepare($sql);
    $params = array(':id'=>$id);
    $stmt->execute($params);
    $result = $stmt->fetch();
    return $result;
  }

  /////////////////////
  //登録中のユーザ一覧(生存者のみ表示)
  /////////////////////
  public function userlist(){
     $sql = 'SELECT divisions.division,users.id,users.company_name,users.user_name, users.tel, users.mail ,users.password FROM users
              inner join divisions on users.division_id = divisions.id WHERE delid=0' ;
     $stmt = $this->connect->prepare($sql);
     $stmt->execute();
     $result = $stmt->fetchAll();
     return $result;  //よびだしさきに参照結果をリターン
  }//参照 select


  /////////////////////
  //応募情報一覧
  /////////////////////
  //entry.idを一覧詳細を引っ張ってくるときの基準のidとする
  public function entrylist(){
     $sql = "SELECT recruits.user_name,recruits.project_name,entries.entry_name,entries.id,
     entries.company_name,entries.companyuser_name FROM recruit_entris
     INNER JOIN recruits ON recruits.id = recruit_entris.recruit_id
     INNER JOIN entries ON entries.id = recruit_entris.entry_id";

     $stmt = $this->connect->prepare($sql);
     $stmt->execute();
     $result = $stmt->fetchAll();
     return $result;  //よびだしさきに参照結果をリターン
  }//参照 select


  /////////////////////
  //応募情報一覧詳細
  /////////////////////
  public function findByEntryId($id){
     $sql = "SELECT recruits.user_name,recruits.project_name,entries.entry_name,entries.id,
            entries.tel,entries.entry_huri,entries.company_name,entries.companyuser_name,entries.birth,entries.up_file,
            entries.address,entries.work_start,entries.interviewday,entries.skill,entries.pr,entries.comment,entries.mail
            FROM recruit_entris
            INNER JOIN recruits ON recruits.id = recruit_entris.recruit_id
            INNER JOIN entries ON entries.id = recruit_entris.entry_id WHERE entries.id=:id";

     $stmt = $this->connect->prepare($sql);
     $params = array(':id'=>$id);
     $stmt->execute($params);
     $result = $stmt->fetch();
     return $result;  //よびだしさきに参照結果をリターン
  }//参照 select


////////////////////////////////////////////////////////
//登録処理 insert
////////////////////////////////////////////////////////

  /////////////////////
  //募集登録 recruits
  /////////////////////
  public function add($arr){
    $sql ="INSERT INTO recruits (user_name,entry_start,entry_end,project_name,skill,location,working_day,working_time,staff_money,traffic_cost,comment,user_id,created,variation_id)
           VALUES(:user_name,:entry_start,:entry_end,:project_name,:skill,:location,:working_day,:working_time,:staff_money,:traffic_cost,:comment,:user_id,:created,:variation_id)";
    $stmt = $this->connect->prepare($sql);
    $params = array(
      ':user_name'=>$arr['user_name'],
      ':entry_start'=>$arr['entry_start'],
      ':entry_end'=>$arr['entry_end'],
      ':project_name'=>$arr['project_name'],
      ':skill'=>$arr['skill'],
      ':location'=>$arr['location'],
      ':working_day'=>$arr['working_day'],
      ':working_time'=>$arr['working_time'],
      ':staff_money'=>$arr['staff_money'],
      ':traffic_cost'=>$arr['traffic_cost'],
      ':comment'=>$arr['comment'],
      ':user_id'=>$arr['user_id'],
      ':created'=>date("Y-m-d H:i:s"),
      ':variation_id'=>$arr['variation_id']
    );
    $stmt->execute($params);
        // $check = $stmt->execute($params);
        // if($check){
        // print '成功！';
        // }else{
        // print '失敗！';
        // }
  }//登録 insert

  /////////////////////
  //応募情報情報登録 entries
  /////////////////////
  public function entryadd($arr){
    $sql ="INSERT INTO entries(company_name,companyuser_name,entry_name,entry_huri,tel,birth,address,mail,work_start,interviewday,skill,up_file,pr,comment,user_id,created)
           VALUES(:company_name,:companyuser_name,:entry_name,:entry_huri,:tel,:birth,:address,:mail,:work_start,:interviewday,:skill,:up_file,:pr,:comment,:user_id,:created)";

    $stmt = $this->connect->prepare($sql);
    $params = array(
      ':company_name'=>$arr['company_name'],
      ':companyuser_name'=>$arr['companyuser_name'],
      ':entry_name'=>$arr['entry_name'],
      ':entry_huri'=>$arr['entry_huri'],
      ':tel'=>$arr['tel'],
      ':birth'=>$arr['birth'],
      ':address'=>$arr['address'],
      ':mail'=>$arr['mail'],
      ':work_start'=>$arr['work_start'],
      ':interviewday'=>$arr['interviewday'],
      ':skill'=>$arr['skill'],
      ':up_file'=>$_FILES['up_file']['name'],
      'pr'=>$arr['pr'],
      ':comment'=>$arr['comment'],
      ':user_id'=>$arr['user_id'],
      ':created'=>date("Y-m-d H:i:s")
    );
    $stmt->execute($params);
    $entry_id = $this->connect->lastInsertId(); //最後に登録したidを取得

  // //ricruit_entries(中間テーブル)
      $sql ="INSERT INTO recruit_entris (entry_id,recruit_id,created)
             VALUES(:entry_id,:recruit_id,:created)";
      $stmt = $this->connect->prepare($sql);
      $params = array(
        ':recruit_id'=>$_SESSION['RECRUIT'],
        // ':entry_id'=>$arr['entry_id'],
        ':entry_id'=>$entry_id,
        ':created'=>date("Y-m-d H:i:s")
      );
      $stmt->execute($params);

  }//登録 insert



  /////////////////////
  //新規ユーザー登録 users
  /////////////////////
      public function useradd($arr){
        $sql ="INSERT INTO users(user_name,tel,mail,password,company_name,division_id,created,delid) VALUES(:user_name,:tel,:mail,:password,:company_name,:division_id,:created,:delid)";
        $stmt = $this->connect->prepare($sql);
        $params = array(
          ':user_name'=>$arr['user_name'],
          ':tel'=>$arr['tel'],
          ':mail'=>$arr['mail'],
          ':password'=>$arr['password'],
          ':company_name'=>$arr['company_name'],
          ':division_id'=>$arr['division_id'],
          ':created'=>date("Y-m-d H:i:s"),
          ':delid'=>$arr['delid']
        );
        $stmt->execute($params);
      }//登録 insert


////////////////////////////////////////////////////////
//更新処理 update
////////////////////////////////////////////////////////
  /////////////////////
  //募集内容の更新 recruits
  /////////////////////
  public function edit($arr){
    $sql = "UPDATE recruits SET user_name = :user_name, entry_start = :entry_start ,
            entry_end = :entry_end , project_name = :project_name , skill = :skill ,
            location = :location , working_day = :working_day , working_time = :working_time ,
            staff_money = :staff_money , traffic_cost = :traffic_cost ,
            comment = :comment , user_id = :user_id , updated = :updated WHERE id = :id";
    $stmt = $this->connect->prepare($sql);
    $params = array(
      ':id'=>$arr['id'],
      ':user_name'=>$arr['user_name'],
      ':entry_start'=>$arr['entry_start'],
      ':entry_end'=>$arr['entry_end'],
      ':project_name'=>$arr['project_name'],
      ':skill'=>$arr['skill'],
      ':location'=>$arr['location'],
      ':working_day'=>$arr['working_day'],
      ':working_time'=>$arr['working_time'],
      ':staff_money'=>$arr['staff_money'],
      ':traffic_cost'=>$arr['traffic_cost'],
      ':comment'=>$arr['comment'],
      ':user_id'=>$arr['user_id'],
      ':updated'=>date("Y-m-d H:i:s")//更新した日付を表示
    );
    $stmt->execute($params);
  }  //更新 update


////////////////////////////////////////////////////////
//削除処理 delete
////////////////////////////////////////////////////////
  /////////////////////
  //応募内容の削除
  /////////////////////
  public function delete($id){
    if (isset($id)) {
      $sql = "DELETE FROM entries WHERE id = :id";
      $stmt = $this->connect->prepare($sql);
      $params = array(':id'=> $id);
      $stmt->execute($params);
    }
  }//削除  delete

}

 ?>
