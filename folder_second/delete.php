<?php
  // データベースへの接続＆idに基づいたデータの削除
    try{
        //データベースへの接続
        $dbh = new PDO("mysql:host=127.0.0.1; dbname=board; charset=utf8", 'test_user', 'Test_pass_2019');
        //クエリの設定
        $sql = "DeLETE FROM contents WHERE id = :id";
        //prepareへのクエリの設置
        $stmt = $dbh->prepare($sql);
        //クエリの実効
        $stmt->execute(array(':id' => $_GET["id"]));

    }catch (Exception $e) {
        echo 'エラーが発生しました。:' . $e->getMessage();
  }

  $dbh = null;


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