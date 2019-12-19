<?php
  //関数化前コード(2019/12/19)
  // データベースへの接続＆idに基づいたデータの削除
//   try{
//     //データベースへの接続
//     $dbh = new PDO("mysql:host=127.0.0.1; dbname=board; charset=utf8", 'test_user', 'Test_pass_2019',array(PDO::ATTR_EMULATE_PREPARES => false));
//     //クエリの設定
//     $sql = "DeLETE FROM contents WHERE id = :id";
//     //prepareへのクエリの設置
//     $stmt = $dbh->prepare($sql);
//     //sql文へ値のバインド
//     $stmt->bindValue(':id', $_GET["id"],PDO::PARAM_STR);
//     //実効
//     $stmt->execute();
    
//     //クエリの実効
//     //$stmt->execute(array(':id' => $_GET["id"]));
//   }catch (Exception $e) {
//     echo 'エラーが発生しました。:' . $e->getMessage();
// }

//   $dbh = null;

  //関数化後
  require_once './../connect_db.php';
  $id = $_GET["id"];
  $obj = new connet;
  $sql = "DeLETE FROM contents WHERE id = :id";
  $result = $obj->delete($sql,$id);
?>

<!-- 削除後の遷移ページ -->
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>削除完了</title>
  </head>
  <body> 
  <P>削除完了</p>          
  <p>
      <a href="page_login_after.php">投稿一覧へ</a>
  </p> 
  </body>
</html>